<?php

class OperationCollection extends OperationDb
{

    protected function _addCurrentUser()
    {
        return $this->addWhere('user', App::getUser()->getId());
    }

    public function getTodayAmount()
    {
        $query = "SELECT SUM(amount) as today_amount FROM operation WHERE DATE(date) = CURDATE() AND " . $this->_addCurrentUser();

        $todayAmount = $this->getConnection()->query($query)->fetchColumn();
        if (!$todayAmount) {
            $todayAmount = 0;
        }

        return $todayAmount;

    }

    public function getTodayOperations()
    {
        $operations = array();
        $query = "SELECT * FROM operation WHERE DATE(date) = CURDATE() AND " . $this->_addCurrentUser() . " ORDER BY id DESC";
        $rows = $this->getConnection()->query($query)->fetchAll();
        foreach ($rows as $row) {
            $id = $row['id'];
            $operation = new Operation();
            $this->map($operation, $row);
            $operations[$id] = $operation;
        }

        return $operations;
    }

    public function getAmountsGroupedBy($type = 'date')
    {
        $query = "SELECT name, SUM(amount) as amount, date, WEEK(date, 3) as week, MONTH(date) as month FROM operation WHERE " . $this->_addCurrentUser() . "GROUP BY " . $type . " ORDER BY date DESC;";
        $rows = $this->getConnection()->query($query)->fetchAll();

        return $rows;
    }

    public function getOperationsGroupedBy($type = 'date', $date)
    {
        $where = '';
        $having = '';
        if ($type == 'week' || $type == 'month') {
            $having = 'HAVING ' . $type . ' = ' . GeneralHelper::getDateValue($date, $type);
        } elseif ($type == 'date') {
            $where = $type . ' = "' . $date . '" AND ';
        }
        $query = "SELECT name, SUM(amount) as amount, date, WEEK(date, 3) as week, MONTH(date) as month FROM operation WHERE " . $where . $this->_addCurrentUser() . " GROUP BY " . $type . ",name " . $having . " ORDER BY amount DESC;";
        $rows = $this->getConnection()->query($query)->fetchAll();

        return $rows;
    }
}
