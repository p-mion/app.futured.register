<?php


/**
 * Class Request
 */
class Response
{

    /**
     * @var string
     */
    protected $response = "";
    /**
     * @var array
     */
    protected $result = [];
    /**
     * @var int
     */
    protected $response_code = 403;

    /**
     * @var mixed|string
     */
    protected $type = 'json';
    /**
     * @var string[]
     */
    protected $types = [ 'json', 'xml', 'csv', 'text' ];

    /**
     * Response constructor.
     * @param null $type
     */
    public function __construct($type = null)
    {
        if ($type !== null && isset($this->types)) {

            $this->type = $type;
        }
    }

    /**
     * @param $msg
     */
    public function forbidden($msg)
    {

        $this->response_code = 403;
        $this->response = [
            'forbidden' => $msg,
        ];
    }

    /**
     * @param $msg
     */
    public function notFound($msg)
    {

        $this->response_code = 403;
        $this->response = [
            'notfound' => $msg,
        ];
    }

    public function add($var, $key = 'result') {

        $this->result[$key] = $var;
        return $this;
    }

    /**
     *
     */
    public function output()
    {

        header('Content-Type: application/json');
        print json_encode($this->result);
    }
}
