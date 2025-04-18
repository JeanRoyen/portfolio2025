<?php get_header(); ?>

    <?php 
    // On ouvre "la boucle" (The Loop), la structure de contrôle
    // de contenu propre à Wordpress:
    if(have_posts()): while(have_posts()): the_post(); ?>

        <h2><?= get_the_title(); ?></h2>

        <p><?= get_the_excerpt(); ?></p>

        <div class="recipe">
            <aside class="recipe__ingredients">
                <div>
                    <h3>Ingrédients</h3>
                    <p>À compléter</p>
                    <section>
                        <h4>Quand manger&nbsp;?</h4>
                        <?php if($courses = get_the_terms(get_the_ID(), 'course')): ?>
                        <ul>
                            <?php foreach($courses as $term): ?>
                            <li><?= $term->name; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p>Quand vous voulez&nbsp;!</p>
                        <?php endif; ?>
                    </section>

                    <section>
                        <h4>Pour quel régime&nbsp;?</h4>
                        <?php if($diets = get_the_terms(get_the_ID(), 'diet')): ?>
                        <ul>
                            <?php foreach($diets as $term): ?>
                            <li><?= $term->name; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p>Aucun régime particulier</p>
                        <?php endif; ?>
                    </section>
                </div>
                <figure class="recipe__fig">
                    <?= get_the_post_thumbnail(size: 'large', attr: ['class' => 'recipe__img']); ?>
                </figure>
            </aside>

            <section class="recipe__steps">
                <h3>Étapes</h3>
                <div><?php the_content(); ?></div>
            </section>

        </div>

    <?php
    // On ferme "la boucle" (The Loop):
    endwhile; else: ?>
    <p>Cette recette n'existe pas.</p>
    <?php endif; ?>
    <style type="text/css">
        .related {
            background: #f1f1f1;
        }
        .related__container {
            display: flex;
            justify-content: flex-start;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .recipe {
            width: 25%;
            display: block;
            position: relative;
        }
        .recipe__link {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .recipe__card {
            display: block;
            position: relative;
            z-index: 0;
            background: white;
            padding: 1em;
        }
        .recipe__title {
            margin: 0;
        }
        .recipe__fig {
            width: auto;
        }
        .recipe__img {
            width: 100%;
        }
        .sro {
        position: absolute; 
        overflow: hidden; 
        clip: rect(0 0 0 0); 
        height: 1px; width: 1px; 
        margin: -1px; 
        padding: 0; 
        border: 0; 
        }
    </style>
    <section class="related">
        <h2 class="related__title">Autres recette qui pourraient vous intéresser...</h2>
        <div class="related__container">
            <?php
            $recipes = new WP_Query([
                'post_type' => 'recipe',
                'orderby' => 'rand',
                'posts_per_page' => 4,
                'post__not_in' => [$post->ID], // Toutes les recettes possibles, sauf celle de la page courante ($post est une variable globale à cette page, représentant la recette en cours).

                // On filtre sur les "$course" courants pour obtenir des résultats similaires:
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => 'course',
                        'field' => 'term_id',
                        'terms' => array_map(fn($course) => $course->term_id, $courses),
                        // OU (même chose, sans "arrow function" de PHP 8.3) :
                        // 'term' => array_map(function($course) {
                        //     return $course->ID;
                        // }, $courses),
                        'include_children' => true,
                        'operator' => 'IN'
                    ]
                ],
            ]);

            if($recipes->have_posts()): while($recipes->have_posts()): $recipes->the_post(); ?>
            <article class="recipe">
                <a href="<?= get_the_permalink(); ?>" class="recipe__link"><span class="sro">Voir la recette "<?= get_the_title(); ?>"</span></a>
                <div class="recipe__card">
                    <h3 class="recipe__title"><?= get_the_title(); ?></h3>
                    <figure class="recipe__fig">
                        <?= get_the_post_thumbnail(size: 'medium', attr: ['class' => 'recipe__img']); ?>
                    </figure>
                </div>
            </article>
            <?php endwhile; endif; ?>
        </div>
    </section>
<?php get_footer(); ?>