<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author Lucas
 */
class HomeController extends Controller {
    
    
    public function __construct($a = "") {
        
        parent::__construct($a);
    }
    
    public function Index()
    {
        $view = new View("Home/index");
        $_SESSION["View"] = $view;
    }
    
    public function About()
    {
        $view = new View("Home/about");
         $_SESSION["View"] = $view;
    }
    
    //put your code here
}
