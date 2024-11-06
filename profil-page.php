<?php
/* Template Name: ModifierProfil */
get_header();

// Récupérer les informations de l'utilisateur actuellement connecté
$current_user = wp_get_current_user();

// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!$current_user->ID) {
    wp_redirect(wp_login_url());
    exit;
}

// Traitement du formulaire de modification du profil
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    // Valider le nonce pour la sécurité
    if (!isset($_POST['update_profile_nonce']) || !wp_verify_nonce($_POST['update_profile_nonce'], 'update_profile_action')) {
        wp_die('Vérification de sécurité échouée.');
    }

    // Mettre à jour le profil de l'utilisateur
    $user_id = $current_user->ID;
    $user_data = array(
        'ID'           => $user_id,
        'user_email'   => sanitize_email($_POST['email']),
        'display_name' => sanitize_text_field($_POST['display_name'])
    );
    
    if (!empty($_POST['password'])) {
        if ($_POST['password'] === $_POST['confirm_password']) {
            $user_data['user_pass'] = $_POST['password'];
        } else {
            echo '<p>Les mots de passe ne correspondent pas.</p>';
        }
    }

    $user_id = wp_update_user($user_data);
    
    if (!is_wp_error($user_id)) {
        echo '<p>Profil mis à jour avec succès.</p>';
    } else {
        echo '<p>Erreur lors de la mise à jour du profil : ' . $user_id->get_error_message() . '</p>';
    }
}
?>

<div class="edit-profile-container">
    <h1>Modifier votre profil</h1>

    <form id="edit-profile-form" method="post" action="">
        <!-- Nom affiché -->
        <label for="display_name">Nom affiché :</label>
        <input type="text" name="display_name" id="display_name" value="<?php echo esc_attr($current_user->display_name); ?>" required>

        <!-- Email -->
        <label for="email">Adresse email :</label>
        <input type="email" name="email" id="email" value="<?php echo esc_attr($current_user->user_email); ?>" required>

        <!-- Mot de passe -->
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password">

        <!-- Confirmation du mot de passe -->
        <label for="confirm_password">Confirmer le mot de passe :</label>
        <input type="password" name="confirm_password" id="confirm_password">

        <?php wp_nonce_field('update_profile_action', 'update_profile_nonce'); ?>
        <input type="submit" name="update_profile" value="Mettre à jour le profil">
    </form>
</div>

<?php get_footer(); ?>