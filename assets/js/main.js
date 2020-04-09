jQuery(document).ready(function($){

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $("#form-login").submit(function(e) {
        
        e.preventDefault();
        $(this).find('.btn-in-submit').attr('disabled', true);
        $.ajax({

            type:'POST',
            dataType:'JSON',
            data:$(this).serialize(),
            url:'/login',
            async:false,
            success:function(result, status, xhr){

                console.log(result);
                console.log(status);
                console.log(xhr);
                $(this).find('.btn-in-submit').removeAttr('disabled');
 
            },
            error: function(xhr,status,error){
                console.log(xhr);
                console.log(status);
                console.log(error);
                $(this).find('.btn-in-submit').removeAttr('disabled');
                        
            },
            complete: function(){
                $(this).find('.btn-in-submit').removeAttr('disabled');
            }
 
         });
    });

    $("#form-signup").submit(function(e) {
        
        e.preventDefault();
       // $(this).find('.btn-in-submit').attr('disabled', true);
        $.ajax({

            type:'POST',
            dataType:'JSON',
            data:$(this).serialize(),
            url:'/register',
            async:false,
            success:function(result, status, xhr){

                console.log(result);
                console.log(status);
                console.log(xhr);
              //  $(this).find('.btn-in-submit').removeAttr('disabled');
 
            },
            error: function(xhr,status,error){
                console.log(xhr);
                console.log(status);
                console.log(error);
              //  $(this).find('.btn-in-submit').removeAttr('disabled');
                        
            },
            complete: function(){
               // $(this).find('.btn-in-submit').removeAttr('disabled');
            }
 
         });
    });

});