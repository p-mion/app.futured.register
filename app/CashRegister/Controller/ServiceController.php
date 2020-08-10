<?php


namespace CashRegister\Controller;

use CashRegister\Request\ApiRequest;
use CashRegister\Service\CashService;

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

    /**
     * ServiceController constructor.
     */
    public function __construct()
    {
        $this->service = new CashService();
    }

    /**
     * @param ApiRequest $request
     * @return \Response
     */
    public function all(ApiRequest $request)
    {

        return ( new \Response() )->add($this->service->getAllBills(
            $request->getParameter('register_id')), 'bills');
    }

    /**
     * @param ApiRequest $request
     * @return \Response
     */
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

    /**
     * @param ApiRequest $request
     * @return \Response
     */
    public function summary(ApiRequest $request)
    {

        $summary = $this->service->getSummary(
            $request->getParameter('register_id'));

        $response = new \Response();
        if ($summary) {

            return $response->add($summary, 'summary');
        }

        return $response->notFound(sprintf(
            'register %d not found', $request->getParameter('register_id')));
    }

    /**
     * @param ApiRequest $request
     * @return \Response
     */
    public function post(ApiRequest $request)
    {
        $data = $request->getPostData();
        $bill = $this->service->addPayment(
            $request->getParameter('register_id'),
            $data[ 'price' ],
            $data[ 'amount' ] ?: 1
        );

        if (!$bill) {

            return ( new \Response() )->notFound('bill post method failed');
        }

        return ( new \Response() )->add($bill, 'bill');
    }

    /**
     * @param ApiRequest $request
     * @return \Response
     */
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
