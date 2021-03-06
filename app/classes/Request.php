<?php


/**
 * Class Request
 */
class Request
{
    /**
     * @const string
     */
    public const DELIMITER = '/';
    /**
     * @var array
     */
    protected $headers = [];
    /**
     * @var array
     */
    protected $post_data;

    /**
     * @var array
     */
    protected $param_map = [
        'value',
    ];

    /**
     * @var array
     */
    protected $params;

    public function __construct()
    {

        $original_headers = getallheaders();
        if (is_array($original_headers)) {

            foreach ($original_headers as $key => $val) {

                if (strpos($key, 'X-') === 0) {
                    $this->headers[ $key ] = $val;
                }
            }
        }

    }

    /**
     * @return string
     */
    public function getMethod()
    {

        return strtoupper($_SERVER[ 'REQUEST_METHOD' ]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getParameter($key = 'version')
    {

        $data = $this->resolveParams();
        return isset($data[ $key ]) ? $data[ $key ] : null;
    }

    /**
     * @return array
     */
    protected function resolveParams()
    {

        if ($this->params === null) {

            $parts = parse_url(trim($_SERVER[ 'REQUEST_URI' ], self::DELIMITER));

            $this->params = [];

            if (!empty($parts[ 'query' ])) {

                parse_str($parts[ 'query' ], $this->params);
            }

            if (!empty($parts[ 'path' ])) {

                $params = explode(self::DELIMITER, $parts['path']);

                foreach ($this->param_map as $idx => $key) {

                    if (!empty($params[ $idx ])) {

                        $this->params[ $key ] = $params[ $idx ];
                    }
                }
            }
        }
        return $this->params;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasParameter($key)
    {
        $data = $this->resolveParams();
        return !empty($data[ $key ]);
    }

    /**
     * @return array
     */
    public function getParameters()
    {

        return $this->resolveParams();
    }

    public function getHeader($key)
    {

        return $this->headers[ $key ] ?: null;
    }

    public function getPostData()
    {

        if ($this->post_data === null) {

            $data = file_get_contents('php://input');
            if ($this->getContentType() === 'application/json') {

                $this->post_data = json_decode($data, true);
            } else {

                parse_str($data, $this->post_data);
            }
        }

        return $this->post_data;
    }

    public function getContentType()
    {

        return $_SERVER[ 'CONTENT_TYPE' ] ?? '';
    }
}
