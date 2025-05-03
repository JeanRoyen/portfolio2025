<?php
$stage_supline = get_field('supline');
$stage_headline = get_field('headline');
$stage_description = get_field('description');
$stage_image = get_field('background_image');
$stage_link = get_field('link');
?>

<section class="trips">
  <h2 class="trips__headline">Mes voyages récents</h2>
  <div class="trips__container">
    <?php
    $travels = new WP_Query([
      'post_type' => 'travel',
      'order' => 'DESC',
      'orderby' => 'date',
      'posts_per_page' => 8,
    ]);

    if ($travels->have_posts()): while ($travels->have_posts()): $travels->the_post(); ?>
      <article class="trip">
        <a href="<?= get_the_permalink(); ?>" class="trip__link">
          <span class="screenreader__only">Découvrir le voyage <?= get_the_title(); ?></span>
        </a>
        <div class="trip__card">
          <div class="trip__head">
            <h3 class="trip__title"><?= get_the_title(); ?></h3>
            <p class="trip__time">
              <time datetime="<?= date('c', $departure = get_field('departure')); ?>"><?= date_i18n('F Y',
                  $departure); ?></time>
            </p>
            <p class="trip__card--placeholder"><?= __hepl('Accéder à ce voyage') ?></p>
          </div>
          <figure class="trip__fig">
            <?= get_the_post_thumbnail(size: 'medium', attr: ['class' => 'trip__img']); ?>
          </figure>
        </div>
      </article>
    <?php endwhile; else: ?>
      <p class="trip__placeholder">Je n'ai pas de voyages récents à montrer pour le moment...</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</section>
