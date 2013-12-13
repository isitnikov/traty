<?php

class GeneralHelper
{
    static public function getCurrencySign()
    {
        return 'грн.';
    }

    static public function getTodayAmount()
    {
        $operationCollection = new OperationCollection();

        $todayAmount = $operationCollection->getTodayAmount();

        return $todayAmount;
    }
}
