<?php
/*
Type: LazyBlock
Name: Profile columns
Purpose: Displays up to 3 cards containing a 
    profile image, title and descritpion of a person
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<div class="row mx-auto justify-content-center"
    tabindex="0" aria-label="<?php _e('Profile columns', 'citei') ?>">
<?php 
    foreach ($attributes['profiles'] as $profile)
    { ?>
        <div class="col-lg-3 mx-4 mt-4" tabindex="-1">
            <div class="card border-0 bg-transparent" 
                tabindex="0" role="region">
                <img class="card-img-top mx-auto" 
                    style="
                    border-radius: 50%;
                    max-width: 230px;"
                    src="<?php echo esc_url($profile['picture']['url']) ?>" 
                    alt="<?php echo esc_attr($profile['picture']['alt']) ?>">
                <div class="card-body">
                    <a class="text-reset"
                        tabindex="0" role="link"
                        href="<?php if(isset($profile['url'])) echo esc_url($profile['url']) ?>">
                        <h4 class="card-title">
                            <?php echo esc_html($profile['title']) ?>
                        </h4>
                    </a>
                    <p class="card-text"><?php echo esc_html($profile['description']) ?></p>
                </div>
            </div>
        </div>
<?php } ?>
</div>