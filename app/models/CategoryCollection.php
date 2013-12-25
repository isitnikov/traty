<?php

class CategoryCollection extends CategoryDb
{
    /**
     * @param Zend_Db_Select $select
     * @return mixed
     */
    protected function _prepareSelect($select)
    {
        $joinCond = 'category_user.category_id = ' . $this->_getTable(new Category()) . '.id';
        $select->joinLeft('category_user', $joinCond, array());

        $select->where('category_user.user_id = ?', App::getUser()->getId());

        return $select;
    }

    public function loadAllCategories($type = false)
    {
        $select = $this->getConnection()->select()->reset();
        $select->from($this->_getTable(new Category()));
        if ($type) {
            $select->where('type = ?', $type);
        }

        $this->_prepareSelect($select);
        $select->orWhere('system = ?', 1);

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
