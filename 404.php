<?php get_header(); ?>
<div class="overview">
    <h1 class="overview__heading">
        404 Page not found!
    </h1>
    <div class="overview__date">
        <div class="overview__date-day"><?= date("d") ?></div>
        <div class="overview__date-year"><?= date("M y") ?></div>
    </div>
</div>
<div class="detail">
    <div class="description">
        <div class="not-found">
            <p class="not-found__text">Page not found!</p>
            <a href="<?php echo get_site_url() ?>" class="btn btn--primary">HOME</a>
        </div>
    </div>

    <div class="right-sidebar">
        <?php dynamic_sidebar('sidebar-widget-area'); ?>
    </div>
</div>
<?php get_footer(); ?>