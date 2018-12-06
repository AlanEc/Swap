import 'flexslider'

require('../css/home.css');

$(window).on('load', function(){
    $('.flexslider').flexslider({
        controlNav: false,
        slideshowSpeed: 4000,
        animationSpeed: 1800
    });
});