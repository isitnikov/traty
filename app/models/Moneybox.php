<?php

class Moneybox extends ModelAbstract
{
    protected $_id;
    protected $_name;
    protected $_cost;
    protected $_accumulated;
    protected $_date;
    protected $_user;

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param mixed $accumulated
     */
    public function setAccumulated($accumulated)
    {
        $this->_accumulated = $accumulated;
    }

    /**
     * @return mixed
     */
    public function getAccumulated()
    {
        return $this->_accumulated;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->_cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->_cost;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }
} 