<?php

class Family
{
    protected $_id;
    protected $_hash;

    /**
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->_hash = $hash;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->_hash;
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

    public function members()
    {
        $connection = new Family_Db();
        return $connection->loadMembers($this);
    }

    public function load($id)
    {
        $db = new Family_Db();
        $db->load($this, $id);
    }
}
