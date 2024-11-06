<?php get_header(); ?>

<section class="hero">
    <div class="hero-content">
        <div class="hero-1">
            <h1 style="font-family: 'ValorantFont', sans-serif;">Bienvenue sur ValorantArena</h1>
            <p>Affrontez les meilleures équipes et devenez des légendes</p>
        </div>
        <p>Rejoignez ValorantArena, un tournoi 100 % dédié aux passionnés de Valorant</p>
        <div class="hero-buttons">
            <a href="/ValorantArena/creation-de-compte" class="btn-primary">Inscrivez-vous</a>
            <a href="<?php echo wp_login_url(); ?>" class="btn-secondary">Connexion</a>
        </div>
    </div>
</section>

<section class="intense-competition">
    <div class="content-wrapper">
        <div class="text-column">
            <p>Plongez dans une compétition intense dans lesquelles stratégie et travail d'équipe sont essentiels.</p>
        </div>
        <div class="image-column">
            <img src="<?php echo get_template_directory_uri(); ?>/images/salle_de_jeu.png" alt="Salle de jeu avec des postes équipés">
        </div>
    </div>
</section>

<section class="team-creation">
    <div class="content-wrapper">
        <div class="image-column">
            <img src="<?php echo get_template_directory_uri(); ?>/images/teammates.png" alt="Équipe lors d'un tournoi">
        </div>
        <div class="text-column">
            <h2>Créez votre équipe et devenez une légende</h2>
            <p>Créez votre équipe, inscrivez-vous et préparez-vous à affronter des adversaires redoutables. Consultez le calendrier des matchs et suivez vos statistiques tout au long du tournoi !</p>
        </div>
    </div>
</section>

<section class="live-action">
    <div class="content-wrapper">
        <div class="text-column">
            <h2>Suivez l'action en direct</h2>
            <p>Suivez l’évolution des équipes, les résultats des matchs, et encouragez vos joueurs favoris dans cette compétition intense !</p>
        </div>
        <div class="image-column">
            <img src="<?php echo get_template_directory_uri(); ?>/images/live-action.jpg" alt="Équipe sur scène pendant une compétition">
        </div>
    </div>
</section>

<section class="next-challenges">
    <div class="content-wrapper">
        <div class="image-column">
            <img src="<?php echo get_template_directory_uri(); ?>/images/next-challenges.jpg" alt="Équipe sur scène pendant une compétition">
        </div>
        <div class="text-column">
            <h2>Ne manquez pas les prochains défis</h2>
            <p>Accès réservé pour la gestion du tournoi. Connectez-vous pour administrer les équipes, planifier les matchs et suivre les résultats.</p>
        </div>
    </div>
</section>

<section class="teams-in-tournament">
    <div class="content-wrapper">
        <div class="text-column">
            <h2>Équipe en lice</h2>
            <p>Découvrez les équipes qui s'affronteront dans ce tournoi épique de Valorant.</p>
            <div><a href="?post_type=equipe" class="btn-primary">Voir les équipes</a></div>
        </div>
        <div class="image-column">
            <img src="<?php echo get_template_directory_uri(); ?>/images/teams-display.jpg" alt="Aperçu des équipes et des rangs du tournoi">
        </div>
    </div>
</section>

<section class="contact-section">
  <h2>CONTACTEZ-NOUS</h2>
  <p>Pour toute question ou demande d'information, n'hésitez pas à nous contacter.</p>
  <a href="/contact" class="contact-button">Formulaire de contact</a>
</section>




<?php get_footer(); ?>
