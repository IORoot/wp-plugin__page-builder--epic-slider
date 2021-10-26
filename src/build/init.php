<?php

namespace andyp\pagebuilder\epicslider\build;

use andyp\pagebuilder\epicslider\build\render;

class init {

    private $config;

    private $query_results;

    private $render;
    
    private $result;

    public function set_config($config){
        $this->config = $config;
    }

    public function get_result(){
        return $this->result;
    }

    public function run(){
        $this->render = new render($this->config);
        $this->create_content();
    }

    
    private function create_content(){

        $this->query();

        $this->query_metadata();

        $this->open_epicslider();

        $this->css_stylesheet();

        $this->add_css();

        $this->open_carousel();

        $this->main_content();

        $this->add_navigation();

        $this->close_carousel();

        $this->add_javascript();

        $this->js_script();
        
        $this->close_epicslider();
    }
    
    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               Query the DB.                             │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */
    private function query()
    {
        if (empty($this->config['wp_query'])){ return; }

        $post_query = $this->config['wp_query'];

        $args = eval("return $post_query;");

        $this->query_results = get_posts($args);
    }

    /**
     * get each results metadata as well
     */
    private function query_metadata()
    {

        if (empty($this->query_results)){ return; }

        foreach ($this->query_results as $key => $WP_Post) {
            $this->query_results[$key] = [];
            $this->query_results[$key]['post'] = $WP_Post;
            $this->query_results[$key]['meta'] = get_metadata('post', $WP_Post->ID);
        }
    }

            
    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                         The complete wrapper                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    public function open_epicslider(){
        $this->result .= $this->render->open_epicslider();
    }

    public function close_epicslider(){
        $this->result .= $this->render->close_epicslider();
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                             Carousel container.                         │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    private function open_carousel(){
        $this->result .= $this->render->open_carousel();
    }

    private function close_carousel(){
        $this->result .= $this->render->close_carousel();
    }
    

    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                          Flickity Container.                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */
    private function main_content(){

        if ( empty($this->query_results)) {
            return;
        }

        $content = $this->render->open_flickity_main();

        foreach ($this->query_results as $loop_key => $loop_post)
        {
            $content .= $this->render->open_carousel_cell();
            $content .= $loop_post["meta"]["builder_instance_0_organism_0_raw_code"][0];
            $content .= $this->render->close_carousel_cell();
        }

        $content .= $this->render->close_flickity_main();

        $this->result .= $content;

    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                           Navigation Buttons.                           │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */
    private function add_navigation(){
        
        $content .= $this->render->open_flickity_control();

        foreach ($this->query_results as $loop_key => $loop_post) {

            $image = get_the_post_thumbnail_url($loop_post["post"]->ID);
            $title = $loop_post["post"]->post_title;

            $content .= $this->render->open_nav_item();

            $content .= $this->render->open_nav_item_content();

            if (isset($loop_post["meta"]["epicslider_button"][0])){
                $content .= $this->render->item_button($loop_post["meta"]["epicslider_button"][0]);
            } else {

                $content .= $this->render->item_image($image);

                $content .= $this->render->item_title($title);
                
            }

            $content .= $this->render->close_nav_item_content();

            $content .= $this->render->progress_bar();

            $content .= $this->render->close_nav_item();
        }

        $content .= $this->render->close_flickity_control();

        $this->result .= $content;
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                             Include The CSS.                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */
    private function css_stylesheet()
    {   
        if ($this->config["load_flickity_style"]){
            $this->result .= '<link rel="stylesheet" href="'.ANDYP_EPICSLIDER_URL . 'src/assets/flickity.min.css">';
        }
        if ($this->config["load_epicslider_style"]){
            $this->result .= '<link rel="stylesheet" href="'.ANDYP_EPICSLIDER_URL . 'src/assets/epicslider.css">';
        }
    }

    private function add_css()
    {
        $this->result .= $this->config['additional_css'];
    }


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                              Include The JS.                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */
    private function js_script()
    {
        if ($this->config["load_flickity_js"]){
            $this->result .= '<script src="'.ANDYP_EPICSLIDER_URL . 'src/assets/flickity.min.js"></script>';
        }
        if ($this->config["load_epicslider_js"]){
            $this->result .= '<script src="'.ANDYP_EPICSLIDER_URL . 'src/assets/epicslider.js"></script>';
        }      
        
    }


    private function add_javascript()
    {
        add_action('page_builder_footer_code', function (){
            echo $this->config['additional_js'];
        });
    }


}