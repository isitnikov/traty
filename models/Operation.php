<?php

require APP_MODELS_PATH . 'OperationDb.php';
require APP_MODELS_PATH . 'OperationCollection.php';

class Operation
{
    protected $_name;
    protected $_amount;
    protected $_date;

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $dateArray = explode('/', $date);
        $day = trim($dateArray[0]);
        $month = trim($dateArray[1]);
        $year = trim($dateArray[2]);

        $date = sprintf("%s-%s-%s 00:00:00", $year, $month, $day);
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
}
