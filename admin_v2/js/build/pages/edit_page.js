$(document).ready(function() {
    console.log('edit page - page');


    var submitBtn = $('#form-editPage-submit')
      , form = $('.editPage-form')
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
                if ($(this).prop('checked')) {
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
            url: '/admin/core/edit_page.php',
            type: 'POST',
            data: data,
            beforeSend: function() {
                console.log(data);
            },
            success: function(e){
                console.log(JSON.parse(e));

                e = JSON.parse(e);

                if (e.status === 'success') {
                    showAlert($('.alert-editPage'), 'success', 'success');
                } else {
                    showAlert($('.alert-editPage'), 'danger', 'not success');
                }

            },
            erorr: function(w) {
                console.log(w);
            }
        });
    })
})