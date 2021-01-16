jQuery(function($) { 
    
    // ANIMACIONES PARA LAS ETIQUETAS HTML
    $('h2').waypoint(function() {
        $(this).toggleClass( 'zoomIn animated' );
    },
    
    {
        offset: '70%',
        triggerOnce: true
    });
   
    $('p').waypoint(function() {
        $(this).toggleClass( 'fadeInLeft animated' );
    },
    {
        offset: '70%',
        triggerOnce: true
    });
    
    $('li').waypoint(function() {
        $(this).toggleClass( 'fadeInRight animated' );
    },
    {
        offset: '70%',
        triggerOnce: true
    });            
    $('img').waypoint(function() {
        $(this).toggleClass( 'zoomIn animated' );
    },
    {
        offset: '70%',
        triggerOnce: true
    });        
});
//AQUI PARA VER TODAS LAS ANIMACIONES: https://daneden.github.io/animate.css/