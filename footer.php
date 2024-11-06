<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo_valorantarena_footer.svg" alt="Valorant Arena Logo">
        </div>
        <nav class="footer-nav">
          <?php 
            wp_nav_menu ( array (
             'theme_location' => 'primary'
             ) ); ?>
        </nav>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> ValorantArena - Tous droits réservés</p>
        <p><a href="#mentions-legales">Mentions légales</a> | <a href="#confidentialite">Politique de Confidentialité</a> | <a href="#conditions">Conditions générales d'utilisation</a></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
