<!DOCTYPE html>
<html lang="<?= __hepl('fr') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= wp_title('·', false, 'right') . get_bloginfo('name') ?></title>
    <?php wp_head(); ?>
</head>
<body>
<header>
    <h1><?= get_the_title() ?></h1>
    <p>
        <?= get__option('options_company_name') ?>
    </p>
    <nav class="nav">
        <h2 class="sro"><?= __hepl('Navigation principale') ?></h2>
        <ul class="nav__container">
            <?php foreach (dw_get_navigation_links('header') as $link): ?>
                <li class="nav__item nav__item--<?= $link->icon; ?>">
                    <a href="<?= $link->href; ?>" class="nav__link"><?= $link->label; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="languages">
            <ul class="languages__container">
                <?php foreach (pll_the_languages(['raw' => true]) as $lang): ?>
                    <li class="languages__item<?= $lang['current_lang'] ? ' languages__item--current' : '' ?>">
                        <a href="<?= $lang['url'] ?>" lang="<?= $lang['locale'] ?>" hreflang="<?= $lang['locale'] ?>"
                           class="languages__link"><?= $lang['name'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</header>
<main>