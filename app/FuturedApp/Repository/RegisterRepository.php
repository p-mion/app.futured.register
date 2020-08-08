<?php

namespace FuturedApp\Repository;

use FuturedApp\Model\Register;

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
     * @param string $token
     * @return Register|null
     */
    public function getByToken($token): ?Register
    {

        $register = clone $this->getRegister();
        $register->setTokenRaw($token);

        $result = DB::instance()->getRecords(
            sprintf('SELECT * FROM `%s` WHERE token=:token', $register->getTableName()),
            [ 'token' => $register->getToken() ],
            $this->getRegister()
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
