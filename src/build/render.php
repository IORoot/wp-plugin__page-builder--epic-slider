<?php

namespace andyp\pagebuilder\epicslider\build;

class render
{
        
    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                         The complete wrapper                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_epicslider(){
        return '<div class="epicslider">';
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
        return '<div class="carousel flex gap-x-4 m-4">';
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
        return '<div class="w-full h-192" id="flickity-main" data-flickity>';
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
        return '<div class="carousel-cell w-full h-192"><div class="relative z-0 h-192 bg-smoke">';
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
        return '<div class="hidden md:flex w-1/5 h-192 gap-4 flex-col" id="flickity-control">';
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
        return '<div class="nav-item p-4 overflow-hidden rounded cursor-pointer relative flex-grow bg-mist hover:bg-smoke z-0">';
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
        return '<div class="item-content pointer-events-none flex items-center h-full gap-4">';
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
        return '<img class="rounded w-1/3 object-cover h-full z-10 relative pointer-events-none hidden lg:block" src="'.$image.'"></img>';
    }    


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Item Title.                               │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function item_title(string $title){
        return '<h3 class="relative z-10 font-normal text-lg">'.$title.'</h3>';
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Progress Bar.                             │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function progress_bar(){
        return '<div class="progress"></div>';
    }

}