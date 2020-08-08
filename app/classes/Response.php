<?php


/**
 * Class Request
 */
class Response
{

    protected $type = 'json';
    protected $types = ['json', 'xml', 'csv', 'text'];

    public function __construct($type = null)
    {
        if ($type !== null && isset($this->types)) {

            $this->type = $type;
        }
    }

    public function output() {

    }
}
