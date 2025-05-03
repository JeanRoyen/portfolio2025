<?php $headline = get_sub_field('headline') ?>
<?php $text = get_sub_field('text') ?>
<?php $class = get_sub_field('cs_class') ?>

<div class="div_container_section">
    <section class="section_container <?= $class !== '' ? $class : '' ?>">
        <?php if ($headline !== '' && isset($headline)): ?>
            <h2 class="div_project_h2">
                <?= $headline ?>
            </h2>
        <?php endif; ?>
        <div class="parcours_card">
            <?php if ($text !== '' && isset($text)): ?>
            <div class="div_project_text">
                <?= $text ?>
            </div>
        </div>
    <?php endif; ?>
        <?php if (!empty($link)): ?>
            <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"
               title="<?= $link['title'] ?>"><?= $link['title'] ?></a>
        <?php endif; ?>
    </section>
</div>