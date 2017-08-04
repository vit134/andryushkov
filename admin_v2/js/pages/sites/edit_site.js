/* eslint camelcase: 0 */
/* eslint no-console: 0 */
/* eslint no-undef: 0 */

$(document).ready(function() {
    console.log('edit site page');


    var $datePicker = $('#date_create')
      , addFileBtn = $('.js-add-file-button')
      , uploadFilesInput = $('.js-upload-files')
      , $formEditSite = $('#form-editSite')
      , $aliasField = $('#alias')
      , $siteNameField = $('#site_name')
      , $removePreviewImage = $('.js-remove-preview-image')
      ;


    function init() {
        bindEvents();
        tinyInit();

        $datePicker.datetimepicker({
            locale: 'ru'
        });

        $siteNameField.on('keyup load', function(){
            translit($(this), $aliasField);
            return false;
        });
    }

    function bindEvents() {
        addFileBtn.on('click', function() {
            uploadFilesInput.trigger('click');
        })

        $('.js-remove-file').on('click', function() {
            var $this = $(this);
            $.ajax({
                url: '/admin_v2/core/remove_files.php',
                type: 'POST',
                data: {
                    siteId: uploadFilesInput.attr('data-site-id'),
                    filePath: $(this).parent().attr('data-file-path')
                },
                beforeSend: function() {},
                success: function(e){
                    console.log(JSON.parse(e));

                    e = JSON.parse(e);

                    if (e.status === 'success') {
                        $this.parent().remove();
                    } else {
                        $(this).parent().css('background', 'red');
                    }
                }
            });
        })

        uploadFilesInput.on('change', function() {
            var siteId = $(this).attr('data-site-id');
            var data = new FormData();
            var files = this.files;

            $.each( files, function( key, value ){
                data.append( key, value );
            });

            data.append('siteId', siteId);

            $.ajax({
                url: '/admin_v2/core/upload_files.php?siteId=' + siteId,
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                headers: {'cache-control': 'no-cache'},
                success: function( respond ){
                    // Если все ОК
                    console.log('ajax', respond);

                    if ( typeof respond.error === 'undefined' ){
                        for (var i = 0; respond.files.length > i; i++){
                            tinymce.activeEditor.settings.image_list.push({'title': respond.files[i].title, 'value': respond.files[i].value})
                            $('.js-file-content').append('<div class="upload-files__file">'+ respond.files[i].title +'</div>')
                        }
                    } else {
                        console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                    }
                },
                error: function( jqXHR, textStatus ){
                    console.log('ОШИБКИ AJAX запроса: ' + textStatus );
                }
            });
        });

        $formEditSite.validator({disable: true}).on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                //$formAddSiteSubmit.attr('disabled', 'disabled');
            } else {
                e.preventDefault();

                var formData = getFormfields($formEditSite);

                $.ajax({
                    url: '/admin/core/edit_site.php',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    data: formData,
                    beforeSend: function() {
                        console.log(formData);
                    },
                    success: function(e){
                        console.log(e);

                        var status = e.status;

                        if (status === 'success') {
                            showAlert($('.alert-editSite'), 'success', 'success');
                            //clearFormfields($formAddSite);
                        } else {
                            showAlert($('.alert-editSite'), 'danger', 'not success');
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                        console.log('error');
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        });



        $removePreviewImage.on('click', function() {
            $(this).parent().remove();
        })
    }

    function tinyInit() {
        tinymce.init({
            selector: '.tinyMce',
            height: 500,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            plugin_preview_width: 1440,
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | template',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            image_list: files,
            templates: [
                {
                    title: 'Card left image',
                    content: '<div class="row"><div class="card card_left-img"><div class="card__col"><div class="card__img">Изображение</div></div><div class="card__col"><div class="card__text"><div class="card__text__inner">text</div></div></div></div></div><br>'
                },
                {
                    title: 'Card full',
                    content: '<div class="row"><div class="card card_full"><div class="card__img">/~/ Изображение /~/</div></div><br>'
                },
                {
                    title: 'Card right image',
                    content: '<div class="row"><div class="card card_right-img"><div class="card__col"><div class="card__text"><div class="card__text__inner">/~/ Text /~/</div></div></div><div class="card__col"><div class="card__img">/~/ Изображение /~/</div></div></div></div><br>'
                }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '/css/article/build/__main.css'
            ],
            body_class: 'article',
            //images_upload_url: '/admin_v2/core/save_file.php?siteid=' + $('input[name=site_id]').val(),
            //images_upload_base_path: '/uploads/' + $('input[name=site_id]').val() + '/',
            //images_reuse_filename: true,
            /*file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    $('#upload').trigger('click');
                    $('#upload').on('change', function() {

                        var file = this.files[0];
                        console.log(file);
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var src = reader.result;
                            callback(src, {source2: 'alt.ogg', poster: 'image.jpg'});
                        }
                        reader.readAsDataURL(file);
                    });
                }
            },*/
        });
    }

    function getFormfields($form) {
        var $fields = $form.find('input, select');
        var data = new FormData();


        $('.file-input').each(function() {
            data.append($(this).attr('name'), $(this)[0].files[0])
        })

        $fields.each(function() {
            if ($(this).attr('type') === 'checkbox') {
                if ($(this).prop('checked')) {
                    data.append($(this).attr('name'), 1);
                } else {
                    data.append($(this).attr('name'), 0);
                }
            } else {
                data.append($(this).attr('name'), $(this).val());
            }
        })

        data.append('content', tinyMCE.activeEditor.getContent());

        return data;
    }

    function clearFormfields($form) {
        var $fields = $form.find('input:visible');
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
            if (transl[text[i]] !== undefined) {
                if (curentSim !== transl[text[i]] || curentSim !== space){
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
            $alert.hide();
        }, 5000)
    }

    init();
})