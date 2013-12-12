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
}
