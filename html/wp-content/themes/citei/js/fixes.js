/*
Type: Script
Purpose: Fix blocks problems by using jQuery
Author: Nickolas da Rocha Machado & Natalia Zambe
 */

 function fixTabIndexes()
 {
   $('.wp-block-column , .wp-block-group__inner-container , \
        .wp-block-image , .sr-read-children'
        ).children('h1, h2, h3, h4, h5, img, p'
        ).attr("tabindex", "0")
   $('#pojo-a11y-toolbar, .pojo-a11y-toolbar-toggle-link').attr("role", "").attr("tabindex", "-1")
 }

 function bootstrapFileBlock()
 {
    $('.wp-block-file__button').addClass("btn btn-primary ml-3"
      ).attr("role", "button").removeClass("wp-block-file__button")
 }

function vlibrasFix()
{
  $('head').append(`
  <style>
    .vw-text:hover , .vw-text-active
    {
        color: black !important;
        background: yellow !important;
    }
  </style>
  `)
}

 $(document).ready(() => {
    fixTabIndexes()
    bootstrapFileBlock()
    vlibrasFix()
 })