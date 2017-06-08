$(document).ready(function() {

    var $formAddSite = $('#form-addSite')
      , $formAddSiteSubmit = $('#form-addSite-submit')
      , $aliasField = $('#alias')
      , $siteNameField = $('#site_name')
      , $removeSiteButton = $('.remove-site-button')
      ;

    function init() {
        bindEvents();

        $('#date_create').datetimepicker({locale: 'ru'});

    }

    /*function getFormfields($form) {
        var $fields = $form.find('input, select');
        var data = {};
        $fields.each(function() {
            data[$(this).attr('name')] = $(this).val();
        })

        return data;
    }*/

    function getFormfields($form) {
        var $fields = $form.find('input, select');
        var data = new FormData();


        $('.file-input').each(function(i) {
            data.append($(this).attr('name'), $(this)[0].files[0])
        })

        $fields.each(function() {
            data.append($(this).attr('name'), $(this).val());
        })

        return data;
    }

    function clearFormfields($form) {
        var $fields = $form.find('input');
        $fields.val('');
    }

    function translit($from, $to) {
        // Символ, на который будут заменяться все спецсимволы
        var space = '_';

        // Берем значение из нужного поля и переводим в нижний регистр
        var text = $from.val().toLowerCase();
        // Массив для транслитерации
        var transl = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
            'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
            'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
            'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': space, 'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
            ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
            '#': space, '$': space, '%': space, '^': space, '&': space, '*': space,
            '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space,
            ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
            '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
            '?': space, '<': space, '>': space, '№': space
        }
        var result = '';
        var curentSim = '';
        for (var i=0; i < text.length; i++) {
            // Если символ найден в массиве то меняем его
            if (transl[text[i]] != undefined) {
                if (curentSim != transl[text[i]] || curentSim != space){
                    result += transl[text[i]];
                    curentSim = transl[text[i]];
                }
            } else {
                result += text[i];
                curentSim = text[i];
            }
        }
        result = TrimStr(result);
        // Выводим результат
        $to.val(result);
    }

    function TrimStr(s) {
        s = s.replace(/^-/, '');
        return s.replace(/-$/, '');
    }

    function bindEvents() {

        $formAddSite.validator({disable: true}).on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                //$formAddSiteSubmit.attr('disabled', 'disabled');
            } else {
                e.preventDefault();

                var formData = getFormfields($formAddSite);

                $.ajax({
                    url: '/admin/core/form_handler.php',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    cache: false,
                    //headers: {'cache-control': 'no-cache'}, // fix for IOS6 (not tested)
                    dataType: 'json',
                    data: formData,
                    beforeSend: function() {console.log(formData);},
                    success: function(e){
                        //console.log(JSON.parse(e));
                        console.log(e);

                        /*e = JSON.parse(e);
                        var status = e.status;

                        if (e.status === 'success') {
                            showAlert($('.alert-addSite'), 'success', 'success');
                            clearFormfields($formAddSite);
                        } else {
                            showAlert($('.alert-addSite'), 'danger', 'not success');
                        }*/
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                       console.log('error');
                       console.log(jqXHR);
                       console.log(textStatus);
                       console.log(errorThrown);
                    }
                });
            }
        })

        $removeSiteButton.on('click', function(e) {
            e.preventDefault();

            var siteId = $(this).attr('data-site-id');
            var siteRow = $(this).closest('tr');

            siteRow.addClass('danger');

            var confirmFunc = confirm("Are you sure to remove this site?");

            if (confirmFunc) {
                $.ajax({
                    url: '/admin/core/remove-site.php',
                    type: 'POST',
                    data: {siteId: siteId},
                    beforeSend: function() {},
                    success: function(e){
                        //console.log(JSON.parse(e));

                        e = JSON.parse(e);
                        var status = e.status;

                        if (e.status === 'success') {
                            showAlert($('.alert-removeSite'), 'success', 'success');
                            clearFormfields($formAddSite);
                            siteRow.remove();
                        } else {
                            showAlert($('.alert-removeSite'), 'danger', 'not success');
                        }
                    }
                });
            }
        })


        $(function(){
            $siteNameField.on('keyup', function(){
                translit($(this), $aliasField);
                return false;
            });
        });
    }

    function showAlert($alert,status, message) {

        var atertType;

        if (status === 'success') {
            atertType = 'alert-success'
        } else if (status === 'info') {
            atertType = 'alert-info'
        } else if (status === 'warning') {
            atertType = 'alert-warning '
        } else if (status === 'danger') {
            atertType = 'alert-danger '
        }

        $alert.addClass(atertType).find('strong').html(message);
        $alert.show().alert();

        setTimeout(function() {
            $alert.alert('close')
        }, 5000)
    }


    init();

    /*showAlert($('.alert'), 'success', 'success');
    showAlert($('.alert'), 'danger', ' not success');*/



})