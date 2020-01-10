(function ($) {
    "use strict";
    $(window).scroll(function () {
      if($(window).scrollTop() > 100) {
        $(".main-header").addClass('sticky');
      } else {
        $(".main-header").removeClass('sticky');
      }
    });
    
})(jQuery);
