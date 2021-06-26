<?php
/*
Type: Search form
Purpose: Replaces search form component
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<form method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="input-group" >
        <input type="search" class="search-field form-control rounded-pill-left p-4" 
            role="searchbox"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
        <div class="input-group-append">
            <button type="submit" 
                class="search-submit btn btn-secondary rounded-pill-right px-3" 
                id="button-addon2"
                aria-label="<?php _e('Search', 'citei') ?>">
                <i class="bi bi-search" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</form>