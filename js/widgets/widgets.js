$(document).ready(function() {
    console.log('widgets');
    function popup() {
        var container = $('.js-popup-container')
          , popup = $('.js-popup')
          , openButton = $('.js-popup-open')
          ;

        openButton.on('click', function(e) {
            console.log(123);
            e.preventDefault();
            var $this = $(this)
              , _target = $this.attr('data-target')
              ;

            popup.each(function() {
                var name = $(this).attr('id')

                if (name == _target) {
                    container.addClass('open');
                    $(this).addClass('open');
                }
            })
        })
    }

    popup();
})