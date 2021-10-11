<?php

namespace andyp\pagebuilder\epicslider\build;

class init {

    private $config;

    private $query_results;

    private $result;


    public function set_config($config){
        $this->config = $config;
    }

    public function get_result(){
        return $this->result;
    }

    public function run(){
        $this->create_content();
    }

    
    private function create_content(){

        $this->query();

        $this->query_metadata();

        $this->add_css();

        $this->open_carousel();

        $this->main_content();

        $this->add_navigation();

        $this->close_carousel();

        $this->add_javascript();
    }
    


    private function open_carousel(){
        $this->result .= '<div class="carousel flex gap-x-4 m-4">';
    }

    private function close_carousel(){
        $this->result .= '</div>';
    }
    

    private function main_content(){

        if ( empty($this->query_results)) {
            return;
        }

        $content = '<div class="w-full h-192" id="flickity-main" data-flickity>';

        foreach ($this->query_results as $loop_key => $loop_post)
        {
            $content .= '<div class="carousel-cell w-full h-192"> <div class="relative z-0 h-192 bg-gray-300">';
            $content .= $loop_post["meta"]["builder_instance_0_organism_0_raw_code"][0];
            $content .= '</div></div>';
        }

        $content .= '</div>';

        $this->result .= $content;

    }



    private function add_navigation(){
        
        $content .= '<div class="hidden md:flex w-1/5 h-192 gap-4 flex-col" id="flickity-control">';

        foreach ($this->query_results as $loop_key => $loop_post) {
            $content .= '<div class="nav-item p-4 overflow-hidden rounded-2xl cursor-pointer relative flex-grow bg-gray-100 hover:bg-gray-300 z-0">';
            $content .= '<div class="item-content pointer-events-none flex items-center h-full gap-4">';

            $image = get_the_post_thumbnail_url($loop_post["post"]->ID);

            $content .= '<img class="rounded-2xl w-1/3 object-cover h-full z-10 relative pointer-events-none hidden lg:block" src="'.$image.'"></img>';

            $content .= '<h3 class="relative z-10 font-normal text-lg">'.$loop_post["post"]->post_title.'</h3>';

            $content .= '</div><div class="progress"></div></div>';
        }

        $content .= '</div>';

        $this->result .= $content;
    }




    private function add_svg(){

        $this->result .= '<svg xmlns="http://www.w3.org/2000/svg" style="width:0;height:0;visibility:hidden;" class="svg-inherit">
            <symbol id="open-external" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M14,3V5H17.59L7.76,14.83L9.17,16.24L19,6.41V10H21V3M19,19H5V5H12V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19Z"></path>
            </symbol>
        </svg>';

    }

    private function add_css()
    {
        $this->result .= $this->config['additional_css'];
    }


    private function add_javascript()
    {
        add_action('page_builder_footer_code', function (){
            echo $this->config['additional_js'];
        });
    }

    /**
     * query database for results
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

}

