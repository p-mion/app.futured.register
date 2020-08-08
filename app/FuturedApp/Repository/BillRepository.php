<?php

namespace FuturedApp\Repository;

use FuturedApp\Model\Bill;
use FuturedApp\Model\Register;

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

    /**
     * @param int $register_id
     * @return array
     */
    public function all($register_id): array
    {
        $bill = $this->getBill();
        return \DB::instance()->getRecords(
            sprintf('SELECT * FROM `%s` WHERE register_id=:register_id', $bill->getTableName()),
            [ 'register_id' => (int)$register_id ],
            $bill
        );

    }

    public function getBill()
    {

        if ($this->base === null) {

            $this->base = new Bill();
        }
        return $this->base;
    }

}
