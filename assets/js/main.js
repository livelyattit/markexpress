jQuery(document).ready(function ($) {

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $("#form-login").submit(function (e) {

        e.preventDefault();

        let form = $(this);
        let clicked_button = form.find('.btn-in-submit');
        let form_message = form.find('.form-message');

        $.ajax({

            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
            url: '/login',
            async: false,
            beforeSend: function () {

                clicked_button
                    .attr('disabled', 'disabled')
                    .addClass('enabled');
                clicked_button.find('span').text('Please Wait..');
                clicked_button.find('.loader').show();

                form_message
                        .removeClass('success error')
                        .html('');

            },
            success: function (result, status, xhr) {

                console.log(result);
                setTimeout(function () {

                    let redirect_url = result.data.redirect_url;
                    console.log(redirect_url);
                    clicked_button
                        .removeAttr('disabled')
                        .removeClass('enabled');

                    form_message
                        .removeClass('error')
                        .addClass('success')
                        .html('Redirecting You In..');

                    window.location.href = redirect_url;


                }, 4000);
            },
            error: function (xhr, status, error) {
                
                console.log(xhr);
                console.log(status);
                console.log(error);

                setTimeout(function () {
                    clicked_button
                        .removeAttr('disabled')
                        .removeClass('enabled');

                    clicked_button.find('span').text('Sign in');
                    clicked_button.find('.loader').hide();

                    form_message
                        .removeClass('success')
                        .addClass('error')
                        .html('Invalid Credentials. Try Again!');

                }, 4000);


            },
            complete: function () {

            }

        });
    });

    $("#form-signup").submit(function (e) {

        e.preventDefault();
        let form = $(this);
        let clicked_button = form.find('.btn-in-submit');
        let form_message = form.find('.form-message');
        $.ajax({

            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
            url: '/register',
            async: false,
            beforeSend: function () {

                clicked_button
                    .attr('disabled', 'disabled')
                    .addClass('enabled');
                clicked_button.find('span').text('Please Wait..');
                clicked_button.find('.loader').show();

                form_message
                        .removeClass('success error')
                        .html('');
                 form
                    .find('.form-field-status')
                    .html('');

            },
            success: function (result, status, xhr) {

                console.log(result);
                setTimeout(function () {

                    let redirect_url = result.data.redirect_url;
                    console.log(redirect_url);
                    clicked_button
                        .removeAttr('disabled')
                        .removeClass('enabled');

                    form_message
                        .removeClass('error')
                        .addClass('success')
                        .html('Redirecting You In..');

                    window.location.href = redirect_url;



                }, 4000);

            },
            error: function (xhr, status, error) {

                console.log(xhr);
                console.log(status);
                console.log(error);

                let response_message = xhr.responseJSON.message;
                let response_errors =xhr.responseJSON.errors;

                setTimeout(function () {
                    clicked_button
                        .removeAttr('disabled')
                        .removeClass('enabled');

                    clicked_button.find('span').text('Register');
                    clicked_button.find('.loader').hide();

                    form_message
                        .removeClass('success')
                        .addClass('error');

                        console.log(response_errors);

                        $.each(response_errors, function(i, item){

                            form
                            .find('.form-field-' + i)
                            .html('<div class="error">' +item + '</div>');
                            console.log(i);
                            console.log(item);

                        })

                }, 4000);
            },
            complete: function () {
            }

        });
    });


    // jQuery
$("#form-upload-bill").dropzone({
     url: "/customer/file-upload-bill" ,
     acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) 
            {
                console.log(file);
                console.log(response);
            },
            error: function(file, response)
            {
                console.log(file);
                console.log(response);
               return false;
            }
    });

});