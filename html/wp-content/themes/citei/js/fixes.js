/*
Type: Script
Purpose: Fix blocks problems by using jQuery
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
jQuery.noConflict()
(function ($){
  function no_sr(field)
  {
    return field.attr("role", "").attr("tabindex", "-1")
  }

  function sr(field)
  {
    return field.attr("tabindex", "0")
  }

  function fixTabIndexes()
  {
    sr($('.wp-block-column , .wp-block-group__inner-container , \
          .wp-block-image > figure , .sr-read-children'
          ).children('h1, h2, h3, h4, h5, img, p'))

    no_sr(no_sr($('#pojo-a11y-toolbar')).find('*'))
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

  function fixCarouselsSize()
  {
    $('.carousel-inner').each((i, objInner) => {
      inner = $(objInner)
      inner.css('height', '')
      let max_height = inner.height()

      inner.children().each((j, objItem) => {
        item = $(objItem)
        if(item.css('display') == 'none')
        {
          item.css('display', 'block')
          let height = item.height()
          if(height > max_height)
            max_height = height
          item.css('display', '')
        }
      })
      inner.css('height', max_height)
    })
  }

  $(document).ready(() => {
      fixTabIndexes()
      bootstrapFileBlock()
      vlibrasFix()
      fixCarouselsSize()
  })

  $(window).resize(() => {
    fixCarouselsSize()
  })
})