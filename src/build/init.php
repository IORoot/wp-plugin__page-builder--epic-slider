<?php

namespace andyp\pagebuilder\epicslider\build;

class init {

    private $config;

    private $result;


    public function set_config($config){
        $this->config = $config;
    }

    public function get_result(){
        return $this->result;
    }

    public function run(){
        $this->loop_contents();
    }

    
    private function loop_contents(){

        $this->add_css();

        $this->open_wrapper();

        $this->create_menu();

        $this->create_content();

        $this->close_wrapper();

        $this->add_javascript();
    }
    

    private function open_wrapper(){
        $this->result .= $this->config['wrapper_open'];
    }

    private function close_wrapper(){
        $this->result .= $this->config['wrapper_close'];
    }

    private function open_menu_wrapper(){
        $this->result .= $this->config['menu_wrapper_open'];
    }

    private function close_menu_wrapper(){
        $this->result .= $this->config['menu_wrapper_close'];
    }

    private function open_content_wrapper(){
        $this->result .= $this->config['content_wrapper_open'];
    }

    private function close_content_wrapper(){
        $this->result .= $this->config['content_wrapper_close'];
    }
    
    

    private function create_menu(){

        $menu = $this->config['menu_wrapper_open'];

        foreach ($this->config['epicslider_instance'] as $key => $instance)
        {
            $menu .= $instance["epicslider_menu"] . PHP_EOL;
        }

        $menu .= $this->config['menu_wrapper_close'];

        $this->result .= $menu;
    }


    private function create_content(){

        $content = $this->config['content_wrapper_open'];

        foreach ($this->config['epicslider_instance'] as $key => $instance)
        {
            $content .= $instance["epicslider_content"] . PHP_EOL;
        }

        $content .= $this->config['content_wrapper_close'];

        $this->result .= $content;
    }


    private function add_css()
    {
        $this->result .= $this->config['css'];
    }

    private function add_javascript()
    {
        add_action('page_builder_footer_code', function (){
            echo $this->config['javascript'];
        });

    }

}

