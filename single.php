<?php get_header(); ?>

<div class="overview">
    <h1 class="overview__heading">
        <?php the_title(); ?>
    </h1>
    <div class="overview__date">
        <div class="overview__date-day"><?php the_time('d'); ?></div>
        <div class="overview__date-year"><?php the_time('M y'); ?></div>
    </div>
</div>
<div class="detail">

    <div class="description">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <div class="description__article">
                    <div class="description__article-header">
                        <div class="description__artcile-meta">By <span
                                class="color-primary"><?php the_author_posts_link(); ?></span>
                            |
                            <span class="color-primary"><?php the_category(', '); ?></span>
                        </div>
                        <div class="overview__socials">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" target="_blank"
                                class="overview__icon">
                                <svg class="overview__icon">
                                    <use
                                        xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-facebook2">
                                    </use>
                                </svg>
                            </a>
                            <a href="http://www.twitter.com/share?url=<?php the_permalink() ?>" target="_blank"
                                class="overview__icon">
                                <svg class="overview__icon">
                                    <use
                                        xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-twitter">
                                    </use>
                                </svg>
                            </a>
                            <a href="whatsapp://send?text=<?php the_permalink() ?>" target="_blank" class="overview__icon">
                                <svg class="overview__icon">
                                    <use
                                        xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-whatsapp">
                                    </use>
                                </svg>
                            </a>
                            <a href="https://telegram.me/share/url?url=<?php the_permalink() ?>&text=<?php the_title(); ?>"
                                target="_blank" class="overview__icon">
                                <svg class="overview__icon">
                                    <use
                                        xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-telegram">
                                    </use>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/?url=<?php the_permalink() ?>" target="_blank"
                                class="overview__icon">
                                <svg class="overview__icon">
                                    <use
                                        xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-instagram">
                                    </use>
                                </svg>
                            </a>

                        </div>
                    </div>

                    <article id="post-<?php the_ID(); ?>" class="description__article-body">
                    <?php if (get_theme_mod('enable_featured_image', true)) : ?>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="featured-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                            <?php endif; ?>

                                <div class="entry-content">
                            <?php the_content(); ?>

                            <div class="overview__socials mt3">
                                <p>Click any of the icons to share this post: </p>&nbsp;
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" target="_blank"
                                    class="overview__icon">
                                    <svg class="overview__icon">
                                        <use
                                            xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-facebook2">
                                        </use>
                                    </svg>
                                </a>
                                <a href="http://www.twitter.com/share?url=<?php the_permalink() ?>" target="_blank"
                                    class="overview__icon">
                                    <svg class="overview__icon">
                                        <use
                                            xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-twitter">
                                        </use>
                                    </svg>
                                </a>
                                <a href="whatsapp://send?text=<?php the_permalink() ?>" target="_blank" class="overview__icon">
                                    <svg class="overview__icon">
                                        <use
                                            xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-whatsapp">
                                        </use>
                                    </svg>
                                </a>
                                <a href="https://telegram.me/share/url?url=<?php the_permalink() ?>&text=<?php the_title(); ?>"
                                    target="_blank" class="overview__icon">
                                    <svg class="overview__icon">
                                        <use
                                            xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-telegram">
                                        </use>
                                    </svg>
                                </a>
                                <a href="https://www.instagram.com/?url=<?php the_permalink() ?>" target="_blank"
                                    class="overview__icon">
                                    <svg class="overview__icon">
                                        <use
                                            xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-instagram">
                                        </use>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    </article>
                </div>
                <?php
            endwhile;
        else : ?>
            <div class="not-found">
                <p class="not-found__text">Sorry, no posts were found!</p>
            </div>
            <?php
        endif;
        ?>
        <div class="description__post-nav">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>
            <?php if (! empty($prev_post)) : ?>
                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="post-nav__link prev">&larr; Previous Post</a>
            <?php endif; ?>
            <?php if (! empty($next_post)) : ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>" class="post-nav__link next">Next Post &rarr;</a>
            <?php endif; ?>
        </div>
        <?php $related_posts_query = get_related_posts();

        // Check if there are related posts
        if ($related_posts_query->have_posts()) :
            ?>
            <div class="related-posts">
                <div class="right-sidebar__title">
                    Related Posts
                </div>
                <?php while ($related_posts_query->have_posts()) :
                    $related_posts_query->the_post(); ?>
                    <div class="articles">
                        <a href="<?php the_permalink(); ?>">
                            <figure class="articles__post">
                                <figcaption class="articles__post-content">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/trillio.jpg" alt="Image"
                                            class="articles__featured-img">
                                    <?php endif; ?>
                                    <div class="articles__title">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="articles__icon">&gt;</div>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php
            // Restore original post data
            wp_reset_postdata();
        endif;
        ?>
        <?php if (comments_open() || get_comments_number()) :
            comments_template();
        endif; ?>
        <!-- <div id="fb-root"></div>
            <div class="fb-comments" data-href="https://heritage-plus.org" data-width="100%" data-numposts="5"></div> -->

    </div>

    <div class="right-sidebar">
        <?php dynamic_sidebar('sidebar-widget-area'); ?>
    </div>
</div>
<?php get_footer(); ?>