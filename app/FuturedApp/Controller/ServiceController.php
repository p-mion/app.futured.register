<?php


namespace FuturedApp\Controller;

use FuturedApp\Service\CashService;

class ServiceController
{

    /**
     * @var CashService
     */
    protected $service;

    public function __construct()
    {
        $this->service = new CashService();
    }

    public function all(\Request $request) {

        $this->service->getAllBills();
    }
}
