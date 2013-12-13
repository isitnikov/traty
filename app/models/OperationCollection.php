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

    public function getWeekOperationsGrouped($weekNum)
    {
        $weekNum = (int) $weekNum;
        $query = "SELECT name, SUM(amount) AS amount FROM operation WHERE WEEK(date) = ${weekNum} AND MONTH(CURDATE()) = MONTH(date) GROUP BY name ORDER BY amount DESC";
        $rows = $this->getConnection()->query($query)->fetchAll();

        return $rows;
    }
}
