$(document).ready(function(){function e(e){var t=e.find("input, select"),a=new FormData;return $(".file-input").each(function(){a.append($(this).attr("name"),$(this)[0].files[0])}),t.each(function(){"checkbox"===$(this).attr("type")?$(this).prop("checked")?a.append($(this).attr("name"),1):a.append($(this).attr("name"),0):a.append($(this).attr("name"),$(this).val())}),a.append("content",tinyMCE.activeEditor.getContent()),a}function t(e){e.find("input:visible").val("")}function a(e,t){for(var a=e.val().toLowerCase(),s={"а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ё":"e","ж":"zh","з":"z","и":"i","й":"j","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"h","ц":"c","ч":"ch","ш":"sh","щ":"sh","ъ":"_","ы":"y","ь":"_","э":"e","ю":"yu","я":"ya"," ":"_",_:"_","`":"_","~":"_","!":"_","@":"_","#":"_",$:"_","%":"_","^":"_","&":"_","*":"_","(":"_",")":"_","-":"_","=":"_","+":"_","[":"_","]":"_","\\":"_","|":"_","/":"_",".":"_",",":"_","{":"_","}":"_","'":"_",'"':"_",";":"_",":":"_","?":"_","<":"_",">":"_","№":"_"},o="",n="",c=0;c<a.length;c++)void 0!=s[a[c]]?n==s[a[c]]&&"_"==n||(o+=s[a[c]],n=s[a[c]]):(o+=a[c],n=a[c]);o=i(o),t.val(o)}function i(e){return e=e.replace(/^-/,""),e.replace(/-$/,"")}function s(){$("#image_upload").on("change",function(){console.log("go")}),n.validator({disable:!0}).on("submit",function(a){if(a.isDefaultPrevented());else{a.preventDefault();var i=e(n);$.ajax({url:"/admin/core/form_handler.php",type:"POST",contentType:!1,processData:!1,cache:!1,dataType:"json",data:i,beforeSend:function(){},success:function(e){console.log(e);e.status;"success"===e.status?(o($(".alert-addSite"),"success","success"),t(n)):o($(".alert-addSite"),"danger","not success")},error:function(e,t,a){console.log("error"),console.log(e),console.log(t),console.log(a)}})}}),c.validator({disable:!0}).on("submit",function(a){if(a.isDefaultPrevented());else{a.preventDefault();var i=e(c);$.ajax({url:"/admin/core/edit_site.php",type:"POST",contentType:!1,processData:!1,cache:!1,dataType:"json",data:i,beforeSend:function(){console.log(i)},success:function(e){console.log(e);e.status;"success"===e.status?(o($(".alert-editSite"),"success","success"),t(n)):o($(".alert-editSite"),"danger","not success")},error:function(e,t,a){console.log("error"),console.log(e),console.log(t),console.log(a)}})}}),d.on("click",function(e){e.preventDefault();var a=$(this).attr("data-site-id"),i=$(this).closest("tr");i.addClass("danger"),confirm("Are you sure to remove this site?")&&$.ajax({url:"/admin/core/remove-site.php",type:"POST",data:{siteId:a},beforeSend:function(){},success:function(e){e=JSON.parse(e),e.status,"success"===e.status?(o($(".alert-removeSite"),"success","success"),t(n),i.remove()):o($(".alert-removeSite"),"danger","not success")}})}),_.on("click",function(){$(this).parent().remove()}),$(function(){l.on("keyup load",function(){return a($(this),r),!1})})}function o(e,t,a){var i;"success"===t?i="alert-success":"info"===t?i="alert-info":"warning"===t?i="alert-warning ":"danger"===t&&(i="alert-danger "),e.addClass(i).find("strong").html(a),e.show().alert(),setTimeout(function(){e.hide()},5e3)}var n=$("#form-addSite"),c=$("#form-editSite"),r=($("#form-addSite-submit"),$("#form-editSite-submit"),$("#alias")),l=$("#site_name"),d=$(".remove-site-button"),u=$(".table_all-sites"),_=$(".js-remove-preview-image");$(".js-tag-item");tinymce.init({selector:".tinyMce",height:500,theme:"modern",plugins:["advlist autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","insertdatetime media nonbreaking save table contextmenu directionality","emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help"],plugin_preview_width:1440,toolbar1:"undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | template",toolbar2:"print preview media | forecolor backcolor emoticons | codesample help",image_advtab:!0,templates:[{title:"Card left image",content:'<div class="row"><div class="card card_left-img"><div class="card__col"><div class="card__img">Изображение</div></div><div class="card__col"><div class="card__text"><div class="card__text__inner">text</div></div></div></div></div><br>'},{title:"Card full",content:'<div class="row"><div class="card card_full"><div class="card__img">/~/ Изображение /~/</div></div><br>'},{title:"Card right image",content:'<div class="row"><div class="card card_right-img"><div class="card__col"><div class="card__text"><div class="card__text__inner">/~/ Text /~/</div></div></div><div class="card__col"><div class="card__img">/~/ Изображение /~/</div></div></div></div><br>'}],content_css:["//fonts.googleapis.com/css?family=Lato:300,300i,400,400i","/css/article/build/__main.css"],body_class:"article",images_upload_url:"/admin_v2/core/save_file.php?siteid="+$("input[name=site_id]").val(),images_reuse_filename:!0,file_picker_callback:function(e,t,a){"image"===a.filetype&&($("#upload").trigger("click"),$("#upload").on("change",function(){var t=this.files[0];console.log(t);var a=new FileReader;a.onloadend=function(){var t=a.result;e(t,{source2:"alt.ogg",poster:"image.jpg"})},a.readAsDataURL(t)}))}}),setTimeout(function(){console.log(tinymce.activeEditor.settings.templates)},2e3),function(){s(),$("#date_create").datetimepicker({locale:"ru"}),u.tablesorter(),$("#tags").liveSearch({tags:$(".js-tag-item")})}()}),function(e){e.fn.liveSearch=function(t){var a=e.extend({input:this,tags:e(".liveSearch-tags"),tagsMargin:10,showTimeout:1e3,hideTimeOut:6500},t);return this.each(function(){var i=e(this);a.tags.each(function(){e(this).attr("data-search-term",e(this).text().toLowerCase())}),i.on("keyup",function(){var i=e(this).val().toLowerCase();setTimeout(function(){e(".tags-list").show()},t.showTimeout),a.tags.each(function(){e(this).hasClass("add")||(e(this).filter("[data-search-term *= "+i+"]").length>0||i.length<1?e(this).show():e(this).hide())})}),a.tags.on("click",function(){var t=e("#tags").attr("data-offset");e(this).addClass("add").css({position:"absolute",top:"-39px",left:t+"px"}),i.focus().css("padding-left",+t+e(this).outerWidth()+10+"px").attr("data-offset",+t+e(this).outerWidth()+10).val("")})})}}(jQuery);