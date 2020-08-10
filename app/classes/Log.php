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

        self::out($msg);

    }

    /**
     * @param string $msg
     * @param int $level
     */
    public static function out($msg, $level = LOG_INFO)
    {

        file_put_contents('php://stdout', $msg.PHP_EOL);
    }

    /**
     * @param string $msg
     */
    public static function error($msg)
    {

        self::out($msg, LOG_ERR);
    }
}
