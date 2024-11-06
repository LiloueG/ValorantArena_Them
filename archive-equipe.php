<?php get_header(); ?>

<div class="equipes">
    <?php
    if (have_posts()) : 
        while (have_posts()) : the_post(); ?>
            <article class="membre">
                <div class="membre-thumbnail">
                    <?php $img_equipe = get_field('img_equipe'); ?>
                    <?php if ($img_equipe) : ?>
                        <img src="<?php echo esc_url($img_equipe['url']); ?>" alt="<?php echo esc_attr($img_equipe['alt']); ?>" />
                    <?php endif; ?>
                </div>
                <div>
                    <h1><?php the_title(); ?></h1> <!-- Afficher le nom de l'équipe ici -->
                    <div class="membre-content">
                    <div class="membre-details">
                        <h3>Nombre de membres :</h3>
                        <p>
                            <?php
                            $member_count = 0;
                            // Compter le nombre de membres dans l'équipe
                            for ($i = 1; $i <= 4; $i++) {
                                $field_key = 'joueurs_' . $i; // Le nom du champ utilisateur
                                $user_id = get_field($field_key); // Récupérer l'ID de l'utilisateur
                                if ($user_id) {
                                    $member_count++;
                                }
                            }
                            echo esc_html($member_count) . ' membres';
                            ?>
                        </p>
                    </div>
                </div>

                    <div class="description">
                        <?php the_content(); // Afficher la description de l'équipe ?>
                    </div>
                </div>
            </article>
        <?php endwhile;
    else : ?>
        <p>Aucune information d'équipe trouvée.</p>
    <?php endif; ?>
</div>

<!-- Bouton pour créer une équipe -->
<div class="create-team-button">
    <a href="<?php echo site_url('/creation'); ?>" class="btn btn-primary">Créer une équipe</a>
</div>

<?php get_footer(); ?>
