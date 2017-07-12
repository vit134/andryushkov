$(document).ready(function() {
    console.log('widgets');
    function popup() {
        var container = $('.js-popup-container')
          , popup = $('.js-popup')
          , openButton = $('.js-popup-open')
          , closeButton = $('.js-popup-close')
          , submitButton = $('.js-popup-submit')
          , raitingItem = $('.js-raiting-item')
          , form = $('#add-opinion')
          ;



        openButton.on('click', function(e) {
            e.preventDefault();
            var $this = $(this)
              , _target = $this.attr('data-target')
              ;

            popup.each(function() {
                var name = $(this).attr('id')

                if (name === _target) {
                    container.addClass('open');
                    $(this).addClass('open');
                }
            })
        })

        closeButton.on('click', function() {
            $(this).closest(popup).removeClass('open')
            container.removeClass('open');
        })


        raitingItem.on('create', function() {
            var name = $(this).attr('data-name');
            $(this).find('input').attr('name', name);

        })

        submitButton.on('click', function() {
            var data = getFields();

            $.ajax({
                url: '/core/form-handler/'+ form.attr('id') +'.php',
                type: 'POST',
                data: data,
                beforeSend: function() {
                    console.log(data);
                },
                success: function(e){
                    console.log(JSON.parse(e));

                    e = JSON.parse(e);

                    if (e.status === 'success') {
                        $('.js-popup.open').addClass('slideOutUp').animate({opacity: 0},1000);
                        setTimeout(function() {
                            container.removeClass('open');
                        }, 200)
                        setTimeout(function() {
                            $('.js-popup.open').removeClass('slideOutUp').removeClass('open').css({'opacity': 1});
                        },1500)
                    } else {

                    }

                },
                erorr: function(w) {
                    console.log(w);
                }
            });
        })

        function getFields() {
            var formFields = {};

            form.find('input, textarea').each(function() {
                if ($(this).attr('type') === 'checkbox') {
                    console.log($(this).prop('checked'));
                    if ($(this).prop('checked')) {
                        formFields[$(this).attr('name')] = 1;
                    } else {
                        formFields[$(this).attr('name')] = 0;
                    }
                } else {
                    formFields[$(this).attr('name')] = $(this).val();
                }

            })

            return formFields;
        }
    }

    popup();
})