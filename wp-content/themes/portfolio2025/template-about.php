<?php
/**
 * Template Name: Template À propos
 */
?>
<?php get_header(); ?>

<?php include('templates/content/flexible.php') ?>

    <section class="carousel-container">
        <h2>Mes outils de travail</h2>
        <div class="icon-carousel">
            <?= load_svg('css3-plain', 'Logo CSS3') ?>
            <?= load_svg('javascript-plain', 'Logo JavaScript') ?>
            <?= load_svg('html5-plain', 'Logo HTML5') ?>
            <?= load_svg('typescript-plain', 'Logo TypeScript') ?>
            <?= load_svg('npm-original-wordmark', 'Logo NPM')?>
            <?= load_svg('php-plain', 'Logo PHP') ?>
            <?= load_svg('sass-original', 'Logo Sass') ?>
            <?= load_svg('wordpress-plain', 'Logo WordPress') ?>
            <?= load_svg('nodejs-plain-wordmark', 'Logo Node.js') ?>
        </div>
    </section>


<?php get_footer(); ?>