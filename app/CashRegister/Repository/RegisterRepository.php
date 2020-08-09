<?php

namespace CashRegister\Repository;

use CashRegister\Model\Register;

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
}
