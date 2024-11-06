<?php get_header(); ?>

<div class="match-details">
    <h1><?php the_title(); ?></h1>
    
    <div class="teams">
        <h3>Équipes qui s'affrontent :</h3>
        <p>
            <?php
            $equipe_1 = get_field('equipe_1');
            if ($equipe_1) {
                echo '<strong>Équipe 1 :</strong> ' . esc_html(get_the_title($equipe_1->ID));
            }

            $equipe_2 = get_field('equipe_2');
            if ($equipe_2) {
                echo '<br><strong>Équipe 2 :</strong> ' . esc_html(get_the_title($equipe_2->ID));
            }
            ?>
        </p>
    </div>
    
    <div class="match-time">
        <h3>Heure de début :</h3>
        <p><?php the_field('heure_debut'); ?></p>
    </div>
    
    <div class="join-button">
        <?php if (is_user_logged_in() && current_user_can('read')) : ?>
            <button id="join-match-button" class="btn btn-primary" data-match-id="<?php echo get_the_ID(); ?>">Rejoindre le Match</button>
        <?php else : ?>
            <p>Connectez-vous pour rejoindre le match.</p>
        <?php endif; ?>
    </div>

    <div id="join-message"></div>
</div>

<?php get_footer(); ?>
