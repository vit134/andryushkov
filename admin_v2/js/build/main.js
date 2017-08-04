/* eslint camelcase: 0 */

$(document).ready(function() {

    var $formAddSite = $('#form-addSite')
    var $formEditSite = $('#form-editSite')
      , $formAddSiteSubmit = $('#form-addSite-submit')
      , $formEditSiteSubmit = $('#form-editSite-submit')
      , $aliasField = $('#alias')
      , $siteNameField = $('#site_name')
      , $removeSiteButton = $('.remove-site-button')
      , $allSitesTable = $('.table_all-sites')
      , $removePreviewImage = $('.js-remove-preview-image')
      , tags = $('.js-tag-item')
      , addFileBtn = $('.js-add-file-button')
      , uploadFilesInput = $('.js-upload-files')
      ;

    //var leftCard = require('/tmp/blocks/article/left-card/main.html');

    function init() {
        bindEvents();

        $('#date_create').datetimepicker({
            locale: 'ru'
        });
        $allSitesTable.tablesorter();

        $('#tags').liveSearch({
            tags: $('.js-tag-item')
        });
    }

    function getTags() {
        var tagsArr = [];
        tags.each(function() {
            tagsArr.push($(this).html().toLowerCase());
        })

        return tagsArr;
    }


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


    /*function saveImage(files, siteId) {
        var data = new FormData();
        console.log(siteId);

        $.each( files, function( key, value ){
            data.append( key, value );
        });

        data.append('siteId', siteId);

        $.ajax({
            url: '/admin_v2/core/save_file.php?uploadfiles',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'cache-control': 'no-cache'},
            success: function( respond, textStatus ){
                // Если все ОК
                console.log('ajax', respond);

                if ( typeof respond.error === 'undefined' ){


                }
                else {
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
        });
    }*/

    //$('#upload').on('change', previewFile);

    /*function previewFile() {
        console.log(123);
        var preview = document.querySelector('img.preview');
        var file    = document.querySelector('#upload').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            console.log(preview.src);
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }*/

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

                    if (e.status == 'success') {
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
                success: function( respond, textStatus ){
                    // Если все ОК
                    console.log('ajax', respond);

                    if ( typeof respond.error === 'undefined' ){
                        for (var i = 0; respond.files.length > i; i++){
                            tinymce.activeEditor.settings.image_list.push({'title': respond.files[i].title, 'value': respond.files[i].value})
                            $('.js-file-content').append('<div class="upload-files__file">'+ respond.files[i].title +'</div>')
                        }
                    }
                    else {
                        console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    console.log('ОШИБКИ AJAX запроса: ' + textStatus );
                }
            });
        })

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
                    beforeSend: function() {
                        //console.log(formData);
                    },
                    success: function(e){
                        //console.log(JSON.parse(e));
                        console.log(e);

                        /*e = JSON.parse(e);*/
                        var status = e.status;

                        if (e.status === 'success') {
                            showAlert($('.alert-addSite'), 'success', 'success');
                            clearFormfields($formAddSite);
                        } else {
                            showAlert($('.alert-addSite'), 'danger', 'not success');
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

        $removePreviewImage.on('click', function() {
            $(this).parent().remove();
        })

        /*$('.js-tag-item').each(function(){
            $(this).attr('data-search-term', $(this).text().toLowerCase());
        });

        $('#tags').on('keyup', function(){

            var searchTerm = $(this).val().toLowerCase();

            setTimeout(function() {
                $('.tags-list').show();
            }, 1000)

            setTimeout(function() {
                $('.tags-list').hide();
            }, 6500)

            $('.js-tag-item').each(function(){
                if (!$(this).hasClass('add')) {
                    if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }

            });

        });

        $('.js-tag-item').on('click', function() {
            var offset = $('#tags').attr('data-offset');

            $(this).addClass('add').css({
                position: 'absolute',
                top: '-29px',
                left: offset + 'px'
            })

            $('#tags').focus()
                .css('padding-left', +(offset) + $(this).outerWidth() + 10 + 'px')
                .attr('data-offset', +(offset) + $(this).outerWidth() + 10)
                .val('');
        })*/

        $(function(){
            $siteNameField.on('keyup load', function(){
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
            $alert.hide();
        }, 5000)
    }


    init();



});

//Plugins


(function( $ ){

    $.fn.liveSearch = function( options ) {

        var settings = $.extend( {
            input: this,
            tags: $('.liveSearch-tags'),
            tagsMargin: 10,
            showTimeout: 1000,
            hideTimeOut: 6500
        }, options);

        return this.each(function() {
            var $this = $(this);

            settings.tags.each(function(){
                $(this).attr('data-search-term', $(this).text().toLowerCase());
            });


            $this.on('keyup', function(){

                var searchTerm = $(this).val().toLowerCase();

                setTimeout(function() {
                    $('.tags-list').show();
                }, options.showTimeout)

                settings.tags.each(function(){
                    if (!$(this).hasClass('add')) {
                        if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    }

                });

            });

            settings.tags.on('click', function() {
                var offset = $('#tags').attr('data-offset');

                $(this).addClass('add').css({
                    position: 'absolute',
                    top: '-39px',
                    left: offset + 'px'
                })

                $this.focus()
                    .css('padding-left', +(offset) + $(this).outerWidth() + 10 + 'px')
                    .attr('data-offset', +(offset) + $(this).outerWidth() + 10)
                    .val('');
            })


        });


    };
})( jQuery );
