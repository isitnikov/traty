<?php

class OperationCollection extends OperationDb
{
   public function getTodayAmount()
   {
       return $this->getConnection()->query("SELECT SUM(amount) as today_amount from operation")->fetchColumn();

   }
}
