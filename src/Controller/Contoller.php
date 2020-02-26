<?php

namespace BenchmarkMaster\Controller;

use BenchmarkMaster\Model\Report;

/**
 * Class Controller
 * @package BenchmarkMaster\Controller
 */
class Controller {

    /**
     *
     */
    public function setup(){
        $functions = array(
            'function1' => function($echo) {
                echo $echo;
            },
            'function2' => function($echo) {
                echo $echo;
            },
            'function3' => function($echo) {
                echo $echo;
            },
            'function4' => function($echo) {
                echo $echo;
            },
            'function5' => function($echo) {
                echo $echo;
            },
        );

        $report = new Report($functions);
    }

    /**
     *
     */
    public function init(){
        $i = 0;
        while($i < 1000) {
            $tmp[] = '';
            ++$i;
        }
    }

    /**
     *
     */
    public function destroy(){
    }
}
