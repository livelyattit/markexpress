Dropzone.autoDiscover = false;
jQuery(document).ready(function ($) {

    var preloader_loader = $('#preloader-loader');
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $('.select-js').select2({
        placeholder: function(){
            $(this).data('placeholder');
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
            beforeSend: function () {

                clicked_button
                    .attr('disabled', 'disabled')
                    .addClass('disabled')
                    .removeClass('btn-success')
                    .addClass('btn-outline-success');
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
                        .removeClass('disabled');

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
                        .removeClass('disabled')
                        .removeClass('btn-outline-success')
                        .addClass('btn-success');

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
            beforeSend: function () {

                clicked_button
                    .attr('disabled', 'disabled')
                    .addClass('disabled')
                    .removeClass('btn-success')
                    .addClass('btn-outline-success');
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
                        .removeClass('disabled');

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
                        .removeClass('disabled')
                        .removeClass('btn-outline-success')
                        .addClass('btn-success');

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

    $("#customer-verification-proceed-form").submit(function (e) {

        e.preventDefault();

        let form = $(this);
        let clicked_button = form.find('.btn-in-submit');
        let form_message = form.find('.form-message');

        $.ajax({

            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
            url: '/customer/proceed-verification',
            beforeSend: function () {

                clicked_button
                    .attr('disabled', 'disabled')
                    .addClass('enabled');
                clicked_button.text('Please Wait..');

            },
            success: function (result, status, xhr) {

                console.log(result);
                setTimeout(function () {

                    let redirect_url = result.data.redirect_url;

                    form_message
                        .removeClass('error')
                        .addClass('success')
                        .text(result.data.message);

                    console.log(redirect_url);
                    clicked_button
                        .removeAttr('disabled')
                        .removeClass('enabled');

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

                    clicked_button.text('Proceed to verify');

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
            addRemoveLinks: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 2, // MB
            //timeout: 5000,
            success: function(file, response) 
            {
                console.log(file);
                console.log(response);
            },
            error: function(file, response)
            {
                $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(response);
                console.log(file);
                console.log(response);
               return false;
            }
    });

    $("#form-upload-cnic").dropzone({
        url: "/customer/file-upload-cnic" ,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: false,
        uploadMultiple: false,
        maxFiles: 1,
        maxFilesize: 2, // MB
               //timeout: 5000,
               success: function(file, response) 
               {
                   console.log(file);
                   console.log(response);
               },
               error: function(file, response)
               {
                   $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(response);
                   console.log(file);
                   console.log(response);
                   return false;
               }
       });

    var addresslog_datatable =  $('#addresslog_table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "/address-log",
        },
        columns: [
            {
                data: 'consignee_alias',
                name: 'consignee_alias'
            },
            {
                data: 'consignee_name',
                name: 'consignee_name'
            },
            {
                data: 'consignee_contact',
                name: 'consignee_contact'
            },
            {
                data: 'consignee_address',
                name: 'consignee_address',
            },
            {
                data: 'consignee_nearby_address',
                name: 'consignee_nearby_address',
            },
            {
                data: 'city_delivery',
                name: 'city_delivery'
            },
            {
                data: 'edit',
                name: 'edit',
                orderable: false
            },
            {
                data: 'delete',
                name: 'delete',
                orderable: false
            }
        ]
    });

    $(document).on('click', '.btn-edit-addresslog', function () {
        let addresslog_id = $(this).data('addresslog-id');
        let form = $('#addresslog-create-form');
        let addresslog_modal = $('#address-log-modal');
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: '/address-log/'+addresslog_id,
            beforeSend:function(){
                preloader_loader.toggleClass('show');
            },
            success:function(data){
              //  console.log(data);
                setTimeout(function () {
                    preloader_loader.toggleClass('show');
                    addresslog_modal.find('.js-content').html(data);
                    addresslog_modal.modal('toggle');
                },1200);

            },
            error:function(){}
        });
    });

    $(document).on('submit', '#addresslog-edit-form', function (e) {
        e.preventDefault();
        let form = $(this);
        let form_message = form.find('.form-message');
        let clicked_button = form.find('.btn-in-submit');
        let url = form.attr('action');

        $.ajax({
            type: 'PUT',
            dataType: 'json',
            url: url,
            data:form.serialize(),
            beforeSend:function(){
                preloader_loader.toggleClass('show');
                form
                    .find('.form-field-status')
                    .html('');
                clicked_button
                    .attr('disabled', 'disabled')
                    .addClass('disabled');
                clicked_button.text('Please Wait..');
            },
            success: function (result, status, xhr) {

                console.log(result);
                setTimeout(function () {
                    preloader_loader.toggleClass('show');
                    clicked_button
                        .removeAttr('disabled')
                        .removeClass('disabled');

                    form_message
                        .removeClass('error')
                        .addClass('success')
                        .html('Successfully edited');

                    clicked_button.text('Update Consignee');

                }, 2000);
            },
            error: function (xhr, status, error) {

                console.log(xhr);
                console.log(status);
                console.log(error);

                let response_message = xhr.responseJSON.message;
                let response_errors =xhr.responseJSON.errors;

                setTimeout(function () {
                    preloader_loader.toggleClass('show');
                    clicked_button
                        .removeAttr('disabled')
                        .removeClass('disabled');

                    clicked_button.text('Update Consignee');

                    form_message
                        .removeClass('success')
                        .addClass('error')
                        .html(response_message);


                    $.each(response_errors, function(i, item){

                        form
                            .find('.form-field-' + i)
                            .html('<div class="error">' +item + '</div>');
                        console.log(i);
                        console.log(item);

                    });

                }, 2000);
            },
            complete:function(xhr, status){
                addresslog_datatable.ajax.reload();
            }
        });
    });

    $(document).on('click', '.btn-delete-addresslog', function () {

        let addresslog_id = $(this).data('addresslog-id');
        let addresslog_alias = $(this).data('addresslog-alias');
        bootbox.confirm({
            title: `Confirmation for ${addresslog_alias}`,
            message: `Do you want to delete ${addresslog_alias} ?`,
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel',
                    className: 'btn-gray',
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm',
                    className: 'btn-danger',
                }
            },
            callback: function (result) {
                if(result == true){
                    $.ajax({
                        type: 'DELETE',
                        dataType: 'json',
                        url: '/address-log/'+addresslog_id,
                        beforeSend:function(){
                            preloader_loader.toggleClass('show');
                        },
                        success:function(data){
                            console.log(data);
                            setTimeout(function () {
                                preloader_loader.toggleClass('show');

                                addresslog_datatable.ajax.reload();
                            },1200);

                        },
                        error:function(){}
                    });
                }

            }
        });


    });

    $("#parcel-create-form").find('.select-consignee').on('change', function () {
        let consignee_id = $(this).val();

        $.ajax({

            type: 'POST',
            dataType: 'html',
            data: {
                consignee_id:consignee_id,
            },
            url: '/parcel/get-consignee',
            beforeSend: function () {
                $('.selected-consignee-wrapper').removeClass('show').html();
            },
            success: function (result, status, xhr) {

                console.log(result);
                $('.selected-consignee-wrapper').addClass('show').html(result);
            },
            error: function (xhr, status, error) {

                console.log(xhr);
                console.log(status);
                console.log(error);


            },
            complete: function () {

            }

        });

    })



});
