<?php


namespace FuturedApp\Controller;

use FuturedApp\Request\ApiRequest;
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

    public function all(ApiRequest $request)
    {

        return (new \Response())->add($this->service->getAllBills(
            $request->getParameter('register_id')), 'bills');
    }

    public function get(ApiRequest $request)
    {

    }

    public function post(ApiRequest $request)
    {

    }

    public function delete(ApiRequest $request)
    {

    }
}
