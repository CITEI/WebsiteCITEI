<?php
/*
Type: LazyBlock
Name: Profile columns
Purpose: Displays up to 3 cards containing a 
    profile image, title and descritpion of a person
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<div class="container">
    <div class="row mx-auto justify-content-center">
    <?php 
        foreach ($attributes['profiles'] as $profile)
        { ?>
            <div class="col-lg-3 mx-4 mt-4">
                <div class="card border-0 bg-transparent">
                    <img class="card-img-top mx-auto"  style="
                        border-radius: 50%;
                        max-width: 200px;"
                        src="<?php echo $profile['picture']['url'] ?>" 
                        alt="<?php echo $profile['picture']['alt'] ?>">
                    <div class="card-body">
                        <a class="stretched-link text-reset"
                            href="<?php echo $profile['url'] ?>">
                            <h5 class="card-title">
                                <?php echo $profile['title'] ?>
                            </h5>
                        </a>
                        <p class="card-text"><?php echo $profile['description'] ?></p>
                    </div>
                </div>
            </div>
    <?php } ?>
    </div>
</div>