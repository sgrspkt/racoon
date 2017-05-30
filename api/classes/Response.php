<?php


class Response
{
    public $data;
    public $status = array();

    function __construct( $data )
    {
        $this->data = $data;
    }

    function toJson() {
         die( json_encode($this->data) );
    }

    function array_to_xml($array, &$xml_user_info) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml_user_info->addChild("$key");
                    array_to_xml($value, $subnode);
                }else{
                    $subnode = $xml_user_info->addChild("item$key");
                    array_to_xml($value, $subnode);
                }
            }else {
                $xml_user_info->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }

    function statusMessage() {
        $this->status = array(
            200 => "OK",
            201 => "Created",
            204 => "No content",
            404 => "Not Found",
            406 => "Not acceptable"
        );
        return ($this->status['200']) ? $this->status['200'] : $this->status['406'];
    }
}