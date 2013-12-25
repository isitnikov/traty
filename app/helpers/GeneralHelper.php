<?php

class GeneralHelper
{
    static public function getCurrencySign()
    {
        return 'грн.';
    }

    static public function renderAmount($amount, $type)
    {
        $amount = abs($amount);
        $amount = sprintf('%.2f', $amount);
        $class = 'text-success';
        $sign  = "&plus;";

        if ($type == Category::TYPE_SPEND) {
            $class = 'text-danger';
            $sign  = '&minus;';
        }

        $fraction = "00";
        if (strstr($amount, '.')) {
            list($amount, $fraction) = explode('.', $amount);
        }
        $decimalPart = sprintf(".<span class='small text-muted'>%s</span>", $fraction);
        if ($fraction == '00' || $fraction == 0) {
            $fraction = '';
            $decimalPart = '';
        }

        $html = sprintf("<span class='%s'>%s %s%s <span class='text-muted small'> %s </span></span>",
            $class, $sign, $amount, $decimalPart, self::getCurrencySign());

        return $html;
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
        $year = $date->format('y');

        if ($type == 'date') {
            return sprintf("%s %s %s", $day, self::getMonthName($month), $year);
        } elseif ($type == 'week') {
            return sprintf("%s нед.", $date->format('W'));
        } else {
            return sprintf("%s %s", self::getMonthName($month), $year);
        }
    }

    static public function getMonthName($n)
    {
        $month = array(
            'Янв',
            'Фев',
            'Март',
            'Апр',
            'Май',
            'Июн',
            'Июл',
            'Авг',
            'Сен',
            'Окт',
            'Нояб',
            'Дек',
        );

        return $month[$n - 1];
    }

    static public function getUrl($controller, $action, $params = array())
    {
        $url = App::getBaseUrl() . '?controller=' . $controller . '&action=' . $action;
        foreach ($params as $key => $value) {
            $url .= '&' . $key . '=' . urlencode($value);
        }

        return $url;
    }

    static public function redirect($path = false)
    {
        if (!$path) {
            $path = App::getBaseUrl() . '?controller=' . App::getRequest('controller');
        }
        header('Location: ' . $path);
        exit;
    }

    static public function hash($str)
    {
        return sha1($str . "BC3aN33WQ4");
    }

    static public function escape($str)
    {
        return htmlspecialchars($str);
    }

    static public function getIdsFromArrayOfObjects($arrOfObjects)
    {
        $ids = array();
        foreach ($arrOfObjects as $object) {
            $ids[] = $object->getId();
        }

        return $ids;
    }

    static public function getOptions($array, $label)
    {
        $result = array();
        foreach ($array as $row) {
            $field = 'get' . ucfirst($label);
            $result[$row->getId()] = $row->$field();
        }

        return $result;
    }
}
