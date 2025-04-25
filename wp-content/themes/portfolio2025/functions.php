<?php

// Charger la configuration de champs d'ACF :
include_once('acf.php');

// Activer la session PHP
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Désactiver l'éditeur de contenu en "blocks" de Wordpress, aussi appelé
// "Gutenberg", pour revenir à une version plus ancienne mais qui nous
// convient mieux en tant que développeurs de thèmes:

// Disable Gutenberg on the back end.
add_filter('use_block_editor_for_post', '__return_false');
// Disable Gutenberg for widgets.
add_filter('use_widgets_block_editor', '__return_false');
// Disable front-end style injections
add_action('wp_enqueue_scripts', function() {
    // Remove CSS on the front end.
    wp_dequeue_style('wp-block-library');
    // Remove Gutenberg theme.
    wp_dequeue_style('wp-block-library-theme');
    // Remove inline global CSS on the front end.
    wp_dequeue_style('global-styles');
}, 20);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_print_comments');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_generator');

function enqueue_assets_from_vite_manifest(): void
{
    $manifestPath = get_theme_file_path('public/.vite/manifest.json');

    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);

        // Vérifier et ajouter le fichier JavaScript
        if (isset($manifest['wp-content/themes/portfolio2025/resources/js/main.js'])) {
            wp_enqueue_script('portfolio2025',
                get_theme_file_uri('public/' . $manifest['wp-content/themes/portfolio2025/resources/js/main.js']['file']), [], null, true);
        }

        // Vérifier et ajouter le fichier CSS
        if (isset($manifest['wp-content/themes/portfolio2025/resources/css/styles.scss'])) {
            wp_enqueue_style('portfolio2025',
                get_theme_file_uri('public/' . $manifest['wp-content/themes/portfolio2025/resources/css/styles.scss']['file']));
        }
    }
}

//enqueue_assets_from_vite_manifest();

// 1. Charger un fichier "public" (asset/image/css/script/...) pour le front-end sans que cela ne s'applique à l'admin.
function dw_asset(string $file): string
{
    $manifestPath = get_theme_file_path('public/.vite/manifest.json');

    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);

        if (isset($manifest['wp-content/themes/portfolio2025/resources/js/main.js']) && $file === 'js') {
            return get_theme_file_uri('public/' . $manifest['wp-content/themes/portfolio2025/resources/js/main.js']['file']);
        }

        if (isset($manifest['wp-content/themes/portfolio2025/resources/css/styles.scss']) && $file === 'css') {
            return get_theme_file_uri('public/' . $manifest['wp-content/themes/portfolio2025/resources/css/styles.scss']['file']);
        }
    }

    return get_template_directory_uri() . '/public/' . $file;
}

// Activer l'utilisation d'images "de couverture" sur les post_types customs.
add_theme_support('post-thumbnails', ['recipe','trip']);

// Enregistrer de nouveaux "types de contenus" qui seront stockés dans la table
// "wp_posts", avec un identifiant de type spécifique dans la colonne "post_type":

register_post_type('project', [
    'label' => 'Projets',
    'description' => 'Mes projets',
    'public' => true,
    'menu_position' => 7,
    'menu_icon' => 'dashicons-media-document',
    'rewrite' => [
        'slug' => 'projects',
    ],
    'supports' => ['title'],
]);

register_taxonomy('project_type', 'project', [
    'labels' => [
        'name' => 'Types de projets',
        'singular_name' => 'Type de projet',
    ],
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'rewrite' => ['slug' => 'type'],
]);


// Enregistrer les menus de navigation en fonction de l'endroit où ils sont exploités :

register_nav_menu('header', 'Le menu de navigation principal en haut de la page.');
register_nav_menu('main', 'Menu principal dans le main');
register_nav_menu('main_sub', 'Menu secondaire dans le main');
register_nav_menu('footer', 'Le menu de navigation de fin de page.');

// Créer une nouvelle fonction qui permet de retourner un menu de navigation formaté en un
// tableau d'objets afin de pouvoir l'afficher à notre guise dans le template.

function dw_get_navigation_links(string $location): array
{
    // Récupérer l'objet WP pour le menu à la location $location
    $locations = get_nav_menu_locations();

    if(! isset($locations[$location])) {
        return [];
    }

    $nav_id = $locations[$location];
    $nav = wp_get_nav_menu_items($nav_id);

    // Transformer le menu en un tableau de liens, chaque lien étant un objet personnalisé

    $links = [];

    foreach ($nav as $post) {
        $link = new stdClass();
        $link->href = $post->url;
        $link->label = $post->title;
        $link->icon = get_field('icon', $post);

        $links[] = $link;
    }

    // Retourner ce tableau d'objets (liens).

    return $links;
}

// Ajouter une fonctionnalité de formulaire de contact totalement sur-mesure:

add_action('admin_post_dw_contact_form_submit', 'dw_handle_contact_form_submit');
add_action('admin_post_nopriv_dw_contact_form_submit', 'dw_handle_contact_form_submit');

require_once(__DIR__.'/forms/ContactForm.php');

register_post_type('contact_message', [
    'label' => 'Messages',
    'description' => 'Les formulaires envoyés sur la page de contact',
    'public' => false,
    'show_ui' => true,
    'menu_position' => 10,
    'menu_icon' => 'dashicons-email',
    'supports' => ['title','editor'],
]);

function dw_handle_contact_form_submit()
{
    (new DW_Theme\Forms\ContactForm())
        ->rule('firstname', 'required')
        ->rule('lastname', 'required')
        ->rule('email', 'required')
        ->rule('email', 'valid_email')
        ->rule('subject', 'required')
        ->rule('message', 'required')
        ->rule('message', 'no_test')
        ->sanitize('firstname', 'sanitize_text_field')
        ->sanitize('lastname', 'sanitize_text_field')
        ->sanitize('email', 'sanitize_text_field')
        ->sanitize('subject', 'sanitize_text_field')
        ->sanitize('message', 'sanitize_textarea_field')
        ->handle($_POST);
}

function responsive_image($image, $settings): bool|string
{
    if (empty($image)) {
        return '';
    }

    $image_id = '';

    if (is_numeric($image)) {
        // si c'est un nombre, on considère que cela s'agit d'un ID
        $image_id = $image;
    } elseif (is_array($image) && isset($image['ID'])) {
        // Si c'est un tableau associatif contenant la clé ID, on récupère cet ID
        $image_id = $image['ID'];
    } else {
        // Générer un tag img par défaut
    }

// Récupération des informations de l'image depuis la base de données.
    $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); // Attribut alt
    $image_post = get_post($image_id); // Object WP_Post de l'image
    $title = $image_post->post_title ?? '';
    $name = $image_post->post_name ?? '';

// Récupération des URLS et attributs pour l'image en taille "full"
// Wordpress génère automatiquement un srcset basé sur les tailles existantes
    $src = wp_get_attachment_image_url($image_id, 'full');
    $srcset = wp_get_attachment_image_srcset($image_id, 'full');
    $sizes = wp_get_attachment_image_sizes($image_id, 'full');

// Gestion de l'attribut de chargement "lazy" ou "eager" selon les paramètres.
    $lazy = $settings['lazy'] ?? 'eager';

// Gestion des classes (si des classes sont fournies dans $settings).
    $classes = '';
    if (!empty($settings['classes'])) {
        $classes = is_array($settings['classes']) ? implode(' ', $settings['classes']) : $settings['classes'];
    }

    ob_start();
    ?>
    <picture>
        <!-- Ici, vous pouvez ajouter manuellement des balises <source> pour d'autres formats (WebP, AVIF, etc.)
             si ces formats sont disponibles via un plugin ou un traitement personnalisé. -->
        <img
            src="<?= esc_url($src) ?>"
            alt="<?= esc_attr($alt) ?>"
            loading="<?= esc_attr($lazy) ?>"
            srcset="<?= esc_attr($srcset) ?>"
            sizes="<?= esc_attr($sizes) ?>"
            class="<?= esc_attr($classes) ?>">
    </picture>
    <?php
    return ob_get_clean();
}
