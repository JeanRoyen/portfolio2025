<?php get_header(); ?>
<div class="single-project">
    <?php include('templates/content/flexible.php') ?>
</div>
<div>
    <h2 class="others__title">Mes autres projets</h2>
    <div class="div_item_project">
        <?php
        $other_projects = new WP_Query([
            'post_type' => 'project',
            'orderby' => 'rand',
            'posts_per_page' => 2,
            'post__not_in' => [$post->ID]
        ]);

        if ($other_projects->have_posts()): while ($other_projects->have_posts()):
            $other_projects->the_post();
            $title = get_the_title();
            $image = get_field('image', get_the_ID());
            $text = get_field('text', get_the_ID());
            $permalink = get_the_permalink();
            ?>
            <a href="<?= $permalink; ?>" class="project__link">
                <article class="projects">
                    <div class="div__card__container">
                        <h3 class="__header__item"><?= $title ?></h3>
                        <?= responsive_image($image, ['classes' => 'story__fig', 'lazy' => true]) ?>
                    </div>
                </article>
            </a>

        <?php endwhile; else: ?>
            <p>Je n'ai aucun projet a vous montrer.</p>
        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>

