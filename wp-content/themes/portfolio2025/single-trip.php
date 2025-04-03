<?php get_header(); ?>

    <style type="text/css">
        .sro {
            position: absolute;
            overflow: hidden;
            clip: rect(0 0 0 0);
            height: 1px;
            width: 1px;
            margin: -1px;
            padding: 0;
            border: 0;
        }

        .trip__header {
            height: 400px;
            width: 100%;
            position: relative;
        }

        .trip__back,
        .trip__back:before,
        .trip__head {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .trip__back {
            z-index: 0;
            margin: 0;
            padding: 0;
        }

        .trip__back:before {
            content: '';
            display: block;
            background: rgb(100, 20, 40);
            opacity: 0.6;
        }

        .trip__cover {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .trip__head {
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .trip__container {
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-between;
        }

        .trip__ingredients {
            width: 320px;
            padding: 20px;
            background: #f1f1f1;
            display: flex;
            flex-direction: column-reverse;
        }

        .trip__fig {
            display: block;
            position: relative;
            width: 100%;
            height: 0;
            padding-top: 100%;
            margin: 0;
        }

        .trip__img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .trip__rating {
            display: block;
            width: 150px;
            height: 30px;
            position: relative;
            background: url(/wp-content/themes/portfolio2025/resources/img/etoile.svg);
            background-repeat: repeat-x;
            background-position: 0 0;
        }

        .trip__rating:after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            height: 100%;
            background: url(/wp-content/themes/portfolio2025/resources/img/etoile2.svg);
            background-repeat: repeat-x;
            background-position: 0 0;
        }

        .trip__rating[data-score="1"]:after {
            width: 30px;
        }

        .trip__rating[data-score="2"]:after {
            width: 60px;
        }

        .trip__rating[data-score="3"]:after {
            width: 90px;
        }

        .trip__rating[data-score="4"]:after {
            width: 120px;
        }

        .trip__rating[data-score="5"]:after {
            width: 100%;
        }
    </style>

<?php
// On ouvre "la boucle" (The Loop), la structure de contrôle
// de contenu propre à Wordpress:
if (have_posts()): while (have_posts()): the_post(); ?>

    <div class="trip">

        <header class="trip__header">
            <div class="trip__head">
                <h2><?= get_the_title(); ?></h2>
                <p><?= get_the_excerpt(); ?></p>
                <div class="trip__rating" data-score="<?= $rating = get_field('rating'); ?>">
                    <p class="sro">Nous avons apprécié ce voyage à hauteur de <?= $rating; ?> étoiles sur 5.</p>
                </div>
                <div class="trip__dates">
                    <?php
                    $departure = get_field('departure');
                    $return = get_field('return');
                    if ($return): ?>
                        <p>Du
                            <time datetime="<?= date('c', $departure); ?>"><?= date_i18n('j F Y', $departure); ?></time>
                            au
                            <time datetime="<?= date('c', $return); ?>"><?= date_i18n('j F Y', $return); ?></time>
                            .
                        </p>
                    <?php else: ?>
                        <p>Depuis le
                            <time datetime="<?= date('c', $departure); ?>"><?= date_i18n('j F Y', $departure); ?></time>
                            .
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <figure class="trip__back">
                <?= get_the_post_thumbnail(size: 'trip-header', attr: ['class' => 'trip__cover']); ?>
            </figure>
        </header>

        <div class="trip__container">
            <aside class="trip__ingredients">
                <div>
                    <h3>Points-clés</h3>
                    <p><?= get_field('keypoints'); ?></p>
                </div>
                <figure class="trip__fig">
                    <?= wp_get_attachment_image(get_field('side_img'), size: 'trip-side', attr: ['class' => 'trip__img']); ?>
                </figure>
            </aside>

            <section class="trip__steps">
                <h3>Récit de voyage</h3>
                <div><?= get_field('story'); ?></div>
            </section>
        </div>

    </div>

<?php
    // On ferme "la boucle" (The Loop):
endwhile;
else: ?>
    <p>Cette recette n'existe pas...</p>
<?php endif; ?>
<?php get_footer(); ?>