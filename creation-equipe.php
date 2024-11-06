<?php
/* Template Name: CreationEquipe */
get_header();

// Traitement du formulaire de soumission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_team'])) {
    // Valider le nonce pour la sécurité
    if (!isset($_POST['create_team_nonce']) || !wp_verify_nonce($_POST['create_team_nonce'], 'create_team_action')) {
        wp_die('Vérification de sécurité échouée.');
    }

    $team_name = sanitize_text_field($_POST['team_name']);
    $player_one = intval($_POST['player_one']);
    $player_two = intval($_POST['player_two']);
    $player_three = intval($_POST['player_three']);

    // Vérifier l'upload du logo
    if (!empty($_FILES['team_logo']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $upload_overrides = array('test_form' => false);
        $team_logo = wp_handle_upload($_FILES['team_logo'], $upload_overrides);

        if (isset($team_logo['file'])) {
            // Créer un nouveau post de type 'equipes'
            $new_team_id = wp_insert_post(array(
                'post_title' => $team_name,
                'post_type' => 'equipes',
                'post_status' => 'publish'
            ));

            if ($new_team_id) {
                // Ajouter le logo en tant qu'image à la bibliothèque des médias
                $wp_upload_dir = wp_upload_dir();
                $attachment = array(
                    'guid' => $wp_upload_dir['url'] . '/' . basename($team_logo['file']),
                    'post_mime_type' => $team_logo['type'],
                    'post_title' => sanitize_file_name(basename($team_logo['file'])),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attachment_id = wp_insert_attachment($attachment, $team_logo['file'], $new_team_id);

                // Inclure les fonctions de génération des métadonnées
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attach_data = wp_generate_attachment_metadata($attachment_id, $team_logo['file']);
                wp_update_attachment_metadata($attachment_id, $attach_data);

                // Assigner le logo à l'équipe
                if (!is_wp_error($attachment_id)) {
                    update_field('logo_equipe', $attachment_id, $new_team_id);
                }

                // Ajouter les champs personnalisés avec ACF pour les joueurs
                update_field('membre_1', $player_one, $new_team_id);
                update_field('membre_2', $player_two, $new_team_id);
                update_field('membre_3', $player_three, $new_team_id);

                echo '<p>Équipe créée avec succès !</p>';
            } else {
                echo '<p>Erreur lors de la création de l\'équipe.</p>';
            }
        } else {
            echo '<p>Erreur lors du téléchargement du logo de l\'équipe.</p>';
        }
    } else {
        echo '<p>Veuillez ajouter un logo pour l\'équipe.</p>';
    }
}

?>

<div class="creation-equipe-container">
    <h1>Créer une nouvelle équipe</h1>

    <form id="creation-equipe-form" method="post" action="<?php echo esc_url(get_permalink()); ?>" enctype="multipart/form-data">
        <?php wp_nonce_field('create_team_action', 'create_team_nonce'); ?>
        <!-- Nom de l'équipe -->
        <label for="team_name">Nom de l'équipe :</label>
        <input type="text" name="team_name" id="team_name" placeholder="Nom de l'équipe" required>

        <!-- Logo de l'équipe -->
        <label for="team_logo">Logo de l'équipe :</label>
        <input type="file" name="team_logo" id="team_logo" accept="image/*">

        <!-- Sélection des joueurs -->
        <label for="player_one">Sélectionner Joueur 1 :</label>
        <select name="player_one" id="player_one" required>
            <option value="">Sélectionner un joueur</option>
            <?php
            $users = get_users();
            foreach ($users as $user) {
                echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
            }
            ?>
        </select>

        <label for="player_two">Sélectionner Joueur 2 :</label>
        <select name="player_two" id="player_two" required>
            <option value="">Sélectionner un joueur</option>
            <?php
            foreach ($users as $user) {
                echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
            }
            ?>
        </select>

        <label for="player_three">Sélectionner Joueur 3 :</label>
        <select name="player_three" id="player_three" required>
            <option value="">Sélectionner un joueur</option>
            <?php
            foreach ($users as $user) {
                echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
            }
            ?>
        </select>

        <input type="submit" name="submit_team" value="Créer l'équipe">
    </form>
</div>

<?php get_footer(); ?>