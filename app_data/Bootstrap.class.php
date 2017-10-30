<?php

/**
 * Classe auxiliar contendo métodos que criam os componentes do bootstrap para 
 * agilizar o desenvolvimento das interfaces
 * 
 * Bootstrap Version: 3.0
 *
 * @author Lucas Gullaci
 * @version 1.0
 * 
 */

final class Bootstrap {
   
    /**
     * @name $css
     * Variavel statica que cria o link do css do bootstrap para qualquer tipo de midia
     * 
     * @name $js 
     * Variavel static que cria a referencia do js minimizado do bootstrap
     */        
    public static $css = '<link rel="stylesheet" href="app_data/Bootstrap/css/bootstrap.min.css" media="all"/>';
    public static $js = '<script src="app_data/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>';
    
    /**
     * @method static Table Cria a tabela com os dados já organizados e podendo definir a classe do CSS
     * @param string $class Defini qual ou quais classe(s) do CSS serão adicionadas a tabela
     * @param string $id Parametro que define o id da tabela para identificação no DOM
     * @param array $linhas Array com todas a linhas e colunas da tabela em questão
     * @param array $header Cabeçalho da tabela
     * @return string Retorna as tags montadas prontas para a renderização
     */
    public static function Table($class, $id,array $linhas, array $header)
    {
        $tag = "<table class = \"{$class}\" id=\"{$id}\">";
        
        for($i = 0; $i < count($header); $i++)
        {
            $tag .= " <th>{$header[$i]}</th> \n";
        }
        
        for($i = 0; $i < count($linhas); $i++)
        {
            $tag .= $linhas[$i] . "\n";
        }
        $tag .= "</table>";
        
        return $tag;
    }
    
    public static function ButtonSubmit($class, $id,$label)
    {
        return "<input type = \"submit\" class = \"btn {$class}\" id = \"{$id}\" value = \"{$label}\"/>";
    }
    
    public static function NavBar($links = array(), $navClass ,$navBarLabel = "", $navBarTipo = 0, $navBarBackGround = 0, $navBarCollapse = true,$colsGrid = array())
    {
     
        switch($navBarBackGround)
        {
            case NavBarBackGround::$inverse:
                $navClass .= " navbar-inverse";
                break;
            case NavBarBackGround::$default:
                $navClass .= " navbar-default";
                break;
        }
        
        switch($navBarTipo)
        {
            case NavBarTipo::$fixed_top :
                $navClass .= " navbar-fixed-top";
                break;
            case NavBarTipo::$fixed_bottom:
                $navClass .= " navbar-fixed-bottom";
                break;
             case NavBarTipo::$static:
                $navClass .= " navbar-static";
                break;
        }
        
        $tag = "<nav class=\"navbar {$navClass}\"> \n";
        $tag .="<div class=\"container-fluid\" >";
        
        if($navBarLabel != "")
        {
            $tag .= "<div class=\"navbar-header\">\n";
           
            if($navBarCollapse === true)
            {
                
                $tag .= "<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#div-buttons-collapsed\" aria-expanded=\"false\"> "
                        . " <span class=\"icon-bar\"> </span>"
                        . " <span class=\"icon-bar\"> </span>"
                        . " <span class=\"icon-bar\"> </span>"
                      . "</button>";
            }   
            $tag .= "   <label class=\"navbar-brand\"> {$navBarLabel} </label>";
            $tag .= "</div>\n";
        }
        
        if($navBarCollapse === true)
        {
            $tag .= "<div class=\"collapse navbar-collapse \" id=\"div-buttons-collapsed\">";
            
            $classNavBar = "";
            
            for($i = 0; $i < count($colsGrid); $i++)
            {
                $classNavBar .= " " . $colsGrid[$i];
            }
            
            $tag .= "<ul class =\"nav navbar-nav {$classNavBar} \">\n";

            for($i = 0; $i < count($links); $i++)
            {
                $tag .= $links[$i] . "\n";
            }

            $tag .= "</ul>\n";
            $tag .= "</div>\n";
        }else
        {
            $tag .= "<ul class = \"nav navbar-nav\">\n";

            for($i = 0; $i < count($links); $i++)
            {
                $tag .= $links[$i] . "\n";
            }

            $tag .= "</ul>\n";
        }
            
        
        $tag .= "</div>";   
        
        $tag .= "</nav>";
        
        return $tag;
    }
    
    public static function DropDownList($list = array(),$dropdownListLabel,$tipo,$colsGrid = array())
    {
        
        $classDropDown = "";
        
        for($i=0; $i < count($colsGrid) ; $i++)
        {
            $classDropDown .= "{$colsGrid[$i]} ";
        }
        
        $tag = "";
        if($tipo == TipoDropDown::$link)
        {
            $tag = "<li class=\"drop-down {$classDropDown} \">";
            $tag .= "<a class=\"dropdown-toggle \" data-toggle=\"dropdown\">
                {$dropdownListLabel}
                    <span class=\"caret\">
                    </span>
            </a>";
            
            //$tag .= "<div class \"dropdown-backdrop\">";
                $tag .= "<ul class=\"dropdown-menu \">";

                for($i = 0; $i < count($list); $i++)
                {
                    $tag .= "<li> {$list[$i]} </li>";
                }

                $tag .= "</ul>";
           // $tag .= "</div>";    
            $tag .= "</li>";

        }   
        else if($tipo == TipoDropDown::$button)
        {
            $tag = "<button class=\"drop-down dropdown-toggle {$classDropDown} \" data-toggle=\"dropdown\">;
                {$dropdownListLabel}
                    <span class=\"caret\">
                    </span>";

            $tag .= "<ul class=\"dropdown-menu \">";

            for($i = 0; $i < count($list); $i++)
            {
                $tag .= "<li> {$list[$i]} </li>";
            }

            $tag .= "</ul>";
            $tag .= "</button>";

        }
        return $tag;
    }
    
    public static function NavTabs($conteudo = array(),$TabAtiva, $fade = false,$justificado = false)
    {
        $tag = "";
        
        $tag .= "<ul class=\"nav nav-tabs ".($justificado === true ? "nav-justified" : "")."\" role =\"tablist\">\n";
        
        $tabs = array_keys($conteudo);
        for($i = 0; $i < count($tabs); $i++)
        {
            $tag .= "<li id=\"Tabs\" role =\"presentation\" ".($TabAtiva == $i ? "class=\"active\"" : "").">"
                    . "<a href=\"{$tabs[$i]}\" aria-controls=\"{$tabs[$i]}\" role=\"tab\" data-toggle=\"tab\" class=\"text-capitalize\">{$tabs[$i]}</a>"
                    . "</li>\n";
        }
        
        $tag .= "</ul>\n";
        
        $tag .= "<div class=\"tab-content\">\n";
        
        
        foreach ($conteudo as $key => $value) {
    
           
            if(strcmp($TabAtiva, $key))
                $tag .= str_replace("class=\"tab-pane\"", "class=\"tab-pane active\"", $conteudo[$key])."\n";
            else
                $tag .= "{$conteudo[$key]}\n";
        }
        $tag .= "</div>";
        return $tag;
        
    }
    
    public static function NavPills($conteudo = array(),$PillAtiva, $fade = false,$justificado = false, $stacked = false)
    {
        
    }
    
    public static function Thumbnails($srcImagem = array(),$thumbnailTipo,$caption = array())
    {
        $tag = "";
        
        switch($thumbnailTipo)
        {
            case ThumbnailTipo::$link:
                $tag .= "<a class=\"thumbnail\" href=\""+ (array_key_exists("href", $srcImage) ? $srcImage["href"] : "#" )+"\">"; 
                $tag .= "   <img src=\"{$srcImage["image"]}\" alt=\"{$srcImage["alt"]}\"/>";
                if(count($caption) > 0)
                {
                    $tag .= "<div clas=\"caption\">";
                    $tag .= "   <h3> {$caption["titulo"]} </h3>";
                    $tag .= "   <p>{$caption["caption"]}</p>";
                    $tag .= "</div>";
                }
                $tag .= "</a>";
                break;
            case ThumbnailTipo::$static:
                
                $tag .= "<div class=\"thumbnail\">"; 
                $tag .= "   <img src=\"{$srcImage["image"]}\" alt=\"{$srcImage["alt"]}\"/>";
                if(count($caption) > 0)
                {
                    $tag .= "<div clas=\"caption\">";
                    $tag .= "   <h3> {$caption["titulo"]} </h3>";
                    $tag .= "   <p>{$caption["caption"]}</p>";
                    $tag .= "</div>";
                }
                $tag .= "</div>";
            case ThumbnailTipo::$carousel_image:
                
                $tag .= "<div class=\"item "+ ($srcImage["ative"] === true ? "active" : "" ) +"\">"; 
                $tag .= "   <img src=\"{$srcImage["image"]}\" alt=\"{$srcImage["alt"]}\"/>";
                if(count($caption) > 0)
                {
                    $tag .= "<div clas=\"carousel-caption\">";
                    $tag .= "   <h3> {$caption["titulo"]} </h3>";
                    $tag .= "   <p>{$caption["caption"]}</p>";
                    $tag .= "</div>";
                }
                $tag .= "</div>";
        }
        
        return $tag;
    }
    
    public static function Carousel($images = array(),$id)
    {
        $tag = "";
        
        $tag .= "<div id=\"{$id}\" class=\"carousel slide\" data-ride=\"carousel\">";
        
        $tag .= "<ol class=\"carousel-indicators\">";
        for($i = 0; $i < count($images); $i++)
        {
            $tag .= "<li data-target=\"{$id}\" data-slide-to=\"{$i}\" "+ ($images[$i]["ative"] === true ? "class=\"active\"" : "" ) +">";
        }
        $tag .= "</ol>";
        
        $tag .="<div class=\"carousel-list\" role=\"listbox\">";
        
        for($i = 0; $i < count($images); $i++)
        {
            $tag .= self::Thumbnail($images[$i],ThumbnailTipo::$carousel_image,$images[$i]["carousel-caption"]);
        }
        
        $tag .="</div>";
        
        $tag .= " <a class=\"left carousel-control\" href=\"{$id}\" role=\"button\" data-slide=\"prev\">
                    <span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Previous</span>
                  </a>";
                  
        $tag .= " <a class=\"right carousel-control\" href=\"{$id}\" role=\"button\" data-slide=\"next\">
                    <span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Next</span>
                  </a>";
        
        $tag .= "</div>";
        
        return $tag;
    }
    
    public function CollapseAccordion()
    {
    }
    
    public function Collapse()
    {
        
    }
}

abstract class NavBarTipo
{
    static $default = 0;
    static $fixed_top = 1;
    static $fixed_bottom = 2;
    static $static = 3;
}

abstract class NavBarBackGround
{
    static $default = 0;
    static $inverse = 1;
}

abstract class TipoDropDown
{
    static $button = 0;
    static $link = 1;
}

abstract class ThumbnailTipo
{
    static $link = 0;
    static $static = 1;
    static $carousel_image = 2;
}

abstract class TipoComponente
{
    static $default = "default";
    static $primary = "primary";
    static $success = "success";
    static $danger = "danger";
    static $info = "info";
    static $warning = "warning";
    
}