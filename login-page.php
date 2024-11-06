<?php
/*
Template Name: Page de connexion
*/

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="login">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php
                if (!is_user_logged_in()) {
                    $args = array(
                        'redirect' => home_url(),
                        'form_id' => 'loginform-custom',
                        'label_username' => __('Nom d\'utilisateur', 'votre-theme'),
                        'label_password' => __('Mot de passe', 'votre-theme'),
                        'label_remember' => __('Se souvenir de moi', 'votre-theme'),
                        'label_log_in' => __('Se connecter', 'votre-theme'),
                        'remember' => true
                    );
                    wp_login_form($args);
                } else {
                    echo '<p>' . __('Vous êtes déjà connecté.', 'votre-theme') . '</p>';
                    wp_loginout(home_url());
                }
                ?>
            </div>
        </article>
    </main>
</div>

<?php
get_footer();