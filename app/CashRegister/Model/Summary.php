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
    public $bill_last_date;
    /**
     * @var float
     */
    public $summary_price;

    /**
     * @return mixed
     */
    public function getLastBillDate()
    {
        return $this->last_bill_date;
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
     * @param float $summary_price
     */

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
