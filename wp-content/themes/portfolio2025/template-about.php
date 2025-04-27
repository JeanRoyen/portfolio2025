<?php
/**
 * Template Name: Template À propos
 */
?>
<?php get_header(); ?>

<?php include('templates/content/flexible.php') ?>

    <h2>Mes outils de travail</h2>
    <div class="icon-carousel">
        <?= load_svg('html5-plain'); ?>
        <?= load_svg('css3-plain'); ?>
        <?= load_svg('javascript-plain'); ?>
        <?= load_svg('typescript-plain'); ?>
        <?= load_svg('npm-original-wordmark'); ?>
        <?= load_svg('php-plain'); ?>
        <?= load_svg('sass-plain'); ?>
        <?= load_svg('wordpress-plain'); ?>
        <?= load_svg('nodejs-plain-wordmark'); ?>
    </div>

<?php get_footer(); ?>