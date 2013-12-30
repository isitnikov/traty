<?php

abstract class ResourceAbstract
{
    protected $_connection;

    /**
     * @return Zend_Db_Adapter_Abstract
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
        if (!$data) {
            return false;
        }
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
        $update = '';
        foreach ($data as $key => $value) {
            if (!$values) {
                $fields .= $key;
                $values .= ":${key}";
                $update .= $key . '=:' . $key;
                continue;
            }
            $values .= ", :${key}";
            $fields .= ", " . $key;
            $update .= ", " . $key . '=:' . $key;
        }
        try {
            if (!$object->getId()) {
                $statement = $this->getConnection()->prepare("INSERT INTO ${table} (${fields}) VALUES(${values})");
                $statement->execute($data);
                $object->load($this->getConnection()->lastInsertId());
            } else {
                $statement = $this->getConnection()->prepare("UPDATE ${table} SET ${update} WHERE id = :id");
                $statement->execute($data);
            }

            if (!$object->getId()) {
                throw new Exception('Cant save object to DB');
            }
        } catch (Exception $e) {
            App::addErrorAlert();
            error_log($e->getMessage());
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

    public function load($object, $id, $field = 'id')
    {
        $query = "SELECT * FROM " . $this->_getTable($object) . " WHERE ${field} = ?";
        $query = $this->getConnection()->prepare($query);
        $query->execute(array($id));

        $row = $query->fetch();

        $this->map($object, $row);

        return $object;
    }

    public function loadByFields($object, $fields)
    {
        $select = $this->getConnection()->select();
        $select->from($this->_getTable($object));
        foreach ($fields as $key => $field) {
            $select->where($key . ' = ?', $field);
        }

        $row = $this->getConnection()->query($select)->fetch();
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
        $table = strtolower(get_class($object));
        return $table;
    }

    public function addWhere($key, $value)
    {
        $where = "${key} = " . $this->getConnection()->quote($value);
        return $where;
    }
}
