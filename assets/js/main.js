jQuery(document).ready(function($){

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $("#form-login").submit(function(e) {
        
        e.preventDefault();
        $.ajax({

            type:'POST',
            dataType:'JSON',
            data:$(this).serialize(),
            url:'/login',
            success:function(data){

                console.log(data);
 
            }
 
         });
    });

});