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

    public function members($onlyConfirmed = 1)
    {
        $connection = new Family_Db();
        return $connection->loadMembers($this, $onlyConfirmed);
    }

    public function load($id)
    {
        $db = new Family_Db();
        $db->load($this, $id);
    }

    public function save()
    {
        $db = new Family_Db();
        $db->save($this);
    }

    public function assign($user, $confirmed = 0)
    {
        $db = new Family_Db();
        $db->assignUser($this, $user, $confirmed);
    }

    public function unAssign($user)
    {
        $db = new Family_Db();
        $db->unAssignUser($this, $user);
    }

    public function checkUnconfirmedInvites($user)
    {
        $db = new Family_Db();
        return $db->checkUnconfirmedInvites($user);
    }
}
