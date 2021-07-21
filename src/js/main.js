/* global $, AOS */
/* eslint-disable spaced-comment */

@@include('../../node_modules/bootstrap/js/dist/util.js')
@@include('../../node_modules/bootstrap/js/dist/scrollspy.js')
@@include('../../node_modules/bootstrap/js/dist/collapse.js')

$(document).ready(function() {
  AOS.init();

  $('.owl-carousel').owlCarousel({
    items: 1,
    nav: false,
    navText: '',
    dots: true,
    loop: true,
    autoplay: true,
    autoplayHoverPause: true,
    fluidSpeed: 600,
    autoplaySpeed: 600,
    navSpeed: 600,
    dotsSpeed: 600,
    dragEndSpeed: 600,
  });

  $('.forms').on('submit', function(e){
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: 'actions/subscribe.php',
      // eslint-disable-next-line no-invalid-this
      data: $(this).serialize(),
    }).done(function() {
      alert('Спасибо за заявку!');
      $('.forms').trigger('reset');
    });

    return false;
  });
});
