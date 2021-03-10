<?php
/*
Type: Header
Purpose: Contains header layout
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<!doctype html>
<html class="min-vh-100" <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
        <title><?php esc_html(bloginfo('name')); ?></title>
    </head>
    <body class="min-vh-100 d-flex flex-column" <?php body_class(); ?>>
        <?php get_template_part( 'template_parts/header/skips' ); ?>
        <header class="navbar navbar-expand-md navbar-light bg-white
                " tabindex="-1">
            <div class="row row-spacing justify-content-center mx-auto px-xl-4"
                tabindex="-1">
                <div class="col-xl-2 col-xs-12 text-center" id="test"
                    tabindex="-1">
                    <?php get_template_part( 'template_parts/header/logo' ); ?>
                </div>
                <div class="col-xl-7 col-xs-12 col-md-auto py-2 
                    d-flex justify-content-center align-self-center"
                    tabindex="-1">
                    <?php get_template_part( 'template_parts/header/navmenu' ); ?>
                </div>
                <div class="col-xl-3 col-xs-12 header-right py-2 text-center 
                    d-flex justify-content-center align-self-center"
                    tabindex="-1">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </header>
        <main id="content" tabindex="-1">