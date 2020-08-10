<?php

/**
 * Class Log
 */

class Log
{

    /**
     * @param string $msg
     */
    public static function message($msg)
    {

        file_put_contents('php://stdout', $msg.PHP_EOL);

    }

    /**
     * @param string $msg
     */
    public static function error($msg)
    {

        file_put_contents('php://stderr', $msg.PHP_EOL);
    }
}
