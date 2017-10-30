<?php
 include __DIR__.DIRECTORY_SEPARATOR."AutoLoad.class.php";
 
 session_start();
 
 $autoLoader = new AutoLoad();
 $autoLoader->register();
 
 Util::routerURL();
 
 $view = $_SESSION["View"];
 
 
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gullaci Consultoria</title>
       
        <base href="<?php echo Config::GetInstance()->preferences["root_document"]; ?>">
        
        <?php
            echo Bootstrap::$css;
            
        ?>
        <link rel="stylesheet" href="view/css/main.css">
        
    </head>
    <body>
        
        <div class="container-fluid slide-top" style="">
            
                <div id="carousel-img" class="carousel" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-img" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-img" data-slide-to="1"></li>

                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img class="img-responsive" src="view/images/ID-100368356.jpg"/>
                        </div>
                        <div class="item">
                            <img  class="img-responsive" src="view/images/ID-10071997.jpg">
                        </div>
                       
                    </div>
                </div> 
               
            <nav class="navbar cabecalho navbar-default navbar-transparent" style=""> <!-- data-spy="affix" data-offset-top="551">-->
                <div class="container-fluid">
                    <div class="navbar-header col-md-4">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <label class="navbar-brand"><a href="Home">Gullaci Consultoria</a></label>
                    </div>
                    
                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li><?php echo View::ActionLink("Sobre","Home","About")?></li>
                            <li><?php echo View::ActionLink("Clientes","Cliente")?></li>
                            <li><?php echo View::ActionLink("Soluções","Cliente","ListaSolucoes")?></li>
                            <li><?php echo View::ActionLink("Contato","Cliente","Proposta")?></li>
                        </ul>
                    </div>
                </div>
            </nav> 
        </div>
        
        

        <div class="container">
            
                <?php
                    $view->render();
                ?>

        </div>
      
        <script src="app_data/Jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="app_data/Jquery/jquery.mask.min.js" type="text/javascript"></script>
        <script src="view/js/main.js" type="text/javascript"></script>
        <script src="view/Cliente/proposta.js"></script>
        <?php echo Bootstrap::$js;?>
        <script>
            $(function(){
                $("#carousel-img,#carousel-img2 ").carousel({interval:3000});
                
                $('#Tabs a').on('click',function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                    console.log('asdas');
                  });
            })
        </script>
    </body>
   
</html>
