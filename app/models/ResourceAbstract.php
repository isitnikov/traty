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

    public function save($object)
    {
        $data = $this->_getObjectData($object);
        $table = $this->_getTable($object);

        $fields = '';
        $values = '';
        foreach ($data as $key => $value) {
            if (!$values) {
                $fields .= $key;
                $values .= ":${key}";
                continue;
            }
            $values .= ", :${key}";
            $fields .= ", " . $key;
        }
        try {
            $statement = $this->getConnection()->prepare("INSERT INTO ${table} (${fields}) VALUES(${values})");
            $statement->execute($data);

            $object->load($this->getConnection()->lastInsertId());
            if (!$object->getId()) {
                throw new Exception('Cant save object to DB');
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    protected function _getObjectData($object)
    {
        $data = array();
        $methods = get_class_methods(get_class($object));
        foreach ($methods as $method) {
            if (substr($method, 0, 3) == 'get') {
                $data[strtolower(substr($method, 3))] = $object->$method();
            }
        }
        return $data;
    }

    public function load($object, $id)
    {
        $query = "SELECT * FROM " . $this->_getTable($object) . " WHERE id = ?";
        $query = $this->getConnection()->prepare($query);
        $query->execute(array($id));

        $row = $query->fetch();

        $this->map($object, $row);

        return $object;
    }

    public function delete($operation)
    {
        $id = $operation->getId();
        $query = "DELETE FROM operation WHERE id = ${id}";
        return $this->getConnection()->query($query);
    }

    /**
     * @param $object
     * @return string
     */
    protected function _getTable($object)
    {
        $table = strtolower(get_class($object)) . 's';
        return $table;
    }
}
