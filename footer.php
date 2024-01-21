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
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v18.0"
    nonce="NVAsGIhW"></script>
<?php wp_footer(); ?>
</body>

</html>