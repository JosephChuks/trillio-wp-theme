<?php get_header(); ?>

<div class="overview">
    <h1 class="overview__heading">
        <?php the_title(); ?>
    </h1>
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
                <div class="description__article">
                    <div class="description__article-header">
                        <div class="description__artcile-meta"><span class="color-primary"><?php the_title(); ?></span>
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
                        </div>
                    </article>
                </div>
                <?php
            endwhile;
        else : ?>
            <div class="not-found">
                <p class="not-found__text">Sorry, no post found!</p>
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