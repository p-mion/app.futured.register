<?php


/**
 * Class Request
 */
class Response
{

    /**
     * @var mixed|string
     */
    protected $type = 'json';
    /**
     * @var string[]
     */
    protected $types = [ 'json', 'text' ]; //  'xml', 'csv',  ];
    /**
     * @var array
     */
    protected $result = [];
    /**
     * @var int
     */
    protected $response_code = 200;

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

    /**
     * @param $var
     * @param string $key
     * @return $this
     */
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

        switch ($this->getType()) {
            case 'text':
                header('Content-Type: text/plain');
                $this->outputText();
                break;
            default:
                header('Content-Type: application/json');
                $this->outputJson();
        }

    }

    /**
     * @return mixed|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set output type
     * @param string enum $type
     */
    public function setType($type)
    {
        if ($type !== null && in_array($type, $this->types)) {

            $this->type = $type;
        }
    }

    /**
     *
     */
    public function outputText()
    {

        function outArray($array, $append = '')
        {

            foreach ($array as $key => $val) {

                if (is_array($val) || is_object($val)) {

                    outArray(
                        is_object($val) ? get_object_vars($val) : $val,
                        $append . ( $append === '' ? '' : '.' ) . $key
                    );
                } else {

                    printf('%s%s%s: %s' . PHP_EOL, $append, $append === '' ? '' : '.', $key, $val);
                }
            }
        }

        outArray($this->result);
    }

    /**
     *
     */
    public function outputJson()
    {
        print json_encode($this->result);
    }
}
