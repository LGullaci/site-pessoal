<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClienteController
 *
 * @author Lucas Gullaci
 */
if(isset($_REQUEST["ajax_action"]))
{
    require_once '../AutoLoad.class.php';

     $autoLoader = new AutoLoad(true);
     $autoLoader->register();
}
//require_once 'Controller.class.php';
class ClienteController extends Controller{
    //put your code here
    
    public function __construct($a = "") {
        
        parent::__construct($a);
    }
    
    public function Index() {
        $view = new View("Cliente/index");
        $_SESSION["View"] = $view;
    }
    
    public function Proposta($objProposta = null) {
        
        if($objProposta != null)
        {
            $proposta = new Proposta();
            echo $proposta->enviarProposta($objProposta);
            return;
        }
        $view = new View("Cliente/proposta");
        $_SESSION["View"] = $view;
    }
    
    public function ListaSolucoes(){
        $view = new View("Cliente/listaSolucoes");
        if(isset($_REQUEST["dadosProposta"]))
        {
            
        }
        $_SESSION["View"] = $view;
    }
}

if(isset($_REQUEST["ajax_action"]))
{

    $c = new ClienteController();
    $dados = $_REQUEST["dados"];
    parse_str($dados,$dados);
    $obj = Util::ArrayToObject($dados);
    //var_dump($obj);
    $c->{$_REQUEST["ajax_action"]}($obj);
}
