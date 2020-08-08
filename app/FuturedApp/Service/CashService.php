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

    public function addPayment($register_id, $price, $amount = 1)
    {
        $register = $this->registerRepostory->get($register_id);
        if ($register) {


        }

    }

    public function cancelPayment($bill_id)
    {


    }

    public function deletePayment($bill_id)
    {


    }

    public function getAllBills($register_id) {


        return $this->billRepostory->all($register_id);

    }
}
