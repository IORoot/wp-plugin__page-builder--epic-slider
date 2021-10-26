<?php

namespace andyp\pagebuilder\epicslider\build;

class render
{
    private $config;

    public function __construct($config){
        $this->config = $config;
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                         The complete wrapper                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_epicslider(){
        return '<div class="'.$this->config['wrapper_classes'].'">';
    }

    public function close_epicslider(){
        return '</div>';
    }

    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                             Carousel container.                         │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_carousel(){
        return '<div class="'.$this->config['carousel_classes'].'">';
    }

    public function close_carousel(){
        return '</div>';
    }

    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Flickity Main.                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_flickity_main(){
        return '<div id="flickity-main" class="'.$this->config["flickity_main_classes"].'" data-flickity>';
    }

    public function close_flickity_main(){
        return '</div>';
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Carousel Cell.                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_carousel_cell(){
        return '<div class="'.$this->config["carousel_cell_outer_classes"].'"><div class="'.$this->config["carousel_cell_inner_classes"].'">';
    }

    public function close_carousel_cell(){
        return '</div></div>';
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                    Navigation Buttons. (wrapper)                        │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_flickity_control(){
        return '<div id="flickity-control" class="'.$this->config["flickity_control_classes"].'">';
    }

    public function close_flickity_control(){
        return '</div>';
    }

    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                             Navigation Item.                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_nav_item(){
        return '<div class="'.$this->config["nav_item_classes"].'">';
    }

    public function close_nav_item(){
        return '</div>';
    }        
    
    
    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                         Navigation Item Content.                        │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_nav_item_content(){
        return '<div class="'.$this->config["item_content_classes"].'">';
    }

    public function close_nav_item_content(){
        return '</div>';
    }       
    
    
    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Item Image.                               │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function item_image(string $image){
        return '<img class="'.$this->config["image_classes"].'" src="'.$image.'"></img>';
    }    


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Item Title.                               │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */  

    public function item_title(string $title){
        return '<div class="'.$this->config["title_classes"].'">'.$title.'</div>';
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                       (optional) Item Button.                           │░
    *   │                     Will replace image and title                        │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */
    public function item_button(string $subtitle){
        return $subtitle;
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Progress Bar.                             │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function progress_bar(){
        return '<div class="'.$this->config["progress_bar_classes"].'"></div>';
    }

}