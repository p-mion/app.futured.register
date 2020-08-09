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

    /**
     * BillRepository constructor.
     * @param Bill|null $base
     */
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
            sprintf('SELECT * FROM `%s` WHERE register_id=:register_id AND NOT canceled', $bill->getTableName()),
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

    /**
     * @param Register $register
     * @param $price
     * @param int $amount
     * @return Bill|null
     */
    public function create(Register $register, $price, $amount = 1)
    {

        $bill = $this->getBill();

        if (!$bill->setPriceRaw($price)) {

            return null;
        }

        if (!$bill->setAmountRaw($amount)) {

            return null;
        }

        $stmt = \DB::instance()->conn()->prepare(sprintf(
            'INSERT INTO `%s` SET 
                     register_id=:register_id, price=:price, amount=:amount',
            $bill->getTableName()
        ));

//        $register_id = $register->getId();
//        $stmt->bindParam(':register_id', $register_id, \PDO::PARAM_INT);
//
//        $price = $bill->getPrice();
//        $stmt->bindParam(':price', $price, \PDO::PARAM_STR);
//
//        $amount = $bill->getAmount();
//        $stmt->bindParam(':amount', $amount, \PDO::PARAM_INT);

        $stmt->execute([
            'register_id' => $register->getId(),
            'price' => $bill->getPrice(),
            'amount' => $bill->getAmount(),
        ]);

        // \DB::instance()->conn()->commit();

        $last_id = \DB::instance()->conn()->lastInsertId();

        return $this->get($last_id);
    }

    /**
     * @param int $bill_id
     * @return Bill|null
     */
    public function get($bill_id)
    {
        $bill = $this->getBill();
        $result = \DB::instance()->getRecords(
            sprintf('SELECT * FROM `%s` WHERE id=:id AND NOT canceled', $bill->getTableName()),
            [ 'id' => (int)$bill_id ],
            $bill
        );

        if (is_array($result)) {

            $bill =  current($result);
        } else {

            $bill = null;
        }

        return $bill;
    }

    /**
     * @param int $bill_id
     * @return boolean
     */
    public function delete($bill_id)
    {

        $bill = $this->get($bill_id);

        if ($bill) {

            $stmt = \DB::instance()->conn()->prepare(sprintf(
                'UPDATE `%s` SET canceled=1
                     WHERE id=:bill_id',
                $bill->getTableName()
            ));

            $stmt->execute([
                'bill_id' => $bill->getId(),
            ]);

        }

        return $bill !== null;
    }
}
