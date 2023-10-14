<footer class="bottom">
    <div class="lightbox"></div>
    <?php get_template_part('template-parts/popup'); ?>

    <?php wp_nav_menu(array(
        'theme_location' => 'footer',
        'container' => 'nav',
        'container_class' => 'bottom_menu_container',
        'menu_id' => 'bottom_menu',
        'menu_class' => 'bottom_menu',

    )); ?>

</footer>

</body>

</html>