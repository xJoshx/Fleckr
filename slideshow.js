$slideshow = {
    context: false,
    tabs: false,
    timeout: 1000,      // Tiempo para la siguiente slide 
    slideSpeed: 1000,   // Tiempo que tarda en pasar cada slide
    tabSpeed: 300,      // Tiempo que tarda en pasar la slide cuando se pulsa el link
    fx: 'scrollLeft',   // El efecto
    
    init: function() {
        this.context = $('#slideshow');
        
        // se establecen las tabs
        this.tabs = $('ul.slides-nav li', this.context);
        
        this.tabs.remove();
        
        // se llama a la función prepareSlideshow
        this.prepareSlideshow();
    },
    
    prepareSlideshow: function() {
        // Se inicializa el plugin jQuery cycle
        $('div.slides > ul', $slideshow.context).cycle({
            fx: $slideshow.fx,
            timeout: $slideshow.timeout,
            speed: $slideshow.slideSpeed,
            fastOnEvent: $slideshow.tabSpeed,
            pager: $('ul.slides-nav', $slideshow.context),
            pagerAnchorBuilder: $slideshow.prepareTabs,
            before: $slideshow.activateTab,
            pauseOnPagerHover: true,
            pause: true
        });            
    },
    
    prepareTabs: function(i, slide) {
        return $slideshow.tabs.eq(i);
    },

    activateTab: function(currentSlide, nextSlide) {
        // coge la tab activa
        var activeTab = $('a[href="#' + nextSlide.id + '"]', $slideshow.context);
        
        // si hay alguna tab activa
        if(activeTab.length) {
            // se elimina el estilo de las demás
            $slideshow.tabs.removeClass('on');
            
            // se añade estilo a la actual
            activeTab.parent().addClass('on');
        }            
    }            
};


$(function() {
    $('body').addClass('js');
    
    $slideshow.init();
});  