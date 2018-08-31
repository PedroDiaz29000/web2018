$(document).ready(function(){
  //bot_mas_noticias
      $('#bot_mas_noticias').show();
      load(1);

$("#bot_mas_noticias").click(function(){ 
          $('#bot_mas_noticias').hide();          
          $(".outer_div").html('');
          var parametros = {"action":"ajax","page":1,"vli":parseInt(8)};
         $("#loader").fadeIn('slow');
          $.ajax({
            url:'prueba.php',
            data: parametros,
             beforeSend: function(objeto){
            $("#loader").html("<img src='loader.gif'>");
            },
            success:function(data){
                $(".outer_div").html(data).fadeIn('slow');
                $("#loader").html("");
                $('#vlpa').val(8);
            }
    }) 
})
        }) 
function load(page){
    var pg;
        if($('#vlpa').val()==''){
            pg = 4;
        }else{
            pg = 8;
        }
          var parametros = {"action":"ajax","page":page,"vli":parseInt(pg)};
         $("#loader").fadeIn('slow');
          $.ajax({
            url:'prueba.php',
            data: parametros,
             beforeSend: function(objeto){
            $("#loader").html("<img src='loader.gif'>");
            },
            success:function(data){
                $(".outer_div").html(data).fadeIn('slow');
                $("#loader").html("");
            }
})
        }        