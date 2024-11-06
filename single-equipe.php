<?php get_header(); ?>

<div class="main single">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="post">
                <h1 class="post-title"><?php the_title(); ?></h1>
                <div class="post-content">
                    <?php
                    // Affichage de l'image de l'équipe
                    $img_equipe = get_field('img_equipe');
                    if ($img_equipe) : ?>
                        <div class="membre-thumbnail">
                            <img src="<?php echo esc_url($img_equipe['url']); ?>" alt="<?php echo esc_attr($img_equipe['alt']); ?>" />
                        </div>
                    <?php endif; ?>

                    <div class="description">
                        <?php the_content(); ?>
                    </div>

                    <!-- Nombre de membres -->
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
                <div class="post-comments">
                    <?php comments_template(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>Aucune information d'équipe trouvée.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
