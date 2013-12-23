<?php

class CategoryCollection extends CategoryDb
{
    public function loadAllCategories($type = false)
    {
        $select = $this->getConnection()->select();
        $select->from($this->_getTable(new Category()));
        if ($type) {
            $select->where('type = ?', $type);
        }
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
