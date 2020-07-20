    $(".video-play").on('click', function(e) {
        e.preventDefault(); 
        var vidWrap = $(this).parent(),
            iframe = vidWrap.find('.video iframe'),
            iframeSrc = iframe.attr('src'),
            iframePlay = iframeSrc += "?autoplay=1";
        vidWrap.children('.video-thumbnail').fadeOut();
        vidWrap.children('.video-play').fadeOut();
        vidWrap.find('.video iframe').attr('src', iframePlay);


    });

        $(window).scroll(function(){
    if ($(window).scrollTop() >= 300) {
        alert(1111)
        $('.nav1').addClass('fixed-header');
       
    }
    else {
        $('.nav1').removeClass('fixed-header');
       
    }
});

  