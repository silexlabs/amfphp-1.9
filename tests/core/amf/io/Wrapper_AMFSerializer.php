<?php
// $Id$

require_once dirname(__FILE__) . '/../../../../core/amf/app/Gateway.php';

require_once AMFPHP_BASE . 'amf/io/AMFSerializer.php';


/**
 * This class exports some internal (protected) methods. This way, those methods
 * can be tested separately.
 */

class Wrapper_AMFSerializer extends AMFSerializer
{
    /* public */ function writeAmf3Data(&$d)
    {
        return parent::writeAmf3Data($d);
    }


    /* public */ function writeAmf3String($d, $raw = FALSE)
    {
        return parent::writeAmf3String($d, $raw);
    }


    /* public */ function writeAmf3Array(array $d, $arrayCollectionable = FALSE)
    {
        return parent::writeAmf3Array($d, $arrayCollectionable);
    }
}
?>