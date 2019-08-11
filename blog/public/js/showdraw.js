$(document).ready(function(){
    console.log('go!');
    getDrawData();
});

function getDrawData(){
    $.ajax({
        url: GET_DRAW_URL,        
        type: 'get',            
        success: function(data) {                       
                    var jsonObj = JSON.parse(data);
                    switch(jsonObj.status){
                        case '0000':
                            console.log('Success!!');
                            genTableContent(jsonObj.info[0]);
                            break;                           
                        default:
                            console.log('Unknown Error!');
                            console.log(jsonObj);
                            break;
                    }
                
                },
        error: function(e){
            console.log(e);
            alert(e.responseJSON.message);
        }
                
    });
}

function genTableContent(info){
    $('#draw-body').empty();

    var content = '<tr>';
    content += '<td id="tId">'+info.id+'</td>';
    content += '<td id="fo">'+info.first_prize+'</td>';
    content += '<td id="so">'+info.second_prize_one+'</td>';
    content += '<td id="st">'+info.second_prize_two+'</td>';
    content += '<td id="to">'+info.third_prize_one+'</td>';
    content += '<td id="tt">'+info.third_prize_two+'</td>';
    content += '<td id="tth">'+info.third_prize_three+'</td>';
    content += '<tr>';
    $('#draw-body').append(content);
}