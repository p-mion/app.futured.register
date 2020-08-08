<?php

namespace FuturedApp\Repository;

use FuturedApp\Model\Bill;

/**
 * Class RegisterRepository
 */
class BillRepository
{

    /**
     * @var Bill
     */
    protected $base;

    public function __construct(Bill $base = null)
    {

        if ($base === null) {

            $base = new Bill();
        }

        $this->base = $base;
    }

    public function getBill()
    {

        if ($this->base === null) {

            $this->base = new Bill();
        }
        return $this->base;
    }
}
