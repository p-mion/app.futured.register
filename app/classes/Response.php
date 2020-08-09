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
    protected $response_code = 200;

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
     * @return Response
     */
    public function forbidden($msg)
    {

        $this->response_code = 403;
        $this->result = [
            'forbidden' => $msg,
        ];

        return $this;
    }

    /**
     * @param $msg
     * @return Response
     */
    public function notFound($msg)
    {

        $this->response_code = 404;
        $this->result = [
            'notfound' => $msg,
        ];

        return $this;
    }

    public function add($var, $key = 'result')
    {

        $this->result[ $key ] = $var;
        return $this;
    }

    /**
     *
     */
    public function output()
    {

        http_response_code($this->response_code);
        header('Content-Type: application/json');
        print json_encode($this->result);
    }
}
