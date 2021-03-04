<?php
/*
Type: Footer
Purpose: Contains footer layout
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
        </div>
        <footer class="site-footer bg-dark navbar navbar-expand 
            mt-auto w-100 container-fluid d-flex flex-column text-white p-0">
            <div class="row w-100 py-4 px-lg-5" tabindex="-1">
                <div class="col-lg-6 py-2 px-4
                            col-md-12 col-xs-12 text-lg-left text-center
                            sr-read-children" 
                            tabindex="-1" role="contentinfo" >
                    <h5 class="text-uppercase">
                        <?php echo bloginfo('name') ?>
                    </h5>
                    <p class=""><?php echo bloginfo('description') ?></p>
                </div>
                <div class="col-lg-3 py-2 px-4
                        col-md-6 col-xs-12 text-lg-left text-center"
                       tabindex="0" aria-labelledby="sitemap-title">
                    <?php get_template_part('template_parts/footer/menu') ?>
                </div>
                <div class="col-lg-3 py-2 px-4
                        col-md-6 col-xs-12 text-lg-left text-center"
                        tabindex="0" aria-labelledby="socialmedia-title">
                    <?php get_template_part('template_parts/footer/social', '',
                                array(
                                    new_social_media('facebook', get_option('facebook_url')),
                                    new_social_media('youtube', get_option('youtube_url')),
                                    new_social_media('instagram', get_option('instagram_url'))
                                )) ?>
                </div>
            </div>
            <div class="w-100 p-2 text-white mt-auto"
                style="background: rgba(0,0,0,0.1)">
                <div class="container text-center py-3">
                    <a><b>2021 - <?php echo bloginfo('name'); ?></b></a>
                    <a class="text-muted" href="#logo-link" aria-controls="logo-link"
                        tabindex="0"
                        style="font-size: 0.8rem;">Rolar para o topo</a>
                </div>
            </div>
        </footer>


        <?php wp_footer(); ?>
        <?php get_template_part('template_parts/footer/vlibras'); ?>
    </body>
</html>