<?php

class OperationCollection extends OperationDb
{
    public function getTodayAmount()
    {
        $query = "SELECT SUM(amount) as today_amount FROM operation WHERE DATE(date) = CURDATE()";

        $todayAmount = $this->getConnection()->query($query)->fetchColumn();
        if (!$todayAmount) {
            $todayAmount = 0;
        }

        return $todayAmount;

    }

    public function getTodayOperations()
    {
        $operations = array();
        $query = "SELECT * FROM operation WHERE DATE(date) = CURDATE() ORDER BY id DESC";
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
        $query = "SELECT name, SUM(amount) as amount, date, WEEK(date, 3) as week, MONTH(date) as month FROM operation GROUP BY " . $type . " ORDER BY date DESC;";
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
            $where = 'WHERE ' . $type . ' = "' . $date . '"';
        }
        $query = "SELECT name, SUM(amount) as amount, date, WEEK(date, 3) as week, MONTH(date) as month FROM operation " . $where . " GROUP BY " . $type . ",name " . $having . " ORDER BY amount DESC;";
        $rows = $this->getConnection()->query($query)->fetchAll();

        return $rows;
    }

    public function getWeekOperationsGrouped($weekNum)
    {
        $weekNum = (int) $weekNum;
        $query = "SELECT name, SUM(amount) AS amount FROM operation WHERE WEEK(date, 3) = ${weekNum} GROUP BY name ORDER BY amount DESC";
        $rows = $this->getConnection()->query($query)->fetchAll();

        return $rows;
    }
}
