<?php

namespace CashRegister\Repository;

use CashRegister\Model\Bill;
use CashRegister\Model\Register;
use CashRegister\Model\Summary;

/**
 * Class RegisterRepository
 */
class RegisterRepository
{

    /**
     * @var Register
     */
    protected $base;

    /**
     * RegisterRepository constructor.
     * @param Register|null $base
     */
    public function __construct(Register $base = null)
    {

        if ($base === null) {

            $base = new Register();
        }

        $this->base = $base;
    }

    /**
     * @param integer $register_id
     * @return Register|null
     */
    public function get($register_id): ?Register
    {
        $register = $this->getRegister();
        $result = \DB::instance()->getRecords(
            sprintf('SELECT * FROM `%s` WHERE id=:id', $register->getTableName()),
            [ 'id' => (int)$register_id ],
            $register
        );

        if (is_array($result)) {

            return current($result);
        }

        return null;
    }

    /**
     * @return Register
     */
    public function getRegister(): Register
    {

        if ($this->base === null) {

            $this->base = new Register();
        }
        return $this->base;
    }

    /**
     * @param integer $register_id
     * @return Summary
     */
    public function summary($register_id, Bill $bill)
    {

        $register = $this->get($register_id);
        $summary = new Summary();

        $result = \DB::instance()->getRecords(
            sprintf('SELECT SUM(price*amount) AS summary_price, 
                MAX(created_at) AS bill_last_date
                FROM `%s` WHERE register_id=:register_id AND NOT canceled
                GROUP BY register_id', $bill->getTableName()),
            [ 'register_id' => $register->getId() ],
            $summary
        );

        if (is_array($result)) {

            $summary = current($result);
        }

        if (is_object($summary)) {
            $summary->setRegister($register);
        }

        return $summary;
    }
}
