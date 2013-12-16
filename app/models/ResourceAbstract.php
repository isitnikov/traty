<?php

abstract class ResourceAbstract
{
    protected $_connection;

    /**
     * @return PDO
     */
    public function getConnection()
    {
        if (!$this->_connection) {
            $this->_connection = App::getConnection();
        }

        return $this->_connection;
    }

    public function map($object, $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $object->$setter($value);
        }

        return $object;
    }
}
