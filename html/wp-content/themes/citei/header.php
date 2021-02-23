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
            <div class="container">
                <div class="row row-spacing justify-content-center">
                    <div class="col-auto text-center" id="test">
                        <div class="float-md-left">
                            <?php get_template_part( 'template_parts/header/logo' ); ?>
                        </div>
                    </div>
                    <div class="col-md-5 py-2 align-self-center">
                        <?php get_template_part( 'template_parts/header/navmenu' ); ?>
                    </div>
                    <div class="col-md-4 header-right py-2 text-center align-self-center">
                        <div class="float-md-right">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>