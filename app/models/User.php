<?php

class User
{
    protected $_id;
    protected $_username;
    protected $_password;
    protected $_hash;
    protected $_created;

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->_created = $created;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->_created;
    }

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
        $this->_username = strtolower(trim($this->_username));
        return $this->_username;
    }

    public function auth($rememberMe = false)
    {
        if ($this->isUserExist()) {
            return $this->_auth($rememberMe);
        }

        return 'Не правильное имя пользователя или пароль';
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        setcookie('auth', '', time()-3600);
    }

    public function isUserExist()
    {
        $db = new UserDb();
        $db->isUserExist($this);

        if ($this->getId()) {
            return true;
        } else {
            return false;
        }
    }

    public function loadUserByUsername()
    {
        $db = new UserDb();
        $db->loadUserByUsername($this);

        if ($this->getId()) {
            return true;
        }
        return false;
    }

    protected function _auth($rememberMe)
    {
        $hash = GeneralHelper::hash($this->getUsername() . $this->getPassword() . 'salt');
        $_SESSION['auth']['user_id'] = $this->getId();
        $_SESSION['auth']['username'] = $this->getUsername();
        $_SESSION['auth']['hash'] = $hash;

        if ($rememberMe) {
            setcookie('auth', $hash, time() + (3600 * 24 * 14));
        }

        $this->setHash($hash);
        $this->save();

        return true;
    }

    public function isLogedIn()
    {
        if (isset($_SESSION['auth']['hash'])) {
            $hash = $_SESSION['auth']['hash'];
        }

        if (isset($_COOKIE['auth'])) {
            $hash = $_COOKIE['auth'];
        }
        $this->load($hash, 'hash');

        if ($this->getId()) {
            return true;
        }

        return false;
    }

    public function load($id, $field = 'id')
    {
        $db = new UserDb();
        $db->load($this, $id, $field);
    }

    public function save()
    {
        $db = new UserDb();
        $db->save($this);
    }

    public function family()
    {
        $db = new Family_Db();
        return $db->loadFamilyByUser($this);
    }
}
