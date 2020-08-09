<?php


namespace CashRegister\Controller;

use CashRegister\Request\ApiRequest;
use CashRegister\Service\CashService;
use http\Env\Response;

/**
 * Class ServiceController
 * @package CashRegister\Controller
 */
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

        return ( new \Response() )->add($this->service->getAllBills(
            $request->getParameter('register_id')), 'bills');
    }

    public function get(ApiRequest $request)
    {
        $bill = $this->service->getBill(
            $request->getParameter('bill_id'));

        $response = new \Response();
        if ($bill) {

            return $response->add($bill, 'bill');
        }

        return $response->notFound(sprintf(
            'bill %d not found', $request->getParameter('bill_id')));
    }

    public function post(ApiRequest $request)
    {
        $data = $request->getPostData();
        $bill = $this->service->addPayment(
            $data[ 'register_id' ],
            $data[ 'price' ],
            $data[ 'amount' ]
        );

        if (!$bill) {

            return ( new \Response() )->notFound('bill post method failed');
        }

        return ( new \Response() )->add($bill, 'bill');
    }

    public function delete(ApiRequest $request)
    {

        $bill_id = $request->getParameter('bill_id');
        $response = new \Response();
        if ($this->service->deletePayment($bill_id)) {

            $response->add(sprintf('bill %d deleted', $bill_id), 'success');
        } else {

            $response->add(sprintf('delete bill %d failed', $bill_id), 'error');
        }

        return $response;
    }

}
