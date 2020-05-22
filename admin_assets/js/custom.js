// Your custom JS code

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

            }, 4000);


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
    ajax: {
        url: "/admin/user/all",
    },
    columns: [
        {
            data: 'id',
            name: 'id'
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