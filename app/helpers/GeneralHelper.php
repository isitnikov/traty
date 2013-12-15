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

    static public function getDateTime($date)
    {
        $date = substr($date, 0, 10);
        $date = DateTime::createFromFormat('Y-m-d', $date);

        return $date;
    }

    static public function getDateValue($date, $type)
    {
        $date = self::getDateTime($date);

        $value = false;

        if ($type == 'date') {
            $value = $date->format('Y-m-d') . ' 00:00:00';
        } elseif ($type == 'week') {
            $value = $date->format('W');
        } elseif ($type == 'month') {
            $value = $date->format('m');
        }

        return $value;
    }

    static public function getDateLabel($date, $type)
    {
        $date = substr($date, 0, 10);
        $date = DateTime::createFromFormat('Y-m-d', $date);
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('Y');

        if ($type == 'date') {
            return sprintf("%s %s %s", $day, self::getMonthName($month), $year);
        } elseif ($type == 'week') {
            return sprintf("%s неделя", $date->format('W'));
        } else {
            return sprintf("%s %s", self::getMonthName($month), $year);
        }
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
