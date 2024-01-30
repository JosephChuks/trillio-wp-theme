<div class="cta">
    <?php dynamic_sidebar('adsense_footer'); ?>
</div>

<div class="legal">
    <div class="legal__copyright">
        &copy; <?= date("Y") ?> <span class="color-primary"><?= get_bloginfo() ?></span> All Rights Reserved
    </div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'footer_menu',
        'menu_class' => 'legal__pages',
    ));
    ?>
</div>

</main>
</div>
</div>
<?php wp_footer(); ?>
</body>

</html>