<?php
/* @var $wpdb wpdb */
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$module = NewsletterEmails::instance();

// Always required
$email = Newsletter::instance()->get_email((int) $_GET['id'], ARRAY_A);

if (empty($email)) {
    echo 'Wrong email identifier';
    return;
}
$email_id = $email['id'];

// If there is no action we assume we are enter the first time so we populate the
// $nc->data with the editable email fields
if (!$controls->is_action()) {
    $controls->data = $email;
    if (!empty($email['preferences'])) {
        $controls->data['preferences'] = explode(',', $email['preferences']);
    }
    if (!empty($email['sex'])) {
        $controls->data['sex'] = explode(',', $email['sex']);
    }
    $email_options = unserialize($email['options']);
    if (is_array($email_options)) {
        $controls->data = array_merge($controls->data, $email_options);
    }
}

if ($controls->is_action('test') || $controls->is_action('save') || $controls->is_action('send') || $controls->is_action('editor')) {

    // If we were editing with visual editor (==0), we must read the extra <body> content
    if ($email['editor'] == 0) {
        $x = strpos($email['message'], '<body');
        if ($x !== false) {
            $x = strpos($email['message'], '>', $x);
            $email['message'] = substr($email['message'], 0, $x + 1) . $controls->data['message'] . '</body></html>';
        } else {
            $email['message'] = '<html><body>' . $controls->data['message'] . '</body></html>';
        }
    } else {
        $email['message'] = $controls->data['message'];
    }
    $email['message_text'] = $controls->data['message_text'];
    $email['subject'] = $controls->data['subject'];
    $email['track'] = $controls->data['track'];
    $email['private'] = $controls->data['private'];

    // Builds the extended options
    $email['options'] = array();
    $email['options']['preferences_status'] = $controls->data['preferences_status'];
    if (isset($controls->data['preferences'])) {
        $email['options']['preferences'] = $controls->data['preferences'];
    }
    if (isset($controls->data['sex'])) {
        $email['options']['sex'] = $controls->data['sex'];
    }

    $email['options']['status'] = $controls->data['status'];
    $email['options']['preferences_status_operator'] = $controls->data['preferences_status_operator'];
    $email['options']['wp_users'] = $controls->data['wp_users'];

    $email['options'] = serialize($email['options']);

    if (isset($controls->data['preferences'])) {
        $email['preferences'] = implode(',', $controls->data['preferences']);
    } else {
        $email['preferences'] = '';
    }

    if (isset($controls->data['sex'])) {
        $email['sex'] = implode(',', $controls->data['sex']);
    } else {
        $email['sex'] = '';
    }

    // Before send, we build the query to extract subscriber, so the delivery engine does not
    // have to worry about the email parameters
    if ($controls->data['status'] == 'S') {
        $query = "select * from " . NEWSLETTER_USERS_TABLE . " where status='S'";
    } else {
        $query = "select * from " . NEWSLETTER_USERS_TABLE . " where status='C'";
    }

    if ($controls->data['wp_users'] == '1') {
        $query .= " and wp_user_id<>0";
    }


    if (isset($controls->data['preferences'])) {
        $preferences = $controls->data['preferences'];

        // Not set one of the preferences specified
        $operator = $controls->data['preferences_status_operator'] == 0 ? ' or ' : ' and ';
        if ($controls->data['preferences_status'] == 1) {
            $query .= " and (";
            foreach ($preferences as $x) {
                $query .= "list_" . ((int)$x) . "=0" . $operator;
            }
            $query = substr($query, 0, -4);
            $query .= ")";
        } else {
            $query .= " and (";
            foreach ($preferences as $x) {
                $query .= "list_" . ((int)$x) . "=1" . $operator;
            }
            $query = substr($query, 0, -4);
            $query .= ")";
        }
    }

    $sex = $controls->data['sex'];
    if (is_array($sex)) {
        $query .= " and sex in (";
        foreach ($sex as $x) {
            $query .= "'" . esc_sql($x) . "', ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
    }

    $email['query'] = $query;
    $email['total'] = $wpdb->get_var(str_replace('*', 'count(*)', $query));

    if ($controls->is_action('send') && $controls->data['send_on'] < time()) {
        $controls->data['send_on'] = time();
    }
    $email['send_on'] = $controls->data['send_on'];

    if ($controls->is_action('editor')) {
        $email['editor'] = $email['editor'] == 0 ? 1 : 0;
    }

    // Cleans up of tag
    $email['message'] = NewsletterModule::clean_url_tags($email['message']);

    $res = Newsletter::instance()->save_email($email);
    if ($res === false) {
        $controls->errors = 'Unable to save. Try to deactivate and reactivate the plugin may be the database is out of sync.';
    }

    $controls->data['message'] = $email['message'];

    $controls->add_message_saved();
}

if ($controls->is_action('send')) {
    // Todo subject check
    if ($email['subject'] == '') {
        $controls->errors = __('A subject is required to send', 'newsletter');
    } else {
        $wpdb->update(NEWSLETTER_EMAILS_TABLE, array('status' => 'sending'), array('id' => $email_id));
        $email['status'] = 'sending';
        $controls->messages .= __('Now sending, see the progress on newsletter list', 'newsletter');
    }
}

if ($controls->is_action('pause')) {
    $wpdb->update(NEWSLETTER_EMAILS_TABLE, array('status' => 'paused'), array('id' => $email_id));
    $email['status'] = 'paused';
}

if ($controls->is_action('continue')) {
    $wpdb->update(NEWSLETTER_EMAILS_TABLE, array('status' => 'sending'), array('id' => $email_id));
    $email['status'] = 'sending';
}

if ($controls->is_action('abort')) {
    $wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set last_id=0, sent=0, status='new' where id=" . $email_id);
    $email['status'] = 'new';
    $email['sent'] = 0;
    $email['last_id'] = 0;
    $controls->messages = __('Delivery definitively cancelled', 'newsletter');
}

if ($controls->is_action('test')) {
    if ($email['subject'] == '') {
        $controls->errors = __('A subject is required to send', 'newsletter');
    } else {
        $users = NewsletterUsers::instance()->get_test_users();
        if (count($users) == 0) {
            $controls->messages = '<strong>' . __('There are no test subscribers to send to', 'newsletter') . '</strong>';
        } else {
            Newsletter::instance()->send(Newsletter::instance()->get_email($email_id), $users);
            $controls->messages = __('Test newsletter sent to:', 'newsletter');
            foreach ($users as &$user) {
                $controls->messages .= ' ' . $user->email;
            }
            $controls->messages .= '.';
        }

        $controls->messages .= '<br>';
        $controls->messages .= '<a href="http://www.thenewsletterplugin.com/plugins/newsletter/subscribers-module#test" target="_blank">' .
                __('Read more about test subscribers', 'newsletter') . '</a>.';

        $controls->messages .= '<br>If diagnostic emails are delivered but test emails are not, try to change the encoding to "base 64" on main configuration panel';
    }
}

$template = '{message}';
if ($email['editor'] == 0) {
    $x = strpos($controls->data['message'], '<body');
    // Some time the message in $nc->data is already cleaned up, it depends on action called
    if ($x !== false) {
        $x = strpos($controls->data['message'], '>', $x);
        $y = strpos($controls->data['message'], '</body>');

        $template = substr($controls->data['message'], 0, $x) . '{message}' . substr($controls->data['message'], $y);
        $controls->data['message'] = substr($controls->data['message'], $x + 1, $y - $x - 1);
    }
}
?>

<script type="text/javascript" src="<?php echo plugins_url('newsletter'); ?>/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    var template = <?php echo json_encode($template) ?>;
    tinyMCE.init({
        height: 700,
        mode: "specific_textareas",
        editor_selector: "visual",
        theme: "advanced",
        entity_encoding: "raw",
        plugins: "table,fullscreen,legacyoutput",
        theme_advanced_disable: "styleselect",
        theme_advanced_buttons1_add: "forecolor,blockquote,code,fontsizeselect,fontselect",
        theme_advanced_buttons3_add: "tablecontrols,fullscreen",
        relative_urls: false,
        theme_advanced_statusbar_location: "bottom",
        remove_script_host: false,
        theme_advanced_resizing: true,
        theme_advanced_toolbar_location: "top",
        document_base_url: "<?php echo get_option('home'); ?>/",
        content_css: ["<?php echo plugins_url('newsletter') ?>/emails/editor.css", "<?php echo plugins_url('newsletter') . '/emails/css.php?id=' . $email_id . '&' . time(); ?>"]
    });

    jQuery(document).ready(function () {
        jQuery('#upload_image_button').click(function () {
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            return false;
        });

        window.send_to_editor = function (html) {
            var imgURL = html.match(/src=\"(.*?)\"/);
            tinyMCE.execCommand('mceInsertContent', false, '<img src="' + imgURL[1] + '" />');
            tb_remove();
        }
    });

    function template_refresh() {
        var d = document.getElementById('options_preview').contentWindow.document;
        d.open();
        //d.write(template.replace("{messaggio}", templateEditor.getValue()));
        d.write(template.replace("{message}", document.getElementById("options-message").value));
        d.close();
        jQuery("#options_preview").toggle();
    }
</script>

<div class="wrap" id="tnp-wrap">

	<?php include NEWSLETTER_DIR . '/tnp-header.php'; ?>

	<div id="tnp-heading">
            
    <h2><?php _e('Edit Newsletter', 'newsletter') ?></h2>
    
    </div>

	<div id="tnp-body">

    <?php
    if ($controls->data['status'] == 'S') {
        echo '<div class="newsletter-message">Warning! This email is configured to be sent to NOT CONFIRMED subscribers.</div>';
    }
    ?>

    <form method="post" action="" id="newsletter-form">
        <?php $controls->init(array('cookie_name' => 'newsletter_emails_edit_tab')); ?>

        <p class="submit">
            <?php $controls->button_back('?page=newsletter_emails_index') ?>
            <?php if ($email['status'] != 'sending') $controls->button_save(); ?>
            <?php if ($email['status'] != 'sending' && $email['status'] != 'sent') $controls->button_confirm('test', 'Save and test', 'Save and send test emails to test addresses?'); ?>

            <?php if ($email['status'] == 'new') $controls->button_confirm('send', __('Send', 'newsletter'), __('Start real delivery?', 'newsletter')); ?>
            <?php if ($email['status'] == 'sending') $controls->button_confirm('pause', __('Pause', 'newsletter'), __('Pause the delivery?', 'newsletter')); ?>
            <?php if ($email['status'] == 'paused') $controls->button_confirm('continue', __('Continue', 'newsletter'), 'Continue the delivery?'); ?>
            <?php if ($email['status'] == 'paused') $controls->button_confirm('abort', __('Stop', 'newsletter'), __('This totally stop the delivery, ok?', 'newsletter')); ?>
            <?php if ($email['status'] != 'sending' && $email['status'] != 'sent') $controls->button_confirm('editor', 'Save and switch to ' . ($email['editor'] == 0 ? 'HTML source' : 'visual') . ' editor', 'Sure?'); ?>
        </p>

        <div id="tabs">
            <ul>
                <li><a href="#tabs-a"><?php _e('Message', 'newsletter') ?></a></li>
                <li><a href="#tabs-b"><?php _e('Message (textual)', 'newsletter') ?></a></li>
                <li><a href="#tabs-c"><?php _e('Targeting', 'newsletter') ?></a></li>
                <li><a href="#tabs-d"><?php _e('Other', 'newsletter') ?></a></li>
                <li><a href="#tabs-status"><?php _e('Status', 'newsletter') ?></a></li>
            </ul>


            <div id="tabs-a">

                <?php $controls->text('subject', 70, 'Subject'); ?>



                <input id="upload_image_button" type="button" value="Choose or upload an image" />

                <a href="http://www.thenewsletterplugin.com/plugins/newsletter/newsletter-tags" target="_blank"><?php _e('Available tags', 'newsletter') ?></a>

                <br><br>



                <?php
                if ($email['editor'] == 0) {
                    $controls->editor('message', 30);
                } else {
                    $controls->textarea_preview('message', '100%', '700');
                }
                ?>


            </div>


            <div id="tabs-b">
                <?php if (Newsletter::instance()->options['phpmailer'] == 0) { ?>
                <p class="tnp-tab-warning">The text part is sent only when Newsletter manages directly the sending process. <a href="admin.php?page=newsletter_main_main" target="_blank">See the main settings</a>.</p>
                <?php } ?>
                <p>
                    This is the textual version of your newsletter. If you empty it, only an HTML version will be sent but
                    is an anti-spam best practice to include a text only version.
                </p>

                <?php $controls->textarea_fixed('message_text', '100%', '500'); ?>
            </div>


            <div id="tabs-c">
                <table class="form-table">

                    <tr valign="top">
                        <th><?php _e('Gender', 'newsletter'); ?></th>
                        <td>
                            <?php $controls->checkboxes_group('sex', array('f' => 'Women', 'm' => 'Men', 'n' => 'Not specified')); ?>
                            <p class="description">
                                Leaving all gender options unselected disable this filter.
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th><?php _e('Lists', 'newsletter'); ?></th>
                        <td>
                            Subscribers with
                            <?php $controls->select('preferences_status_operator', array(0 => 'at least one list', 1 => 'all lists')); ?>

                            <?php $controls->select('preferences_status', array(0 => 'active', 1 => 'not active')); ?>
                            <?php _e('checked below', 'newsletter') ?>

                            <?php $controls->preferences_group('preferences', true); ?>
                            <p class="description">
                                You can address the newsletter to subscribers who selected at least one of the options or to who
                                has not selected at least one of the options.
                                <a href="http://www.thenewsletterplugin.com/plugins/newsletter/newsletter-preferences" target="_blank">Read more about the "NOT ACTIVE" usage</a>.
                            </p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th><?php _e('Status', 'newsletter') ?></th>
                        <td>
                            <?php $controls->select('status', array('C' => __('Confirmed', 'newsletter'), 'S' => __('Not confirmed', 'newsletter'))); ?>

                            <p class="description">
                                <?php _e('Send to not confirmed subscribers ONLY to ask for confirmation including the {subscription_confirm_url} tag.', 'newsletter') ?>
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Only to WordPress users?</th>
                        <td>
                            <?php $controls->yesno('wp_users'); ?>

                            <p class="description">
                                Limit to the subscribers which are WordPress users as well.
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>
                            <?php _e('Subscribers count', 'newsletter') ?>
                        </th>
                        <td>
                            <?php
                            echo $wpdb->get_var(str_replace('*', 'count(*)', $email['query']));
                            ?>
                            <p class="description">
                                <?php _e('Save to update if on targeting filters have been changed', 'newsletter') ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>


            <div id="tabs-d">
                <table class="form-table">
                    <tr valign="top">
                        <th><?php _e('Keep private', 'newsletter') ?></th>
                        <td>
                            <?php $controls->yesno('private'); ?>
                            <p class="description">
                                <?php _e('Hide/show from public sent newsletter list.', 'newsletter') ?>
                                <?php _e('Required', 'newsletter') ?>: <a href="" target="_blank">Newsletter Archive Extension</a>
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th><?php _e('Track clicks and message opening', 'newsletter') ?></th>
                        <td>
                            <?php $controls->yesno('track'); ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th><?php _e('Send on', 'newsletter') ?></th>
                        <td>
                            <?php $controls->datetime('send_on'); ?> (now: <?php echo date_i18n(get_option('date_format') . ' ' . get_option('time_format')); ?>)
                            <p class="description">
                                If the current date and time are wrong, check your timezone on the General WordPress settings.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-status">
                <table class="form-table">
                    <tr valign="top">
                        <th>Email status</th>
                        <td><?php echo $email['status']; ?></td>
                    </tr>
                    <tr valign="top">
                        <th>Messages sent</th>
                        <td><?php echo $email['sent']; ?> of <?php echo $email['total']; ?></td>
                    </tr>
                    <tr valign="top">
                        <th>Query (tech)</th>
                        <td><?php echo $email['query']; ?></td>
                    </tr>
                </table>
            </div>

            <!--
            <div id="tabs-5">
                <p>Tags documented below can be used on newsletter body. Some of them can be used on subject as well.</p>

                <p>
                    Special tags, like the preference setting tag, can be used to highly interact with your subscribers, see
                    the Newsletter Preferences page for examples.
                </p>
                --

                <dl>
                    <dt>{set_preference_N}</dt>
                    <dd>
                        This tag creates a URL which, once clicked, set the preference numner N on the user profile and redirecting the
                        subscriber to his profile panel. Preferences can be configured on Subscription/Form fields panel.
                    </dd>
                </dl>

                </ul>
            </div>
            -->

        </div>

    </form>
</div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php'; ?>
    
</div>