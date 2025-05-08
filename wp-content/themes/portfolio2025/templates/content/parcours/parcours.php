<?php $headline = get_sub_field('headline') ?>
<?php $experiences = get_sub_field('experiences') ?>
<?php $class = get_sub_field('class') ?>

<section class="">
    <h2 class="section_container_title"><?= $headline ?></h2>
    <div class="parcours__grid <?= $class !== '' ? $class : '' ?>">
        <?php foreach ($experiences as $ex): ?>
            <article class="parcours">
                <h3 class="div_project_h2"><?= $ex['title'] ?></h3>
                <div class="parcours_card">
                    <?= $ex['number'] ?>
                </div>
                <div class="parcours_description">
                    <?= $ex['description'] ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>