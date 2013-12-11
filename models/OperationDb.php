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
            $this->_connection = App::getConnection();
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
