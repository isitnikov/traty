<?php

class Budget_Collection extends Budget_Db
{
    public function loadAllByFields($fields)
    {
        $select = $this->getConnection()->select();
        $select->from($this->_getTable(new Budget()));
        foreach ($fields as $key => $field) {
            $select->where($key . ' = ?', $field);
        }

        $rows = $this->getConnection()->query($select)->fetchAll();
        $result = array();
        foreach ($rows as $row) {
            $budget = new Budget();
            $result[$row['id']] = $budget;
            $this->map($budget, $row);
        }

        return $result;
    }
}
