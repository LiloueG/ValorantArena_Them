<?php
function projetmmi3_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'projetmmi3'),
    ));
}
add_action('after_setup_theme', 'projetmmi3_setup');

function projetmmi3_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'projetmmi3_scripts');

function remplacer_bouton_connexion_menu($items, $args) {
    // Vérifier si l'utilisateur est connecté
    if (is_user_logged_in()) {
        // Si l'utilisateur est connecté, ajouter un bouton de déconnexion
        $logout_url = wp_logout_url(home_url()); // URL de déconnexion
        $items .= '<li class="menu-item"><a href="' . $logout_url . '">Déconnexion</a></li>';
    } else {
        // Si l'utilisateur n'est pas connecté, ajouter un bouton de connexion vers la page personnalisée
        $login_page_url = home_url('/connexion'); // URL de ta page de connexion personnalisée (slug de la page)
        $items .= '<li class="menu-item"><a href="' . $login_page_url . '">Connexion</a></li>';
    }
    
    return $items;
}

add_filter('wp_nav_menu_items', 'remplacer_bouton_connexion_menu', 10, 2);


// Autres fonctions et déclarations...

function ajouter_bouton_inscription_menu($items, $args) {
    // Vérifier si l'utilisateur est connecté
    if (!is_user_logged_in()) {
        // Si l'utilisateur n'est pas connecté, ajouter un bouton d'inscription
        $register_url = get_permalink(get_page_by_path('creation-de-compte')); // Remplace 'page-register' par le slug de ta page d'inscription
        $items .= '<li class="menu-item"><a href="' . esc_url($register_url) . '">Inscription</a></li>';
    }
    
    return $items;
}

add_filter('wp_nav_menu_items', 'ajouter_bouton_inscription_menu', 10, 2);

add_action('wp_ajax_join_match', 'join_match_function');
add_action('wp_ajax_nopriv_join_match', 'join_match_function');

function join_match_function() {
    // Vérifie si l'utilisateur est connecté
    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Vous devez être connecté pour rejoindre un match.'));
        wp_die();
    }

    // Récupère l'ID de l'utilisateur et l'ID du match
    $current_user = wp_get_current_user();
    $match_id = intval($_POST['match_id']);
    
    // Vérifie si le match existe
    if (!$match_id || get_post_type($match_id) !== 'match') {
        wp_send_json_error(array('message' => 'Match non trouvé.'));
        wp_die();
    }

    // Récupère les équipes déjà inscrites
    $equipes_rejointes = get_field('equipes_rejointes', $match_id);

    // Vérifie si l'utilisateur a déjà rejoint
    foreach ($equipes_rejointes as $equipe) {
        if ($equipe->ID == $current_user->ID) {
            wp_send_json_error(array('message' => 'Votre équipe est déjà inscrite.'));
            wp_die();
        }
    }

    // Ajoute l'équipe de l'utilisateur à la liste des équipes inscrites
    $equipes_rejointes[] = $current_user->ID;
    update_field('equipes_rejointes', $equipes_rejointes, $match_id);

    wp_send_json_success(array('message' => 'Votre équipe a rejoint le match avec succès.'));
    wp_die();
}


function valorantarena_enqueue_scripts() {
    // Enregistre le script
    wp_enqueue_script('join-match-script', get_template_directory_uri() . '/js/join-match.js', array('jquery'), null, true);

    // Passe l'URL d'admin-ajax.php au script pour les appels AJAX
    wp_localize_script('join-match-script', 'valorantarenaAjax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'valorantarena_enqueue_scripts');
