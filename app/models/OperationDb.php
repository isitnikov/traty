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
            $operation->getAmount(),
            $operation->getDate()
        );
        try {
            $statement = $this->getConnection()->prepare("INSERT INTO operation VALUES(NULL, ?,?,?)");
            $statement->execute($data);
        } catch (Exception $e) {
            print $e->getMessage();
        }

    }

    public function load($operation, $id)
    {
        $query = "SELECT * FROM operation WHERE id = ${id}";
        $row = $this->getConnection()->query($query)->fetch();

        $this->map($operation, $row);

        return $operation;
    }

    public function delete($operation)
    {
        $id = $operation->getId();
        $query = "DELETE FROM operation WHERE id = ${id}";
        return $this->getConnection()->query($query);
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
