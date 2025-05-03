<?php
/**
 * Template Name: Page Projets
 */
get_header();
?>
<div>
    <h2>Mes projets</h2>
    <p>Découvrez une sélection de mes projets en design web, alliant créativité, ergonomie et performance. Chaque
        réalisation reflète mon engagement à concevoir des interfaces intuitives et esthétiques, adaptées aux besoins
        des utilisateurs. En parallèle, je m’exerce régulièrement à travers des challenges techniques.</p>
</div>



<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$current_filter = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';

$args = [
    'post_type' => 'project',
    'posts_per_page' => 6,
    'paged' => $paged,
];

if ($current_filter !== '') {
    $args['tax_query'] = [
        [
            'taxonomy' => 'project_type',
            'field' => 'slug',
            'terms' => $current_filter,
        ]
    ];
}

$query = new WP_Query($args);

// Récupérer les termes de la taxonomie
$terms = get_terms([
    'taxonomy' => 'project_type',
    'hide_empty' => false,
]);
?>

<div class="project__filter-buttons">
    <a href="<?= esc_url(get_permalink()); ?>"
       class="filter-button <?= ($current_filter === '') ? 'active' : ''; ?>">
        Tous
    </a>

    <?php foreach ($terms as $term): ?>
        <a href="<?= esc_url(get_permalink()) . '?type=' . $term->slug; ?>"
           class="filter-button <?= ($current_filter === $term->slug) ? 'active' : ''; ?>">
            <?= esc_html($term->name); ?>
        </a>
    <?php endforeach;
    ?>
</div>

<div class="project__grid">
    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $image = get_field('image', get_the_ID());
        ?>
        <article class="project-card">
            <a href="<?= get_permalink(); ?>" class="project-card__link">
                <span class="sro">Accéder au projet <?= get_the_title(); ?></span>
            </a>

            <div class="project-card__content">
                <h3 class="project-card__title"><?= get_the_title(); ?></h3>
            </div>

            <figure class="project-card__fig">
                <?= responsive_image($image, ['classes' => 'project-card__thumb', 'lazy' => true]); ?>
            </figure>
        </article>


    <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p>Aucun projet trouvé.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
