<?php

namespace Freniz\ResponseMacros\Macros;

use Freniz\ResponseMacros\ResponseMacroInterface;
use Config;

class Custom implements ResponseMacroInterface
{
    public function run($factory)
    {

        
        $factory->macro('custom', function ($data, $status = 200) use ($factory) {

            $custom = Config::get('laravelmacros.custom', array('message'));

            $results = [];

            if(count($data) == count($custom)){
                $count = count($data);
            }else{

                $results = array($custom[0] => 'No matching data. Please check the config or input data.');

                return $results;
            }
            
            if(empty($results))
            {
                if(is_array($custom))
                {
                    for ($x = 0; $x <= $count-1; $x++) {
                        
                        $results [ $custom[$x] ] = $data[$x];

                    } 
                }
            }

            return $factory->make($results, $status);
        });
    }
}
