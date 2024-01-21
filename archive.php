<?php get_header(); ?>
<div class="overview">
    <h1 class="overview__heading">
        <?php
        if (is_category()) {
            single_cat_title();
            }
        elseif (is_tag()) {
            single_tag_title();
            }
        elseif (is_author()) {
            the_post();
            echo 'Author Posts: ' . get_the_author();
            rewind_posts();
            }
        elseif (is_day()) {
            echo 'Daily Posts: ' . get_the_date();
            }
        elseif (is_month()) {
            echo 'Monthly Posts: ' . get_the_date(_x('F Y', 'monthly archives date format', 'trillio'));
            }
        elseif (is_year()) {
            echo 'Yearly Posts: ' . get_the_date(_x('Y', 'yearly archives date format', 'trillio'));
            }
        else {
            echo 'Archives:';
            }
        ?>
    </h1>
    <div class="overview__socials">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_site_url() ?>" target="_blank"
            class="overview__icon">
            <svg class="overview__icon">
                <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-facebook2">
                </use>
            </svg>
        </a>
        <a href="http://www.twitter.com/share?url=<?php echo get_site_url() ?>" target="_blank" class="overview__icon">
            <svg class="overview__icon">
                <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-twitter">
                </use>
            </svg>
        </a>
        <a href="whatsapp://send?text=<?php echo get_site_url() ?>" target="_blank" class="overview__icon">
            <svg class="overview__icon">
                <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-whatsapp">
                </use>
            </svg>
        </a>
        <a href="https://telegram.me/share/url?url=<?php echo get_site_url() ?>&text=<?= get_bloginfo() ?>"
            target="_blank" class="overview__icon">
            <svg class="overview__icon">
                <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-telegram">
                </use>
            </svg>
        </a>
        <a href="https://www.instagram.com/?url=<?php echo get_site_url() ?>" target="_blank" class="overview__icon">
            <svg class="overview__icon">
                <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-instagram">
                </use>
            </svg>
        </a>
    </div>

    <div class="overview__date">
        <div class="overview__date-day"><?= date("d") ?></div>
        <div class="overview__date-year"><?= date("M y") ?></div>
    </div>
</div>
<div class="detail">
    <div class="description">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" class="articles">
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
                </article>
                <?php
            endwhile;
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&larr; Previous', 'trillio'),
                'next_text' => __('Next &rarr;', 'trillio'),
            ));

        else : ?>
            <div class="not-found">
                <p class="not-found__text">Sorry, no posts were found!</p>
            </div>
            <?php
        endif;
        ?>
    </div>

    <div class="right-sidebar">
        <?php dynamic_sidebar('sidebar-widget-area'); ?>
    </div>
</div>
<?php get_footer(); ?>