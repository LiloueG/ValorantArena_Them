<?php
/* Template Name: Projets et Équipes */
get_header();
?>

<div class="projects-list">
    <h1>Liste des Projets et des Équipes associées</h1>
    <?php
    // Récupérer tous les projets (en supposant que tu as un Custom Post Type 'projet')
    $args = array(
        'post_type' => 'projets', // Remplace 'projet' par le slug de ton Custom Post Type
        'posts_per_page' => -1 // Récupérer tous les projets
    );
    $projects = new WP_Query($args);

    if ($projects->have_posts()) {
        while ($projects->have_posts()) {
            $projects->the_post();
            ?>
            <div class="project">
                <h2><?php the_title(); ?></h2>
                <div class="project-description">
                    <?php the_excerpt(); // Affiche l'extrait du projet ?>
                </div>

                <h3>Équipes associées :</h3>
                <ul>
                <?php
    $args = array(
        'post_type' => 'equipe', // Le CPT agence
        'meta_query' => array(
            array(
                'key' => 'projets', // Nom du champ relationnel
                'value' => '"' . get_the_ID() . '"', // recherche exacte de l'ID
                'compare' => 'LIKE'
            )
        )
    );

    $agencies = new WP_Query( $args );
    if( $agencies->have_posts() ): 
?>
    <ul class="agencies">
        <?php while( $agencies->have_posts() ): $agencies->the_post(); ?>
        <li class="agencies__logo">
            <a href="<?php the_permalink(); ?>">
            <?php the_title( ); ?>
            </a>
        </li>
        <?php endwhile; ?>
    </ul>
<?php 
	endif; 
	wp_reset_postdata(); 
?>
                </ul>
            </div>
            <?php
        }
    } else {
        echo 'Aucun projet trouvé.';
    }
    ?>
</div>
<?php
get_footer();
?>