<?php
require_once dirname(__FILE__) . '/../../../../core/amf/app/Gateway.php';

require_once AMFPHP_BASE . 'amf/io/AMFSerializer.php';


class Wrapper_AMFSerializer extends AMFSerializer
{
    public function writeAmf3String($d, $raw = false)
    {
        return parent::writeAmf3String($d, $raw);
    }
}
?>