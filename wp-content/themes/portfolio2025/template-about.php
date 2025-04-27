<?php
/**
 * Template Name: Template À propos
 */
?>
<?php get_header(); ?>

<?php include('templates/content/flexible.php') ?>

    <section>
        <h2>Mes outils de travail</h2>
        <div class="icon-carousel">
            <?= load_svg('css3-plain'); ?>
            <?= load_svg('javascript-plain'); ?>
            <?= load_svg('html5-plain'); ?>
            <?= load_svg('typescript-plain'); ?>
            <?= load_svg('npm-original-wordmark'); ?>
            <?= load_svg('php-plain'); ?>
            <?= load_svg('sass-original'); ?>
            <?= load_svg('wordpress-plain'); ?>
            <?= load_svg('nodejs-plain-wordmark'); ?>
        </div>
    </section>



<?php get_footer(); ?>