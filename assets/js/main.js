jQuery(document).ready(function ($) {


    $(window).bind('resizeEnd', function () {
        $('.header_area,.singlebgslider').css('height', $(window).height());
    });

    $(window).resize(function () {

        if (this.resizeTo) clearTimeout(this.resizeTo);
        setTimeout(function () {
            $(this).trigger('resizeEnd');
        });

    }).trigger('resize')

    $("#sticker").sticky({
        topSpacing: 0,
        zIndex: 5555
    });
    
    
    $('.navbar').meanmenu();
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
    $('.single_calculate').click(function () {
        $(this).addClass("addcolor").siblings('div.single_calculate').removeClass('addcolor');
    });

    $('.hero-slider').owlCarousel({
        items: 1,
        loop: true,
        themeClass: 'hero-theme',
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    });

    $('.active-bg-slider').owlCarousel({
        items: 1,
        loop: true,
        themeClass: 'hero-theme',
        autoplay: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
    });

    $('.active-hero4-slider').owlCarousel({
        items: 1,
        themeClass: 'hero4-theme',
        autoplay: true,
        loop: true,

    });


    //Pricing Table Slider
    //slideshow style interval
    var autoSwap = setInterval(swap, 3500);

    //pause slideshow and reinstantiate on mouseout
    $('ul, span').hover(
        function () {
            clearInterval(autoSwap);
        },
        function () {
            // autoSwap = setInterval(swap, 5000);
        });

    //global variables
    var items = [];
    var startItem = 1;
    var position = 0;
    var itemCount = $('.carousel li.items').length;
    var leftpos = itemCount;
    var resetCount = itemCount;

    //unused: gather text inside items class
    $('li.items').each(function (index) {
        items[index] = $(this).text();
    });

    //swap images function
    function swap(action) {
        var direction = action;

        //moving carousel backwards
        if (direction == 'counter-clockwise') {
            var leftitem = $('.left-pos').attr('id') - 1;
            if (leftitem == 0) {
                leftitem = itemCount;
            }

            $('.right-pos').removeClass('right-pos').addClass('back-pos');
            $('.main-pos').removeClass('main-pos').addClass('right-pos');
            $('.left-pos').removeClass('left-pos').addClass('main-pos');
            $('#' + leftitem + '').removeClass('back-pos').addClass('left-pos');

            startItem--;
            if (startItem < 1) {
                startItem = itemCount;
            }
        }

        //moving carousel forward
        if (direction == 'clockwise' || direction == '' || direction == null) {
            function pos(positionvalue) {
                if (positionvalue != 'leftposition') {
                    //increment image list id
                    position++;

                    //if final result is greater than image count, reset position.
                    if ((startItem + position) > resetCount) {
                        position = 1 - startItem;
                    }
                }

                //setting the left positioned item
                if (positionvalue == 'leftposition') {
                    //left positioned image should always be one left than main positioned image.
                    position = startItem - 1;

                    //reset last image in list to left position if first image is in main position
                    if (position < 1) {
                        position = itemCount;
                    }
                }

                return position;
            }

            $('#' + startItem + '').removeClass('main-pos').addClass('left-pos');
            $('#' + (startItem + pos()) + '').removeClass('right-pos').addClass('main-pos');
            $('#' + (startItem + pos()) + '').removeClass('back-pos').addClass('right-pos');
            $('#' + pos('leftposition') + '').removeClass('left-pos').addClass('back-pos');

            startItem++;
            position = 0;
            if (startItem > itemCount) {
                startItem = 1;
            }
        }
    }

    //next button click function
    $('#next').click(function () {
        swap('clockwise');
    });

    //prev button click function
    $('#prev').click(function () {
        swap('counter-clockwise');
    });

    //if any visible items are clicked
    $('li').click(function () {
        if ($(this).attr('class') == 'items left-pos') {
            swap('counter-clockwise');
        } else {
            swap('clockwise');
        }
    });



    
    $(window).load(function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

});