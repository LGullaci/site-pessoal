/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
   

   


   $("#txtNomeCliente, #txtEmail, #txtTelefone1, #txtTelefone2, #txtProposta").keyup(function(){
       console.log('a');
       if($(this).val() == '')
           $(this).attr("data-input","false");
        else
        {
            $(this).attr("data-input","true");
            $(this).removeAttr('style');
        }
   });
   
   $("#form").on('submit',function(e){
      e.preventDefault();
      
      $("#btnConfirmar").attr('disabled','disabled');
      $("#btnConfirmar").val("Enviando... ");
     // $(this).append($("<img class='img-responsive'src='view/images/default.gif'/>"));
      
      var dadosProposta = {};
      
       
       if($("[data-input='false']").length > 0)
       {
           for(var i = 0; i < $("[data-input='false']").length; i++)
           {
               $("[data-input='false']:eq("+i+")").css("border","2px solid red");
           }
           
           if($("#msgErro").css("display") === "none"){
                $("#msgErro").toggle(100);
            }
          
            $("#btnConfirmar").removeAttr('disabled');
            $("#btnConfirmar").val("Enviar Proposta");

           this.disabled = false;
       }else if($("#txtEmail").is(":invalid"))
       {
           
             $("#btnConfirmar").removeAttr('disabled');
              $("#btnConfirmar").val("Enviar Proposta");
           
           if($("#msgErro").css("display") === "none")
                $("#msgErro").toggle(100);
       }
       else
       {
           if($("#msgErro").css("display") === "block")
                $("#msgErro").toggle(100);
          
           var dadosProposta = $(this).serialize();
          
           var action = $(this).attr('action');
          
           action = action.split('/');
          
           var url = 'controller/'+action[0]+'Controller.class.php';
          
           
           $.ajax({
                url:'controller/ClienteController.class.php',
                type:"POST",
                data:{dados:dadosProposta,ajax_action:action[1]},
                success:function(data, textStatus){
                    alert(data);
                    console.log('sucesso');
                },
                error:function(xhr,er,ex){
                    $("#msgErro").html(er + '<br/>' + xhr + '<br/>' + ex);
                    $("#msgErro").toggle(100);
                    $("[data-input]").val('');
                },
                complete:function(){
                  $("#btnConfirmar").removeAttr('disabled');
                  $("#btnConfirmar").val("Enviar Proposta");
                }
                
            });
       }
      
   });

    var verificarMascara = function (val) {
      console.log(val.replace(/\D/g, '').length);
      return val.replace(/\D/g, '').length === 11 ? '(00) 0-0000-0000' : '(00) 0000-00009';
    };

     $("#txtTelefone1, #txtTelefone2").mask(verificarMascara, {
      onKeyPress: function(val, e, field, options) {
          field.mask(verificarMascara.apply({}, arguments), options);
        }
    });
    
});