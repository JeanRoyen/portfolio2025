</main>
<footer>
    <p>©&nbsp;<?= get_bloginfo('name') ?></p>
    <?php wp_nav_menu([
        'theme-location' => 'header',
        'container' => 'nav',
    ]) ?>
    <?php wp_footer(); ?>
</footer>
</body>
</html>