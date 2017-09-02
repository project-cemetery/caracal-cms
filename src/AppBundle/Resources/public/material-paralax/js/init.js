(function($){
    $(function(){
        $('.parallax').parallax();
        $('.carousel').carousel();
        $('.modal').modal();
        $('.slider').slider({
            full_width: true,
            indicators: false,
        });
        $('.materialboxed').materialbox();
    });
})(jQuery);