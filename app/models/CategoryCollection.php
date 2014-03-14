<?php

class CategoryCollection extends CategoryDb
{
    /**
     * @param Zend_Db_Select $select
     * @return mixed
     */
    protected function _prepareSelect($select)
    {
        $joinCond = 'category_user.category_id = main_table.id';
        $select->joinLeft('category_user', $joinCond, array());

        $select->where('category_user.user_id IN (?)', App::getUser()->familyMemberIds());


        return $select;
    }

    public function loadAllCategories($type = false)
    {
        $select = $this->getConnection()->select()->reset();
        $select->from(array('main_table' => $this->_getTable(new Category())));
        if ($type) {
            $select->where('type = ?', $type);
        }

        $this->_prepareSelect($select);
        $select->orWhere('system = ?', 1);
        if ($type) {
            $select->where('type = ?', $type);
        }
        $select->order('type DESC');
        $this->_sortByPopularity($select);

        $rows = $this->getConnection()->query($select)->fetchAll();

        $result = array();
        foreach ($rows as $row) {
            $category = new Category();
            $this->map($category, $row);
            $result[$category->getId()] = $category;
        }

        return $result;
    }

    protected function _sortByPopularity($select)
    {
        $select->joinLeft(array('operations' => $this->_getTable(new Operation())), 'main_table.id = operations.category', array());
        $select->order(new Zend_Db_Expr('COUNT(operations.category)') . 'DESC');
        $select->group('main_table.id');
    }
}
