$(document).ready(function() {
    console.log('add new template page');


    var submitBtn = $('#add-new-tmp-submit')
      , form = $('#add-new-tmp-form')
      , removeButton = $('.remove-button')
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
        form.find('input').each(function() {
            fieldsVal[$(this).attr('name')] = $(this).val();
            console.log($(this).val());
        })

        return fieldsVal;
    }

    submitBtn.on('click', function(e) {
        e.preventDefault();
        var data = getFormFields();

        $.ajax({
            url: '/admin/core/add-new-template.php',
            type: 'POST',
                data: data,
                beforeSend: function() {
                    console.log(data);
                },
                success: function(e){
                    console.log(JSON.parse(e));

                    e = JSON.parse(e);

                    if (e.status === 'success') {
                        showAlert($('.alert-addTemplate'), 'success', 'success');
                        form.find('input').val('');
                    } else {
                        showAlert($('.alert-addTemplate'), 'danger', 'not success');
                    }

                }
        });
    })

})