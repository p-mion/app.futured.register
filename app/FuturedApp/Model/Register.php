<?php

namespace FuturedApp\Model;

/**
 * Class Register
 */
class Register
{

    /**
     * @var string id
     */
    public $id;
    /**
     * @var string name
     */
    public $label;
    /**
     * @var string name
     */
    public $token;
    /**
     * @var string
     */
    protected $table_name = 'registers';

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param string $token
     */
    public function setTokenRaw(string $token): void
    {
        $this->token = preg_replace('/[^a-z0-9]/', '', strtolower(trim($token)));
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->table_name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }
}
