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

    public function load($user, $id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $query = $this->getConnection()->prepare($query);
        $query->execute(array($id));
        $row = $query->fetch();

        $this->map($user, $row);

        return $user;
    }
}
