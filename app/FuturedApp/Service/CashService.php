<?php

namespace FuturedApp\Service;

use FuturedApp\Repository\RegisterRepository;
use FuturedApp\Repository\BillRepository;

class CashService
{
    /**
     * @var RegisterRepository
     */
    protected $registerRepostory;

    public function __construct()
    {

        $this->registerRepostory = new RegisterRepository();
        $this->billRepostory = new BillRepository();
    }

    public function addPayment($token, $price, $amount = 1)
    {
        $register = $this->registerRepostory->getByToken($token);
        if ($register) {


        }

    }

    public function cancelPayment($token, $bill_id)
    {


    }

    public function deletePayment($token, $bill_id)
    {


    }

}
