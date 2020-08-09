<?php

namespace FuturedApp\Model;

/**
 * Class Bill
 */
class Bill
{

    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    public $created_at;
    /**
     * @var float
     */
    public $price;
    /**
     * @var integer
     */
    public $amount;
    /**
     * @var string
     */
    protected $table_name = 'bills';

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param float $price
     * @return boolean
     */
    public function setPriceRaw($price)
    {
        $this->setPrice( (float) $price);
        return $this->price !== 0.0;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @param int $amount
     * @return boolean
     */
    public function setAmountRaw($amount)
    {
        $this->setAmount((int)$amount);
        return $this->amount !== 0;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->table_name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at = null): void
    {
        $this->created_at = $created_at ?: strftime('%Y-%m-%d %H:%M:%S');
    }

}
