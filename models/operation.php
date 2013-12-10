<?php

require APP_MODELS_PATH . 'operationDb.php';

class Operation
{
    protected $_name;
    protected $_amount;

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
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
}
