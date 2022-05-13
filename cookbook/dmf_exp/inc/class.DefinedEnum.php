<?php if (!defined('PmWiki')) exit();
class DefinedEnum extends Enum {
    public function __construct( /*array*/ $itms ) {
        foreach( $itms as $name => $enum )
            $this->add($name, $enum);
    }
}