$(document).ready(function() {

    $('#vform').submit(function(event) {

        var formData = {
            'name'              : $('input[name=username]').val(),
            'email'             : $('input[name=email]').val(),
            'password'          : $('input[name=password]').val(),
            'repeated_password' : $('input[name=repeated_password]').val(),
            'cityid'            : $('input[name=cityid]').val()
        };

        $.ajax({
            type        : 'POST',
            url         : 'index.php',
            data        : formData,
            dataType    : 'json',
                        encode          : true
        })
            .done(function(data) {

                console.log(data);

            });

        event.preventDefault();
    });

});
