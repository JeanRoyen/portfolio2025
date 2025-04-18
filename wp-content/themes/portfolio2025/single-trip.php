<?php get_header(); ?>

    <?php
    // On ouvre "la boucle" (The Loop), la structure de contrôle
    // de contenu propre à Wordpress:
    if(have_posts()): while(have_posts()): the_post(); ?>

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

                        if($return): ?>
                        <p>Du <time datetime="<?= date('c', $departure); ?>"><?= date_i18n('j F Y', $departure); ?></time> au <time datetime="<?= date('c', $return); ?>"><?= date_i18n('j F Y', $return); ?></time>.</p>
                        <?php else: ?>
                        <p>Depuis le <time datetime="<?= date('c', $departure); ?>"><?= date_i18n('j F Y', $departure); ?></time>.</p>
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
                        <div class="wysiwyg">
                            <?= get_field('keypoints'); ?>
                        </div>
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
    endwhile; else: ?>
        <p>Cette recette n'existe pas...</p>
    <?php endif; ?>
<?php get_footer(); ?>