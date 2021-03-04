<?php
/*
Type: Single
Name: Pessoa
Purpose: Displays a post about a person
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php 
    get_header(); 
    the_post();
?>

<main class="container bg-white text-center">
    <h1 class="mb-4" tabindex="0"><?php echo get_the_title() ?></h1>
    <div class="row mx-auto pb-3">
        <div class="col-md-3 pb-3">
            <div class="card text-left">
                <img class="card-img-top"
                    src="<?php echo get_the_post_thumbnail_url(); ?>" 
                    alt="<?php echo get_post_meta( get_post_thumbnail_id(), 
                                    '_wp_attachment_image_alt', true); ?>"
                    />
                <div class="card-body" >
                    <div tabindex="0" aria-label="Resumo">
                        <h5 tabindex="-1">Resumo</h5>
                        <p tabindex="0">
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <?php 
                            echo get_template_part('template_parts/content/participation-tags', 
                                '', array(
                                    'post_type' => 'produtos',
                                    'label' => 'Produtos',
                                    'tag'   => get_the_title()
                                )); 
                        ?>
                    </div>
                    
                    <div class="mb-3">
                        <?php  
                            echo get_template_part('template_parts/content/participation-tags', 
                                '', array(
                                    'post_type' => 'projetos',
                                    'label' => 'Projetos',
                                    'tag'   => get_the_title()
                                ));
                        ?>
                    </div>
                    <div>
                        <?php  
                            echo get_template_part('template_parts/content/participation-tags', 
                                '', array(
                                    'post_type' => 'grupos_de_pesquisa',
                                    'label' => 'Grupos de pesquisa',
                                    'tag'   => get_the_title()
                                ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md text-left sr-read-children">
            <?php echo get_the_content(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
