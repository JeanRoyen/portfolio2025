<?php get_header(); ?>

    <aside>
        <h2>Bienvenue sur mon site&nbsp;!</h2>
    </aside>
    <?php 
    // On ouvre "la boucle" (The Loop), la structure de contrôle
    // de contenu propre à Wordpress:
    if(have_posts()): while(have_posts()): the_post(); ?>

        <div><?= get_the_content(); ?></div>

    <?php
    // On ferme "la boucle" (The Loop):
    endwhile; else: ?>
    <p>La page est vide.</p>
    <?php endif; ?>
    <section>
        <h2>Mes voyages récents</h2>
        <div class="trips">
            <?php
            $travels = new WP_Query([
                'post_type' => 'travel',
                'order' => 'DESC',
                'orderby' => 'date',
                'posts_per_page' => 8,
            ]);

            if($travels->have_posts()): while($travels->have_posts()): $travels->the_post(); ?>
                <article class="trip">
                    <a href="<?= get_the_permalink(); ?>" class="trip__link">
                        <span class="sro">Découvrir le voyage <?= get_the_title(); ?></span>
                    </a>
                    <div class="trip__card">
                        <header class="trip__head">
                            <h3 class="trip__title"><?= get_the_title(); ?></h3>
                            <p><time datetime="<?= date('c', $departure = get_field('departure')); ?>"><?= date_i18n('F Y', $departure); ?></time></p>
                        </header>
                        <figure class="trip__fig">
                            <?= get_the_post_thumbnail(size: 'medium', attr: ['class' => 'trip__img']); ?>
                        </figure>
                    </div>
                </article>
            <?php endwhile; else: ?>
                <p>Je n'ai pas de voyages récents à montrer pour le moment...</p>
            <?php endif; ?>
        </div>
    </section>
<?php get_footer(); ?>
