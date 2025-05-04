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
            <?= load_svg('css3-plain', 'Logo CSS3', 'Icône CSS3') ?>
            <?= load_svg('javascript-plain', 'Logo JavaScript', 'Icône JavaScript') ?>
            <?= load_svg('html5-plain', 'Logo HTML5', 'Icône HTML5') ?>
            <?= load_svg('typescript-plain', 'Logo TypeScript', 'Icône TypeScript') ?>
            <?= load_svg('npm-original-wordmark', 'Logo NPM', 'Icône NPM') ?>
            <?= load_svg('php-plain', 'Logo PHP', 'Icône PHP') ?>
            <?= load_svg('sass-original', 'Logo Sass', 'Icône Sass') ?>
            <?= load_svg('wordpress-plain', 'Logo WordPress', 'Icône WordPress') ?>
            <?= load_svg('nodejs-plain-wordmark', 'Logo Node.js', 'Icône Node.js') ?>
        </div>
    </section>


<?php get_footer(); ?>