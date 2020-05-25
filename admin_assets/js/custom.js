// Your custom JS code

// COPY TO CLIPBOARD
// Attempts to use .execCommand('copy') on a created text field
// Falls back to a selectable alert if not supported
// Attempts to display status in Bootstrap tooltip
// ------------------------------------------------------------------------------


Dropzone.autoDiscover = false;

function copyToClipboard(text, el) {
    var copyTest = document.queryCommandSupported('copy');
    var elOriginalText = el.attr('data-original-title');

    if (copyTest === true) {
        var copyTextArea = document.createElement("textarea");
        copyTextArea.value = text;
        document.body.appendChild(copyTextArea);
        copyTextArea.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'Copied!' : 'Whoops, not copied!';
            el.attr('data-original-title', msg).tooltip('show');
        } catch (err) {
            console.log('Oops, unable to copy');
        }
        document.body.removeChild(copyTextArea);
        el.attr('data-original-title', elOriginalText);
    } else {
        // Fallback if browser doesn't support .execCommand('copy')
        window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
    }
}


$("#form-login").submit(function (e) {

    e.preventDefault();

    let form = $(this);
    let clicked_button = form.find('.btn-in-submit');
    let form_message = form.find('.form-message');

    $.ajax({

        type: 'POST',
        dataType: 'JSON',
        data: form.serialize(),
        url: '/admin/login/owner',
        beforeSend: function () {

            clicked_button
                .attr('disabled', 'disabled')
                .addClass('disabled')
                .removeClass('btn-success')
                .addClass('btn-outline-success');
            clicked_button.text('Please Wait..');

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

                clicked_button.text('Sign in');

                form_message
                    .removeClass('success')
                    .addClass('error')
                    .html('Invalid Credentials. Try Again!');

            }, 1200);


        },
        complete: function () {

        }

    });

});

var users_datatable =  $('#users_table').DataTable({
    processing: true,
    serverSide: true,
    bPaginate: true,
    bLengthChange: false,
    bFilter: true,
    bInfo: true,
    bAutoWidth: true,
    responsive:true,
    ajax: {
        url: "/admin/user/all",
    },
    columns: [
        {
            data: 'account_code',
            name: 'account_code'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'originality',
            render:function(data, type, row){
                if(type == 'display'){
                    if(data){
                        if(data.originality_verified == 0){
                            return `<span class="btn btn-status full-width btn-info">${data.status}</span>`;
                        }
                        if(data.originality_verified == 1){
                            return `<span class="btn btn-status full-width btn-indigo">${data.status}</span>`;
                        }
                        if(data.originality_verified == 2){
                            return `<span class="btn btn-status full-width btn-dark">${data.status}</span>`;
                        }
                        if(data.originality_verified == 3){
                            return `<span class="btn btn-status full-width btn-success">${data.status}</span>`;
                        }
                    }
                }

            },
            defaultContent: "<i>Not set</i>",
            name: 'status'
        },
        {
            data: 'cnic',
            name: 'cnic'
        },
        {
            data: 'address',
            name: 'address',
        },
        {
            data: 'created_on',
            name: 'created_on',
        },
        {
            data: 'action',
            name: 'action',
            orderable:false,
        },
    ]
});

// Tooltips
// Requires Bootstrap 3 for functionality
$('.js-tooltip').tooltip();

// Copy to clipboard
// Grab any text in the attribute 'data-copy' and pass it to the
// copy function
$('.js-copy').click(function() {
    var text = $(this).attr('data-copy');
    var el = $(this);
    copyToClipboard(text, el);
});

// jQuery
$("#form-upload-bill").dropzone({
    url: "/admin/file-upload-bill" ,
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
    url: "/admin/file-upload-cnic" ,
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
