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
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:0
    });    
});