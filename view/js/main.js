
'use stict';
/**
 * @author Lucas Gullaci 18/12/2015
 */

$(function(){

    $('.drop-down').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
	});

    $("[data-spy='affix']").on('affix.bs.affix',function(){
    	console.log('oi');
    	
    	$(this).attr("class",$(this).attr('class').replace("affix-top",'navbar-fixed-top'));

    });

    $("[data-spy='affix']").on('affix-top.bs.affix',function(){
    	console.log('oi2');
    	//$(this).css("visibility","hidden");
    	$(this).attr("class",$(this).attr('class').replace("navbar-fixed-top","affix-top"));
    		

    });

    $(window).scroll(function(){

        if($(document).scrollTop() >= 114)
        {
            if( $(".cabecalho").is(".navbar-transparent") ) {
                $(".cabecalho").attr('class',$(".cabecalho").attr('class').replace('navbar-transparent','navbar-fill'));
            }
        }else{
            if($(".cabecalho").is(".navbar-fill")){
                $(".cabecalho").attr('class',$(".cabecalho").attr('class').replace('navbar-fill','navbar-transparent'));
            }
        }

    })

});
