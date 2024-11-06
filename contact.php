<?php
/* Template Name: Page de contact */
get_header();
?>

<div id="primary" class="content-area contact-container">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <h1 class="entry-title">Contactez-nous</h1>
            </header>

            <div class="entry-content">
                <p>Pour toute question ou demande d'information, n'hésitez pas à nous contacter via ce formulaire :</p>
                
                <form method="post" action="">
                    <p>
                        <label for="contact_name">Votre nom</label>
                        <input type="text" name="contact_name" id="contact_name" required>
                    </p>

                    <p>
                        <label for="contact_email">Votre email</label>
                        <input type="email" name="contact_email" id="contact_email" required>
                    </p>

                    <p>
                        <label for="contact_message">Votre message</label>
                        <textarea name="contact_message" id="contact_message" rows="5" required></textarea>
                    </p>

                    <p>
                        <input type="submit" value="Envoyer le message">
                    </p>
                </form>
            </div>

        </article>
    </main>
</div>

<?php
get_footer();
?>
