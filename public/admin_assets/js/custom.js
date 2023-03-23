// Your custom JS code

// COPY TO CLIPBOARD
// Attempts to use .execCommand('copy') on a created text field
// Falls back to a selectable alert if not supported
// Attempts to display status in Bootstrap tooltip
// ------------------------------------------------------------------------------


Dropzone.autoDiscover = false;

jQuery('.select-js').select2({
    placeholder: function(){
        jQuery(this).data('placeholder');
    }
});

$('#ajax-accounts').select2({
    placeholder: function(){
        $(this).data('placeholder');
    },
    minimumInputLength:2,
    ajax: {
        url: '../ajax/customers',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            //console.log(data);
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.account_code + ' - ' + item.name + ' - ' +  item.email,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});


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
        url: './login/owner',
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


            }, 1200);
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
    responsive:false,
    bAutoWidth: false,
    ajax: {
        url: "./all",
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
                    if(data){
                        if(data == 'Not Set'){
                            return `<i>Not Set</i>`;
                        }
                        if(data == 'user created'){
                            return `<span class="btn btn-status full-width btn-warning">${data}</span>`;
                        }
                        if(data == 'file verification'){
                            return `<span class="btn btn-status full-width btn-info">${data}</span>`;
                        }
                        if(data == 'business verification'){
                            return `<span class="btn btn-status full-width btn-indigo">${data}</span>`;
                        }
                        if(data == 'verified'){
                            return `<span class="btn btn-status full-width btn-success">${data}</span>`;
                        }
                    }

            },
            defaultContent: "<i>Not initialized</i>",
            name: 'originality'
        },
        // {
        //     data: 'originality',
        //     name: 'originality'
        // },
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



$('#from').datepicker({
    dateFormat: "dd-mm-yy"
});

$('#to').datepicker({
    dateFormat: "dd-mm-yy"
});


var parcels_datatable =  $('#parcels_table').DataTable({
    processing: true,
    serverSide: true,
    responsive: false,
    bPaginate: true,
    bLengthChange: false,
    bFilter: true,
    bInfo: true,
    bAutoWidth: false,
    // scrollY:        "300px",
    // scrollX:        true,
    // fixedColumns:   {
    //     leftColumns: 2
    // },
    ajax: {
        url: "./all",
        data: function (d) {
            d.from = $('input[name=from]').val();
            d.to = $('input[name=to]').val();
        }
    },
    order: [[0, "desc"]],
    columns: [
        {
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'assigned_parcel_number',
            name: 'assigned_parcel_number'
        },
        {
            data: 'assigned_tracking_number',
            name: 'assigned_tracking_number',
            defaultContent: "<i>Not assigned</i>",
        },
        {
            data: 'user.account_code',
            name: 'user.account_code',
            orderable: false,
        },
        {
            data: 'user.name',
            name: 'user.name',
            orderable: false,
        },
        {
            data: 'current_last_status',
            render:function(data, type, row){
                if(data){
                    if(data == 'shipment created'){
                        return `<span class="btn btn-status full-width shipment-created">${data}</span>`;
                    }
                    if(data == 'shipment picked'){
                        return `<span class="btn btn-status full-width shipment-picked">${data}</span>`;
                    }
                    if(data == 'delivery in process'){
                        return `<span class="btn btn-status full-width delivery-in-process">${data}</span>`;
                    }
                    if(data == 'delivered payment in process'){
                        return `<span class="btn btn-status full-width delivered-payment-in-process">${data}</span>`;
                    }
                    if(data == 'delivered'){
                        return `<span class="btn btn-status full-width delivered">${data}</span>`;
                    }
                    if(data == 'undelivered'){
                        return `<span class="btn btn-status full-width undelivered">${data}</span>`;
                    }
                    if(data == 'reattempt'){
                        return `<span class="btn btn-status full-width reattempt">${data}</span>`;
                    }
                    if(data == 'return in process'){
                        return `<span class="btn btn-status full-width return-in-process">${data}</span>`;
                    }
                    if(data == 'returned'){
                        return `<span class="btn btn-status full-width returned">${data}</span>`;
                    }


                }
                return data;
            },
            defaultContent: "<i>Not initialized</i>",
            name: 'current_last_status',
            orderable: false,
        },
        {
            data:'parcel_status_change',
            name:'parcel_status_change',
            orderable: false,
        },
        {
            data: 'view',
            name: 'view',
            orderable: false
        },
    ]
});

$('#search-form').on('submit', function (e) {
    parcels_datatable.draw();
    e.preventDefault();
    console.log($(this).serialize());
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
    url: "/file-upload-bill" ,
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
    url: "/file-upload-cnic" ,
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

$('.btn-delete-user').on('click', function (e) {

    e.preventDefault();
    let url = $(this).data('url');
    console.log(url);
    bootbox.confirm({
        title: `Confirmation for deletion`,
        message: `Do you want to delete?`,
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel',
                className: 'btn-gray',
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm',
                className: 'btn-primary',
            }
        },
        callback: function (result) {
            if(result == true){
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: url,
                    beforeSend:function(){
                    },
                    success:function(response){
                        if(response.data == 'success'){
                            window.location.href ='/user/all';
                        }
                    },
                    error:function(){}
                });
            }

        }
    });

});

$(document).on('change', '.parcel-status-change', function () {
    let status_val = $(this).children("option:selected").val();
    let url =  $(this).children("option:selected").data('url');
    let text =  $(this).children("option:selected").data('text');
    let tableRow = $(this).closest('tr').index(); // GET TABLE ROW NUMBER
    console.log(url);
    console.log(tableRow);
    bootbox.confirm({
        title: `Confirmation for changing status`,
        message: `Do you want to update the status as <span class="text-dark">${text}</span>?`,
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel',
                className: 'btn-gray',
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm',
                className: 'btn-primary',
            }
        },
        callback: function (result) {
            if(result == true){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        status:status_val,
                        text: text,
                    },
                    url: url,
                    beforeSend:function(){
                    },
                    success:function(response){
                        console.log(response);
                        parcels_datatable.rows().iterator('row', function ( context, index ) {
                            var data = this.row(index).data();
                            var row = $(this.row(index).node());
                            data[0] = 'new data';
                            parcels_datatable.row(row).data(data).draw();
                        });
                        // if(response.data == 'success'){
                        //     window.location.href ='/user/all';
                        // }
                    },
                    error:function(){

                    }
                });
            }
            else {
                    parcels_datatable.rows().iterator('row', function ( context, index ) {
                    var data = this.row(index).data();
                    var row = $(this.row(index).node());
                    data[0] = 'new data';
                    parcels_datatable.row(row).data(data).draw();
                });
            }

        }
    });
});

function inWords (num) {
    var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
    var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
    return str;
}

$(".fn-number").keyup(function(){
    $(".fn-number-words").html(inWords($(this).val()));
});
