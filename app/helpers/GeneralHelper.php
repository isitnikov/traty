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

    static public function getMonthByWeek($weekNum)
    {
        return date('n', strtotime('1 Jan + ' . $weekNum . 'weeks'));
    }

    static public function getMonthName($n)
    {
        $month = array(
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь',
        );

        return $month[$n - 1];
    }
}
