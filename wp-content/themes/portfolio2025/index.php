<?php get_header(); ?>

<?php

// On ouvre la boucle (The Loop), la structure de contrôle
// de contenu propre à WordPress

if (have_posts()) : while (have_posts()) : the_post(); ?>

    <h2><?= get_the_title() ?></h2>

    <div>
        <?php the_content() ?>
    </div>

<?php endwhile; else: ?>
    <p>Pas de contenu à afficher</p>
<?php endif; ?>
<?php get_footer(); ?>