<?php get_header(); ?>

<section class="presentation">
    <h2 class="presentation__name">Jean Royen</h2>
    <div>
        <h3 class="presentation__title">Web developper - Fullstack</h3>
    </div>
    <nav class="presentation__nav">
        <h3 class="sro">Navigation secondaire</h3>
        <?php
        $links = dw_get_navigation_links('main');
        foreach ($links as $link): ?>
            <a class="presentation__button" href="<?= esc_url($link->href) ?>">
                <?= esc_html($link->label) ?>
            </a>
        <?php endforeach; ?>
    </nav>
</section>

<section class="projects">
    <h2>Projets récents</h2>
    <div class="projects__list">
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
                <article class="project-card">
                    <a href="<?= get_permalink(); ?>" class="project-card__link">
                        <span class="sro">Voir le projet "<?= esc_html(get_the_title()); ?>"</span>
                    </a>

                    <div class="project-card__content">
                        <h3 class="project-card__title"><?= get_the_title(); ?></h3>
                        <p class="project-card__excerpt"><?= get_the_excerpt(); ?></p>
                    </div>

                    <figure class="project-card__fig">
                        <?= responsive_image($image, ['classes' => 'project-card__thumb', 'lazy' => true]) ?>
                    </figure>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else: ?>
            <li>Aucun projet à afficher.</li>
        <?php endif; ?>
    </div>
</section>
<div class="projects__more">
    <a href="<?= esc_url(home_url('/mes-projets/')); ?>" class="btn-dark">
        Voir plus de projets
    </a>
</div>

<?php get_footer(); ?>
