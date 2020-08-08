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
        return (new \Response())->add($this->service->getBill(
            $request->getParameter('bill_id')
        ), 'bill');

    }

    public function post(ApiRequest $request)
    {
        $data = $request->getPostData();
        $bill = $this->service->addPayment(
            $data['register_id'],
            $data['price'],
            $data['amount']
        );

        return (new \Response())->add($bill, 'bill');
    }

    public function delete(ApiRequest $request)
    {

    }
}
