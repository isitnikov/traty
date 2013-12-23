<?php

class Operation
{
    protected $_amount;
    protected $_date;
    protected $_id;
    protected $_user;
    protected $_category;
    protected $_categoryObject;

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->_category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_category;
    }

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

    public function categoryObject()
    {
        if (!$this->_categoryObject) {
            $category = new Category();
            $category->load($this->_category);
            $this->_categoryObject = $category;
        }
        return $this->_categoryObject;
    }
}
