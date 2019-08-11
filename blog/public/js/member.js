$(document).ready(function(){
    $( "#member-form" ).submit(function( event ) {        
        event.preventDefault();
        var $form = $(event.target);
        $.ajax({
            url: $form.attr('action'),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            dataType: 'json',
            data: $form.serialize(),
            success: function(data) {                       
                       switch(data.status){
                            case '0000':
                                console.log('Success!!');
                                alert('Success!!');
                                break;
                            case '1001':
                                console.log('Winning Number Duplicated!');
                                alert('Winning Number Duplicated!');
                                break;
                            default:
                                console.log('Unknown Error!');
                                console.log(data);
                                break;
                       }

                    //    $('#member-name').val('');
                       $('#win-num').val('');
                    },
            error: function(e){
                console.log(e);
                alert(e.responseJSON.message);
            }
                    
        });
    });
});