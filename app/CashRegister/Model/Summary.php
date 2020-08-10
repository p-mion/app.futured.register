<?php

namespace CashRegister\Model;

/**
 * Class Bill
 */
class Summary
{

    /**
     * @var Register
     */
    public $register;
    /**
     * @var string
     */
    public $bill_last_date = '0000-00-00 00:00:00';
    /**
     * @var integer
     */
    public $bill_count = 0;
    /**
     * @var float
     */
    public $summary_price = 0.00;

    /**
     * @return mixed
     */
    public function getLastBillDate()
    {
        return $this->last_bill_date;
    }

    /**
     * @return integer
     */
    public function getBillCount()
    {
        return $this->bill_count;
    }

    /**
     * @param mixed $last_bill_date
     */

    /**
     * @return float
     */
    public function getSummaryPrice(): float
    {
        return $this->summary_price;
    }

    /**
     * @return mixed
     */
    public function getRegister()
    {
        return $this->register_id;
    }

    /**
     * @param Register $register
     */
    public function setRegister(Register $register)
    {
        $this->register = $register;
    }

}
