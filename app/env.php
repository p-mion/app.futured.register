<?php


/**
 * Setup ini file as env variables
 * set possible global values
 * @param $file
 */

function env_ini($file)
{

    if (!file_exists($file)) {

        return;
    }

    if (function_exists('env_set')) {

        return;
    }

    function env_set($n, $v)
    {

        if (function_exists('apache_getenv') && function_exists('apache_setenv') && apache_getenv($n)) {
            apache_setenv($n, $v);
        }
        if (function_exists('putenv')) {
            putenv(sprintf("%s=%s", $n, $v));
        }

        $_ENV[ $n ] = $v;
        $_SERVER[ $n ] = $v;
    }

    $data = parse_ini_file($file, true);
    if (!empty($data)) {
        foreach ($data as $ext => $value) {

            if (is_array($value)) {

                foreach ($value as $k => $v) {

                    ini_set(sprintf('%s.%s', $ext, $k), $v);
                    env_set($k, $v);
                }
            } else {

                env_set($ext, $value);
            }
        }
    }
}

/**
 * @param $n
 */
function env($key)
{

    return isset($_ENV[ $key ]) ? $_ENV[ $key ] : null;
}
