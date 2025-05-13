<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= wp_title('·', false, 'right') . get_bloginfo('name') ?></title>
    <meta name="description" content="Découvrez le portfolio de Jean Royen, développeur web junior passionné, étudiant à la HEPL de Seraing, spécialisé en sites modernes et responsives.">
    <link rel="stylesheet" type="text/css" href="<?= dw_asset('css'); ?>">
    <script src="<?= dw_asset('js') ?>" defer></script>
</head>
<body>
<header>
    <h1 class="sro"><?= get_bloginfo('name') ?></h1>
    <input type="checkbox" id="menu-toggle" class="burger__checkbox" />
    <label for="menu-toggle" class="burger__button">
        <span class="burger__icon"></span>
    </label>

    <nav class="nav">
        <h2 class="sro">Navigation principale</h2>
        <ul class="nav__container">
            <?php
            $links = dw_get_navigation_links('header');
            foreach ($links as $index => $link):
                $is_last = $index === count($links) - 1; // détecte le dernier lien
                $extra_class = $is_last ? 'nav__item--right' : '';
                ?>
                <li class="nav__item nav__item--<?= $link->icon; ?> <?= $extra_class ?>">
                    <a href="<?= $link->href; ?>" class="nav__link"><?= $link->label; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
<main>