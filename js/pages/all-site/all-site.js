$(document).ready(function() {
    console.log('page - all-site');

    var $liveSearchItem = $('.js-live-search-item')
      , $filterInput = $('.js-filter-input')
      , $liveSearchFilterInput = $('.js-live-search-filter-input')
      , $filtersItem = $('.js-filters-item')
      , $overlay = $('.js-overlay')
      ;


    $liveSearchItem.each(function(){
        $(this).attr('data-search-term', $(this).text().toLowerCase());
    });

    $liveSearchFilterInput.on('keyup click', function(){

        var searchTerm = $(this).val().toLowerCase();

        $liveSearchItem.each(function() {
            if (searchTerm != '') {
                if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            } else {
                $(this).hide();
            }
        });

    });

    $liveSearchItem.on('click', function() {
        $(this).closest('.js-filters-item').find('input').val($(this).html());
        $(this).closest($filtersItem).find($filterInput).removeClass('active');
    })

    $filterInput.on('click', function() {
        var $container = $(this).closest($filtersItem)
          , $overlay = $container.find($overlay)
          ;

        $(this).addClass('active');
    })

    $filterInput.on('focus', function() {
        $('.js-filter-input.active').removeClass('active');
        $(this).addClass('active');
    })

    $overlay.on('click', function(e) {
        var target = $(e.target);

        if (!target.hasClass('filters__dropdown')) {
            $(this).closest($filtersItem).find($filterInput).removeClass('active');
        }
    })


    function animateBlocks() {
        var item = $('.js-item-medium');

        var _animationName = 'slideInUp';
        //item.addClass('slideInRight');

        var i = 0;

        var timerId = setTimeout(function tick() {

            if ( i < item.length) {
                if (!item.eq(i).hasClass(_animationName)) {
                    item.eq(i).addClass(_animationName).show();
                    i++;
                } else {
                    return;
                }
            } else {
                i = 0;
                clearTimeout(timerId);
            }
            timerId = setTimeout(tick, 100);
        }, 100);

    }

    animateBlocks();



    function getViewPort() {
        var top = $('.all-site__wrapper').scrollTop();
        console.log(top);
    }

    getViewPort();
})





