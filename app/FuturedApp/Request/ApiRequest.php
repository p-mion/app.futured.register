<?php

namespace FuturedApp\Request;

use Request;

class ApiRequest extends Request
{

    protected $param_map = [
        'version',
        'register',
        'register_id',
        'bill',
        'bill_id',
    ];

}
