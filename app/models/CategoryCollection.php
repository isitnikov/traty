<?php

class CategoryCollection extends CategoryDb
{
    protected function _prepareSelect($select)
    {
        return $select;
    }

    public function loadAllCategories($type = false)
    {
        $select = $this->getConnection()->select();
        $select->from($this->_getTable(new Category()));
        if ($type) {
            $select->where('type = ?', $type);
        }

        $this->_prepareSelect($select);
        $rows = $this->getConnection()->query($select)->fetchAll();

        $result = array();
        foreach ($rows as $row) {
            $category = new Category();
            $this->map($category, $row);
            $result[$category->getId()] = $category;
        }

        return $result;
    }
}
