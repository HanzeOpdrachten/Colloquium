jQuery(function(){
  jQuery('#js-menu-toggle').click(function(){

    jQuery(this).find('.hamburger__slice--top').toggleClass('hamburger__slice--top--active');
    jQuery(this).find('.hamburger__slice--middle').toggleClass('hamburger__slice--middle--active');
    jQuery(this).find('.hamburger__slice--bottom').toggleClass('hamburger__slice--bottom--active');

    jQuery('body').toggleClass("menu-active");
    jQuery('.navigation').toggleClass("navigation--active");
    jQuery('.menu').toggleClass("menu--active");

    return false;
  });

  jQuery('.menu__item > a').click(function () {
    for (var i = 0; i < 3; i++) {
      var position = ['top', 'middle', 'bottom'];

      if (jQuery('.hamburger__slice--' + position[i]).hasClass('hamburger__slice--' + position[i] + '--active')) {
        jQuery('.hamburger__slice--' + position[i]).removeClass('hamburger__slice--' + position[i] + '--active');
      }
    }

    checkRemoveClass('body', 'menu-active');
    checkRemoveClass('.navigation', 'navigation--active');
    checkRemoveClass('.menu', 'menu--active');
  });
  jQuery('.clickable-colloquium').click(function() {
    var link = jQuery(this).data('link');
    window.location.href = link;
  });

  function checkRemoveClass(targetEl, targetClass) {
    if (jQuery(targetEl).hasClass(targetClass)) {
      jQuery(targetEl).removeClass(targetClass);
    }

    return false;
  }

});
