<?php get_header(); ?>
    <h2>Bienvenue sur mon site&nbsp;!</h2>

<?php

// On ouvre la boucle (The Loop), la structure de contrôle
// de contenu propre à WordPress

if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div>
        <?php the_content() ?>
    </div>

<?php endwhile; else: ?>
    <p>Pas de contenu à afficher</p>
<?php endif; ?>

    <section>
        <?php
        $trips = new WP_Query([
            'post_type' => 'trip',
            'order' => 'DESC',
            'orderby' => 'date',
            'post_per_page' => 8,
        ]);
        if ($trips->have_posts()): while ($trips->have_posts()):$trips->the_post(); ?>
            <article class="story">
                <a href="#" class="story__link">
                    <span class="sro">Découvrez mon voyage <?= get_the_title(); ?></span>
                </a>
                <div>

                </div>
            </article>
        <?php endwhile; ?>
        <?php endif ?>

    </section>
<?php get_footer(); ?>