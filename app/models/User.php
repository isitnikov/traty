<?php

class User
{
    protected $_id;
    protected $_username;
    protected $_password;

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
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    public function auth($rememberMe = false)
    {
        if ($this->_isUserExist()) {
            return $this->_auth($rememberMe);
        }

        return 'Не правильное имя пользователя или пароль';
    }

    public function logout()
    {
        unset($_SESSION['auth']);
    }

    protected function _isUserExist()
    {
        $db = new UserDb();
        $db->isUserExist($this);

        if ($this->getId()) {
            return true;
        } else {
            return false;
        }
    }

    protected function _auth($rememberMe)
    {
        $_SESSION['auth']['user_id'] = $this->getId();
        $_SESSION['auth']['username'] = $this->getUsername();
        return true;
    }

    public function isLogedIn()
    {
        if (isset($_SESSION['auth']['user_id'])) {
            $this->load($_SESSION['auth']['user_id']);
        }

        if ($this->getId()) {
            return true;
        }

        return false;
    }

    public function load($id)
    {
        $db = new UserDb();
        $db->load($this, $id);
    }
}
