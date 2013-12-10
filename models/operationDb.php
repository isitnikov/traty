<?php

class OperationDb
{
    protected $_connection;

    /**
     * @return PDO
     */
    public function getConnection()
    {
        if (!$this->_connection) {
            $this->_connection = new PDO('mysql:host=localhost;dbname=money', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }

        return $this->_connection;
    }

    public function save($operation)
    {
        $data = array(
            $operation->getName(),
            $operation->getAmount()
        );
        try {
            $statement = $this->getConnection()->prepare("INSERT INTO operation VALUES(NULL, ?,?)");
            $statement->execute($data);
        } catch (Exception $e) {
            print $e->getMessage();
        }

    }
}
