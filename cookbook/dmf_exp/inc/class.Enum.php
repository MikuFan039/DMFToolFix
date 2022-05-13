<?php if (!defined('PmWiki')) exit();
class Enum {
    protected $self = array();
    public function __construct( /*...*/ ) {
        $args = func_get_args();
        for( $i=0, $n=count($args); $i<$n; $i++ )
            $this->add($args[$i]);
    }
   
    public function __get( /*string*/ $name = null ) {
        return $this->self[$name];
    }
   
    public function add( /*string*/ $name = null, /*int*/ $enum = null ) {
        if( isset($enum) )
            $this->self[$name] = $enum;
        else
            $this->self[$name] = end($this->self) + 1;
    }
}

/*
 * <?php
 * $eFruits = new Enum("APPLE", "ORANGE", "PEACH");
 * echo $eFruits->APPLE . ",";
 * echo $eFruits->ORANGE . ",";
 * echo $eFruits->PEACH . "\n";
 * 
 * $eBeers = new DefinedEnum("GUINESS" => 25, "MIRROR_POND" => 49);
 * echo $eBeers->GUINESS . ",";
 * echo $eBeers->MIRROR_POND . "\n";
 * 
 * $eFlags = new FlagsEnum("HAS_ADMIN", "HAS_SUPER", "HAS_POWER", "HAS_GUEST");
 * echo $eFlags->HAS_ADMIN . ",";
 * echo $eFlags->HAS_SUPER . ",";
 * echo $eFlags->HAS_POWER . ",";
 * echo $eFlags->HAS_GUEST . "\n";
 * ?>
 */
 