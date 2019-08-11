$(document).ready(function(){
    $( "#draw-form" ).submit(function( event ) {        
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
                            case '1003':
                                console.log('No winning number found!');
                                alert('No winning number found!');
                                break;                            
                            case '1004':
                                console.log('Invalid Generate Randomly and Winning Number!');
                                alert('Invalid Generate Randomly and Winning Number!');
                                break;
                            case '1005':
                                console.log('Prize Type cannot be empty!');
                                alert('Prize Type cannot be empty!');
                                break;
                            default:
                                console.log('Unknown Error!');
                                console.log(data);
                                break;
                        }
                    },
            error: function(e){
                console.log(e);
                alert(e.responseJSON.message);
            }

        });
    });
});