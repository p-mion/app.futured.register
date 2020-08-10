<?php

namespace CashRegister\Service;


/**
 * Class LogService
 * @package CashRegister\Service
 */
class LogService
{

    /**
     * @var
     */
    protected static $_instance;

    /**
     * @return LogService
     */
    public static function instance() {

        if (self::$_instance === null) {

            self::$_instance = new LogService();
        }

        return self::$_instance;
    }

    /**
     * @param string $msg
     */
    public function message($msg) {

        \Log::message(sprintf("[%s] %s", $_SERVER['REQUEST_METHOD'], $msg));
    }

    /**
     * @param string $msg
     */
    public function error($msg) {

        \Log::error(sprintf("[%s] %s", $_SERVER['REQUEST_METHOD'], $msg));
    }
}
