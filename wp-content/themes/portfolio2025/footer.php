</main>
<footer>
    <?php wp_footer(); ?>
    <section>
        <h2>Coordonnées</h2>
        <ul>
            <li>+32 (0) 471 42 08 54</li>
            <li>jeanroyen2@hotmail.com</li>
            <li>Province de Liège</li>
            <li>Belgique</li>
        </ul>
    </section>
    <nav class="nav__bottom__container">
        <h2>Me suivre</h2>
        <?php
        $links = dw_get_navigation_links('footer'); ?>
        <ul>
            <?php
            foreach ($links as $link): ?>
                <li><a class="nav__footer__items" href="<?= esc_url($link->href) ?>">
                        <?= esc_html($link->label) ?>
                    </a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</footer>
</body>
</html>