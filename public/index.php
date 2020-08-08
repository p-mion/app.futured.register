<?php

use FuturedApp\Router\ApiRouter;
use FuturedApp\Request\ApiRequest;

require __DIR__ . '/../bootstrap/api.php';

(new ApiRouter())->response(new ApiRequest())->output();
