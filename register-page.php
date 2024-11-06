<?php
/*
Template Name: Page d'inscription
*/

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php
                if (!is_user_logged_in()) { // Si l'utilisateur n'est pas connecté
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $errors = register_user(); // Appel de la fonction d'inscription
                        if (is_wp_error($errors)) {
                            echo '<div class="error">';
                            foreach ($errors->get_error_messages() as $error) {
                                echo '<p>' . $error . '</p>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>Inscription réussie. <a href="' . wp_login_url() . '">Connectez-vous ici</a>.</p>';
                        }
                    }
                    ?>
                    <form method="post" action="">
                        <p>
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>" required>
                        </p>

                        <p>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" required>
                        </p>

                        <p>
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" required>
                        </p>

                        <p>
                            <label for="password_confirm">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirm" id="password_confirm" required>
                        </p>

                        <p style="display:flex">
                            <input type="checkbox" name="privacy_policy" id="privacy_policy" value="1" required>
                            <label for="privacy_policy">J'accepte la <a href="<?php echo site_url('/politique-de-confidentialite'); ?>" target="_blank">politique de confidentialité</a></label>
                        </p>

                        <p>
                            <input type="submit" value="S'inscrire">
                        </p>
                    </form>
                <?php
                } else {
                    echo '<p>Vous êtes déjà connecté.</p><a href="' . home_url() . '">Retour à l\'accueil</a>';
                }
                ?>
            </div>

        </article>
    </main>
</div>

<?php
get_footer();

/**
 * Fonction pour gérer l'inscription de l'utilisateur.
 */
function register_user() {
    $username = isset($_POST['username']) ? sanitize_user($_POST['username']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';
    $privacy_policy = isset($_POST['privacy_policy']) ? $_POST['privacy_policy'] : '';

    // Créer un objet WP_Error pour gérer les erreurs
    $errors = new WP_Error();

    // Valider les informations
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm) || empty($privacy_policy)) {
        $errors->add('field', 'Veuillez remplir tous les champs et accepter la politique de confidentialité.');
    }

    if (username_exists($username)) {
        $errors->add('username', 'Ce nom d\'utilisateur est déjà pris.');
    }

    if (!is_email($email)) {
        $errors->add('email_invalid', 'L\'adresse email est invalide.');
    } elseif (email_exists($email)) {
        $errors->add('email', 'Cette adresse email est déjà utilisée.');
    }

    if ($password !== $password_confirm) {
        $errors->add('password_mismatch', 'Les mots de passe ne correspondent pas.');
    }

    // Si pas d'erreurs, enregistrer l'utilisateur
    if (empty($errors->errors)) {
        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            wp_new_user_notification($user_id); // Envoi de la notification par email
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            wp_redirect(home_url());
            exit;
        } else {
            return $user_id; // Retourne les erreurs générées par wp_create_user
        }
    }

    return $errors;
}
?>
