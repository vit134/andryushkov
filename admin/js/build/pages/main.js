$(document).ready(function(){function e(e,a,n){var t;"success"===a?t="alert-success":"info"===a?t="alert-info":"warning"===a?t="alert-warning ":"danger"===a&&(t="alert-danger "),e.addClass(t).find("strong").html(n),e.show().alert(),setTimeout(function(){e.hide()},5e3)}function a(){return t.find("input, select").each(function(){"checkbox"===$(this).attr("type")?"on"===$(this).val()?(console.log($(this).val()),s[$(this).attr("name")]=1):s[$(this).attr("name")]=0:s[$(this).attr("name")]=$(this).val()}),s}console.log("pages - page");var n=$("#form-addPage-submit"),t=$(".addPage-form"),s={};n.on("click",function(n){n.preventDefault();var s=a();$.ajax({url:"/admin/core/add-new-page.php",type:"POST",data:s,beforeSend:function(){console.log(s)},success:function(a){console.log(JSON.parse(a)),a=JSON.parse(a),"success"===a.status?(e($(".alert-addPage"),"success","success"),t.find("input").val("")):e($(".alert-addPage"),"danger","not success")},erorr:function(e){console.log(e)}})})});