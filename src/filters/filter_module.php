<?php

namespace andyp\pagebuilder\epicslider\filters;

use andyp\pagebuilder\epicslider\build\init;

class filter_module
{

    public function __construct()
    {
        add_filter('pagebuilder_epicslider', [$this, 'filter_code'], 10, 1);
    }


    public function filter_code($organism)
    {
        if (empty($organism['enabled'])){ return; }
        if ($organism['acf_fc_layout'] != 'epicslider'){ return; }

        $epicslider = new init;
        $epicslider->set_config($organism);
        $epicslider->run();

        return $epicslider->get_result();
    }

}