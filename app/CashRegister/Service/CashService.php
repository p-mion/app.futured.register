<?php

namespace CashRegister\Service;

use CashRegister\Model\Bill;
use CashRegister\Repository\RegisterRepository;
use CashRegister\Repository\BillRepository;
use Log;

/**
 * Class CashService
 * @package CashRegister\Service
 */
class CashService
{
    /**
     * @var RegisterRepository
     */
    protected $registerRepostory;

    /**
     * @var BillRepository
     */
    protected $billRepostory;

    /**
     * CashService constructor.
     */
    public function __construct()
    {

        $this->registerRepostory = new RegisterRepository();
        $this->billRepostory = new BillRepository();
    }

    /**
     * @param $register_id
     * @param $price
     * @param int $amount
     * @return Bill|null
     */
    public function addPayment($register_id, $price, $amount = 1)
    {

        $register = $this->registerRepostory->get($register_id);
        if ($register) {

            $bill = $this->billRepostory->create($register, $price, $amount);
            if ($bill !== null) {

                Log::message(sprintf(__CLASS__ . ': bill %d, price: %s',
                    $bill->getId(), $bill->getPrice()));
                return $bill;
            }
        }

        return null;
    }

    /**
     * @param $bill_id
     * @return bool
     */
    public function deletePayment($bill_id)
    {
        return $this->billRepostory->delete($bill_id);
    }

    /**
     * @param $register_id
     * @return array
     */
    public function getAllBills($register_id)
    {

        return $this->billRepostory->all($register_id);
    }

    /**
     * @param $bill_id
     * @return Bill|null
     */
    public function getBill($bill_id)
    {

        return $this->billRepostory->get($bill_id);
    }

    /**
     * @param $register_id
     * @return array
     */
    public function getSummary($register_id)
    {
        return $this->registerRepostory->summary($register_id,
            $this->billRepostory->getBill());
    }
}
