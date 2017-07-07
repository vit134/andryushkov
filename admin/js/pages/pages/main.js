$(document).ready(function() {
    console.log('pages - page');


    var submitBtn = $('#form-addPage-submit')
      , form = $('.addPage-form')
      ;

    var fieldsVal = {};

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

    function getFormFields() {
        form.find('input, select').each(function() {
            if ($(this).attr('type') === 'checkbox') {

                if ($(this).val() === 'on') {
                    console.log($(this).val());
                    fieldsVal[$(this).attr('name')] = 1;
                } else {
                    fieldsVal[$(this).attr('name')] = 0;
                }
            } else {
                fieldsVal[$(this).attr('name')] = $(this).val();
            }

        })

        return fieldsVal;
    }

    submitBtn.on('click', function(e) {
        e.preventDefault();
        var data = getFormFields();

        $.ajax({
            url: '/admin/core/add-new-page.php',
            type: 'POST',
            data: data,
            beforeSend: function() {
                console.log(data);
            },
            success: function(e){
                console.log(JSON.parse(e));

                e = JSON.parse(e);

                if (e.status === 'success') {
                    showAlert($('.alert-addPage'), 'success', 'success');
                    form.find('input').val('');
                } else {
                    showAlert($('.alert-addPage'), 'danger', 'not success');
                }

            },
            erorr: function(w) {
                console.log(w);
            }
        });
    })
})