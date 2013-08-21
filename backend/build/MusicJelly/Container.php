<?php

namespace MusicJelly;

use Pimple;

class Container extends Pimple {
	
	public function __construct($options=null){
		if($options['entityManager']){
			$this['entityManager'] = $options['entityManager'];
		}
    }

    public static function Instance($options=null){
    	static $inst = null;
        if ($inst === null) {
            $inst = new Container($options);
        }
        return $inst;
    }

}
