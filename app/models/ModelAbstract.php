<?php

class ModelAbstract
{
    protected $_dbResource;

    /**
     * @return ResourceAbstract
     */
    protected function _getDbResource()
    {
        if (!$this->_dbResource) {
            $name = get_class($this). '_Db';
            $this->_dbResource = new $name();
        }

        return $this->_dbResource;
    }

    public function save()
    {
        $this->_getDbResource()->save($this);
    }

    public function load($id, $field = 'id')
    {
        $this->_getDbResource()->load($this, $id, $field);
    }

    public function loadByFields($fields)
    {
        $this->_getDbResource()->loadByFields($this, $fields);
    }

    public function delete()
    {
        $this->_getDbResource()->delete($this);
    }
}
