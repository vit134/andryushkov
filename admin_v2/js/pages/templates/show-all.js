
$(document).ready(function() {
    console.log('show all template page');

    var removeButton = $('.remove-button');

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

    removeButton.on('click', function(e) {
        e.preventDefault();

        var id = $(this).attr('data-site-id');
        var row = $(this).closest('tr');

        row.addClass('danger');

        var confirmFunc = confirm("Are you sure to remove this template?");

        if (confirmFunc) {
            $.ajax({
                url: '/admin/core/remove-template.php',
                type: 'POST',
                data: {siteId: id},
                beforeSend: function() {
                    console.log(id);
                },
                success: function(e){
                    console.log(JSON.parse(e));

                    e = JSON.parse(e);
                    //var status = e.status;

                    if (e.status === 'success') {
                        showAlert($('.alert-removeTemplate'), 'success', 'success');
                        row.remove();
                    } else {
                        showAlert($('.alert-removeTemplate'), 'danger', 'not success');
                    }
                }
            });
        }
    })
})