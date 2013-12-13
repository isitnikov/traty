<?php

class Operation
{

    protected $_id;

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
    protected $_name;
    protected $_amount;
    protected $_date;

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
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $amount = trim(str_replace(',', '.', $amount));
        $this->_amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        if (!is_numeric($this->_amount)) {
            $this->_amount = 0;
        }
        return $this->_amount;
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

    public function save()
    {
        $db = new OperationDb();
        $db->save($this);
    }

    public function load($id)
    {
        $db = new OperationDb();
        $db->load($this, $id);
    }

    public function delete()
    {
        $db = new OperationDb();
        $db->delete($this);
    }
}
