<?php

use CashRegister\Router\ApiRouter;
use CashRegister\Request\ApiRequest;

require __DIR__ . '/../bootstrap/api.php';

(new ApiRouter())->response(new ApiRequest())->output();
