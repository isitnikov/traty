<?php

class GeneralHelper
{
    static public function getCurrencySign()
    {
        return 'грн.';
    }

    static public function renderAmount($amount, $type = false, $withoutCent = false)
    {
        if (!$type) {
            $type = Category::TYPE_INCOME;
            if ($amount < 0) {
                $type = Category::TYPE_SPEND;
            }
        }
        $amount = abs($amount);
        $amount = sprintf('%.2f', $amount);

        $class = 'text-success';
        $sign  = "&plus;";

        if ($type == Category::TYPE_SPEND) {
            $class = 'text-danger';
            $sign  = '&minus;';
        }

        if ($amount == 0) {
            $sign = '';
        }

        $fraction = "00";
        if (strstr($amount, '.')) {
            list($amount, $fraction) = explode('.', $amount);
        }
        $decimalPart = sprintf("<span class='text-muted'>.%s</span>", $fraction);

        if ($withoutCent) {
            $decimalPart = '';
        }

        $html = sprintf("<span class='%s'>&nbsp;%s&nbsp;<span class='whole'>%s</span>%s&nbsp;<span class='text-muted small'>&nbsp;%s </span></span>",
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
        if (self::isValidTimeStamp($date)) {
            $date = DateTime::createFromFormat('U', $date);
            return $date;
        }
        $date = substr($date, 0, 10);
        $date = DateTime::createFromFormat('Y-m-d', $date);

        return $date;
    }

    static public function isValidTimeStamp($timestamp)
    {
        return is_int($timestamp);
    }

    static public function getDateValue($date, $type)
    {
        $date = self::getDateTime($date);

        if (!$date) {
            return false;
        }
        $value = false;

        if ($type == 'date') {
            $value = $date->format('Y-m-d') . ' 00:00:00';
        } elseif ($type == 'week') {
            $value = $date->format('W');
        } elseif ($type == 'month') {
            $value = $date->format('n');
        } elseif ($type == 'year') {
            $value = $date->format('Y');
        } elseif ($type == 'render') {
            $value = $date->format('d/m/Y');
        }

        return $value;
    }

    static public function getDateLabel($date, $type)
    {
        $date = self::getDateTime($date);
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

    static public function getCategoryClassLabelHtml($category)
    {
        switch ($category->getType()) {
            case Category::TYPE_INCOME:
                $labelClass = 'label-success';
                $label = 'Доход';
                break;
            case Category::TYPE_SPEND:
                $labelClass = 'label-primary';
                $label = 'Расход';
                break;
            case Category::TYPE_ACTIVE:
                $labelClass = 'label-danger';
                $label = 'Активы';
                break;
            case Category::TYPE_PASSIVE:
                $labelClass = 'label-warning';
                $label = 'Пассивы';
                break;
            default:
                $labelClass = '';
                $label = '';
                break;
        }

        $class = sprintf('<span class="label %s">%s</span>', $labelClass, $label);

        return $class;
    }

    static public function getMainMenu()
    {
        $links = array(
            array('url' => App::getBaseUrl(), 'label' => 'Главная', 'icon' => 'icon-home'),
            array('url' => GeneralHelper::getUrl('report', 'view'), 'label' => 'Отчеты', 'icon' => 'icon-pages'),
            array('url' => GeneralHelper::getUrl('budget', 'view'), 'label' => 'Бюджет', 'icon' => 'icon-star'),
            array('url' => GeneralHelper::getUrl('category', 'view'), 'label' => 'Настройки', 'icon' => 'icon-gear'),
            array('url' => GeneralHelper::getUrl('user', 'logout'), 'label' => 'Выйти', 'icon' => 'icon-person')
        );

        return $links;
    }

    static public function getClassForMenuItem($link)
    {
        $active = '';
        if ($link['url'] == GeneralHelper::getUrl(App::getRequest('controller'), App::getRequest('action'))
            || ($link['url'] == App::getBaseUrl() && App::getRequest('controller') == false)) {
            $active = 'active';
        }

        return $active;
    }
}
