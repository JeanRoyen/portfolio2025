</main>
<footer>
    <?php wp_footer(); ?>
    <div>
        <h2>Coordonnées</h2>
        <ul>
            <li>+32 (0) 471 42 08 54</li>
            <li>jeanroyen2@hotmail.com</li>
            <li>Province de Liège</li>
            <li>Belgique</li>
        </ul>
    </div>
    <nav>
        <h2>Me suivre</h2>
        <?php
        $links = dw_get_navigation_links('footer');

        foreach ($links as $link): ?>
            <a class="nav__footer__items" href="<?= esc_url($link->href) ?>">
                <?= esc_html($link->label) ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <div>
        <p>© <?= get_bloginfo('name'); ?></p>
    </div>
</footer>
</body>
</html>