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
           $operation->setId($row['id']);
           $operation->setName($row['name']);
           $operation->setAmount($row['amount']);
           $operation->setDate($row['date']);
           $operations[$id] = $operation;
       }

       return $operations;
   }
}
