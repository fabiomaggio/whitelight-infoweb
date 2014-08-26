$(document).ready(function() {
    // Initialize the pictures carousel
    $('#pictures-carousel').carousel({
        interval: false
    });
    
    //Enable swiping...
    $(".carousel-inner").swipe({
        //Generic swipe handler for all directions
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            $(this).parent().carousel('next'); 
        },
        swipeRight: function() {
            $(this).parent().carousel('prev'); 
        },
        tap: function(event, target) {
            var uri = $(this).find('.active img').eq(0).data('uri');

            window.location = uri;    
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:15
    });
    
    /*$(document).on('click', '.carousel-inner img', function() {
        console.log('click');
        var uri = $(this).data('uri');

        window.location = uri;    
    });*/   
});