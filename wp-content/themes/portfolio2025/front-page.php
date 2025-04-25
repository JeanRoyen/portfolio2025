<?php get_header(); ?>

<section>
    <h2>Jean Royen</h2>
    <div>
        <h3>Web developper - Fullstack</h3>
    </div>
    <nav>
        <?php
        $links = dw_get_navigation_links('main');

        foreach ($links as $link): ?>
            <a class="nav__main__container" href="<?= esc_url($link->href) ?>">
                <?= esc_html($link->label) ?>
            </a>
        <?php endforeach; ?>
    </nav>
</section>
<div>
    <p>Scroller pour voir plus</p>
</div>
<section class="projects">
    <h2>Projets récents</h2>
    <ul class="projects__list">
        <?php
        $projects = new WP_Query([
            'post_type' => 'project',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
        ]);
        if ($projects->have_posts()):
            while ($projects->have_posts()): $projects->the_post();
                $image = get_field('image', get_the_ID());
                ?>
                <li class="project">
                    <a href="<?= get_permalink(); ?>" class="project__link">
                        <?php if (!empty($image)): ?>
                            <div class="project__thumb">
                                <?= responsive_image($image, ['classes' => 'test', 'lazy' => true]) ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="project__title"><?= get_the_title(); ?></h3>
                    </a>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        else: ?>
            <li>Aucun projet à afficher.</li>
        <?php endif; ?>
    </ul>
</section>
<div class="nav__sub__container">
    <?php
    $links = dw_get_navigation_links('main_sub');

    foreach ($links as $link): ?>
        <a class="nav__sub__items" href="<?= esc_url($link->href) ?>">
            <?= esc_html($link->label) ?>
        </a>
    <?php endforeach; ?>
</div>
<?php get_footer(); ?>
