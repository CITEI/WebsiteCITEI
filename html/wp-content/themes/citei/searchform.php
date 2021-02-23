<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label class="my-auto">
        <span class="sr-only screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <div class="input-group">
            <input type="search" class="search-field form-control rounded-pill-left" 
                aria-label="Buscar por" aria-describedby="button-addon2"
                value="<?php echo get_search_query() ?>" name="s"
                title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
            <div class="input-group-append">
                <button type="submit" 
                    class="search-submit btn btn-secondary rounded-pill-right" 
                    id="button-addon2">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </label>
</form>