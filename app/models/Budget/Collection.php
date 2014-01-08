<?php

class Budget_Collection extends Budget_Db
{
    protected function _prepareSelect($select)
    {
        $select->where('user IN (?)', App::getUser()->familyMemberIds());
        return $select;
    }

    public function loadAllByFields($fields)
    {
        $select = $this->getConnection()->select();
        $select->from($this->_getTable(new Budget()));
        foreach ($fields as $key => $field) {
            $select->where($key . ' = ?', $field);
        }

        $this->_prepareSelect($select);
        $rows = $this->getConnection()->query($select)->fetchAll();
        $result = array();
        foreach ($rows as $row) {
            $budget = new Budget();
            $result[$row['id']] = $budget;
            $this->map($budget, $row);
        }

        return $result;
    }

    public function loadByDateAndGroupedByCat($month = false, $year = false)
    {
        if (!$month && !$year) {
            $month = new Zend_Db_Expr("MONTH(CURDATE())");
            $year  = new Zend_Db_Expr("YEAR(CURDATE())");
        }
        $rows = $this->loadAllByFields(array(
            'MONTH(date)'  => $month,
            'YEAR(date)'   => $year
        ));

        $budgetGroupedCategory = array();
        foreach ($rows as $budget) {
            $budgetGroupedCategory[$budget->getCategory()] = $budget;
        }
        $rows = $budgetGroupedCategory;

        return $rows;
    }
}
