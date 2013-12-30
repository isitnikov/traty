<?php

class UserDb extends ResourceAbstract
{
    public function isUserExist($user)
    {
        $query = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
        $query = $this->getConnection()->prepare($query);
        $query->execute(array($user->getUsername(), $user->getPassword()));
        $rows = $query->fetch();

        $this->map($user, $rows);

        return $user;
    }

    public function loadUserByUsername($user)
    {
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $query = $this->getConnection()->prepare($query);
        $query->execute(array($user->getUsername()));
        $rows = $query->fetch();

        $this->map($user, $rows);

        return $user;
    }

    protected function _getTable($object)
    {
        return parent::_getTable($object) . 's';
    }
}
