<?php get_header(); ?>

<div class="matchs">
    <h1 class="page-title">Tous les Matchs</h1>
    <?php if (have_posts()) : ?>
        <div class="match-list">
            <?php while (have_posts()) : the_post(); ?>
                <article class="match-card">
                    <div class="match-details">
                        <h2 class="match-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="match-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                        <div class="match-info">
                            <div>
                                <p><strong>Heure de début : </strong><?php the_field('heure_debut'); ?></p>
                            </div>
                            <div>
                                <p><strong>Équipe 1 : </strong><?php echo esc_html(get_the_title(get_field('equipe_1'))); ?></p>
                            </div>
                            <div>
                                <p><strong>Équipe 2 : </strong><?php echo esc_html(get_the_title(get_field('equipe_2'))); ?></p>
                            </div>
                        </div>
                        <div class="match-content">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>Aucun match trouvé.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>