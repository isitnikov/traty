<?php

class Category
{
    const TYPE_SPEND = 1;
    const TYPE_INCOME = 2;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $_id;
    protected $_name;
    protected $_type;
    protected $_system;

    /**
     * @param mixed $system
     */
    public function setSystem($system)
    {
        $this->_system = $system;
    }

    /**
     * @return mixed
     */
    public function getSystem()
    {
        return $this->_system;
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

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    public function load($id)
    {
        $db = new CategoryDb();
        $db->load($this, $id);
    }

    public function loadByNameAndType()
    {
        $db = new CategoryDb();
        $db->loadByNameAndType($this);
    }

    public function assignToUser($user)
    {
        $db = new CategoryDb();
        $db->assignToUser($this, $user);
    }

    public function save()
    {
        $db = new CategoryDb();
        $db->save($this);
    }

    public function changeStatus($status)
    {
        $db = new CategoryDb();
        $db->changeStatus($this, $status);
    }
}
