<div class="entry-meta blog-post-entry-meta">
    <?php
    printf(
        _x( 'By %s', 'author byline', 'inspiry' ),
        sprintf(
            '<a class="vcard fn" href="%1$s">%2$s</a>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html( get_the_author_meta( 'display_name' ) )
        )
    );

    echo ' '; _e( 'Posted in', 'inspiry' ); echo ' '; the_category( ', ' );
    echo ' '; _e( 'On ', 'inspiry' ); echo ' ';
    ?>
    <time class="entry-date published" datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'M d, Y' ); ?></time>
</div>