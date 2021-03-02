<!doctype html>
<html class="min-vh-100" <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <?php wp_head(); ?>
        <title><?php bloginfo('name'); ?></title>
    </head>
    <body class="min-vh-100 d-flex flex-column" <?php body_class(); ?>>
        <header class="navbar navbar-expand-md navbar-light bg-white
                ">
            <div class="row row-spacing justify-content-center mx-auto px-xl-4">
                <div class="col-xl-2 col-xs-12 text-center" id="test">
                    <?php get_template_part( 'template_parts/header/logo' ); ?>
                </div>
                <div class="col-xl-7 col-xs-12 col-md-auto py-2 
                    d-flex justify-content-center align-self-center">
                    <?php get_template_part( 'template_parts/header/navmenu' ); ?>
                </div>
                <div class="col-xl-3 col-xs-12 header-right py-2 text-center 
                    d-flex justify-content-center align-self-center">
                    <div class="float-md-right">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </header>
        <div id="content" tabindex="-1">