<?php

class OperationDb extends ResourceAbstract
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

    protected function _getTable($object)
    {
        $table = strtolower(get_class($object));
        return $table;
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
