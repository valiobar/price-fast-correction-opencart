/**
 * Created by Lozenec on 13.12.2016 г..
 */



$('document').ready(function() {
    $('#button-wrapper').hide();
    $('#connect').click(function () {
        var username = $('#username').val();
        var password =  $('#password').val();
        var database =  $('#database').val();
        $.ajax({
            url:"prices.php",
            type:"GET",
            data:{username : username,
                  password: password,
                   database :database},
               success:function(data){
                console.log(data);

                $('#login').hide();
                $('#button-wrapper').show();
                createSelectInput(data);
            },
			error:function(data){
				console.log(data);
			},
			
            dataType: "json"

        });

    });

$("#find").click(function(){

    var category = $('#category').val();
    console.log(category)
$.ajax({
    url:"prices.php",
    type:"GET",
    data:{category : category},
    success:function(data){
       console.log(data);
      appendToTable(data);

    },
    dataType:"json"
});

});
    $("#correct").click(function(){

        var correction = $('#priceCorrection').val();
        console.log(correction);
        var prices =  $('.new-prices');
       // console.log(prices);
        prices.each(function () {
           this.value =parseFloat(this.value) + parseFloat(correction);
        })
        });

});
function createSelectInput(data){
    jQuery.each(data, function (name,id) {
        $('#category').append('<option value="'+id+'">'+name+'</option>');

    });


}

function appendToTable(data) {
    var count=0;
    $('#container').empty();
    $('#shipping_method').empty();
  // $('#shipping_method').append('PRODUCTS '+ data.length);
    jQuery.each(data, function(i, val) {
        count++;
$('#container').append('<div   class="row" id= '+i+'></div>');
$('#'+i).append('<div class="col-md-3"><image style="max-width: 100%;max-height: 100%"  src='+val[3]+'></image></div>');
 $('#'+i).append('<div style="margin: 10px" class="col-md-1">category id:'+val[0]+'</div>');
  $('#'+i).append('<div class="col-md-3">'+val[1]+'</div>');
   $('#'+i).append('<div style="max-height: 300px;overflow-y: scroll ;display: block" class="col-md-2 description"></div>');

        $('#'+i+' .description').append(val[2]);

        $('#'+i).append('<div class="col-md-2"><input title="'+i+'" class="new-prices" type="text" value="'+val[4]+'"></input><br>' +
            '<button onclick="deleteItem('+i+')">Delete Item </button></div>')  ;



    });
    $('#shipping_method').append('PRODUCTS '+ count);
$('#container').append('<button onclick="savePrice()">Save Changes</button>');

 }
function deleteItem(id) {
    $.ajax({
        url:"prices.php",
        type:"GET",
        data:{delItemId : id},
        success:function(data){
            console.log(data);
            $('#'+id).hide(1000);

        },
        dataType:"json"
    });
}
function savePrice() {
    $('input').each(function () {
        var id = $(this).attr( "title" );
        var newPrice = $(this).val();
        $.ajax({
            url:"prices.php",
            type:"GET",
            data:{id : id , newPrice:newPrice},
            success:function(){

            console.log("item"+id+"is updated")
            }
        });


    })

}