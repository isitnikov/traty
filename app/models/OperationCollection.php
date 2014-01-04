<?php

class OperationCollection extends OperationDb
{

    protected function _prepareSelect($select)
    {
        $this->_addUser($select);
        $this->_joinCategory($select);

        return $select;
    }

    protected function _addUser($select)
    {
        $select->where('user IN (?)', App::getUser()->familyMemberIds());

        return $select;
    }

    protected function _joinCategory($select)
    {
        return $select->join('category', 'operation.category = category.id', array('name', 'type'));
    }

    public function getTodayAmount($type = Category::TYPE_SPEND)
    {
        $select = $this->getConnection()->select();
        $select->from('operation', array('amount' => new Zend_Db_Expr('SUM(amount)')));
        $select->where('DATE(date) = CURDATE()');
        $select->where('type = ?', $type);
        $this->_prepareSelect($select);

        $todayAmount = $this->getConnection()->query($select)->fetchColumn();
        if (!$todayAmount) {
            $todayAmount = 0;
        }

        return $todayAmount;

    }

    public function getTodayOperations($type = Category::TYPE_SPEND)
    {
        $select = $this->getConnection()->select();
        $select->from('operation');
        $select->where(new Zend_Db_Expr('DATE(date) = CURDATE()'));
        $select->order('id DESC');
        $select->where('type = ?', $type);

        $this->_prepareSelect($select);

        $operations = array();
        $rows = $this->getConnection()->query($select)->fetchAll();
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
        $select = $this->getConnection()->select();
        $select->from('operation', array(
            'amount' => 'SUM(amount)',
            'date',
            'week' => 'WEEK(date, 3)',
            'month' => 'MONTH(date)',
            'year'  => 'YEAR(date)'
        ));
        $select->group(array($type, 'type'));
        $select->order('date DESC');
        $select->order('type DESC');
        $this->_prepareSelect($select);

        $rows = $this->getConnection()->query($select)->fetchAll();

        $result = array();
        foreach ($rows as $row) {
            $result[$row[$type]][$row['type']] = $row;
        }

        foreach ($result as &$operationByTypes) {
            krsort($operationByTypes);
        }

        return $result;
    }

    public function getOperationsGroupedBy($date, $dateType = 'date', $type = Category::TYPE_SPEND)
    {
        $where = '';
        $having = '';
        if ($dateType == 'week' || $dateType == 'month') {
            $having = "${dateType} = ?";
        } elseif ($dateType == 'date') {
            $where = "${dateType} = ?";
        }

        $select = $this->getConnection()->select();
        $select->from('operation', array(
            'amount' => 'SUM(amount)',
            'date',
            'week' => 'WEEK(date, 3)',
            'month' => 'MONTH(date)',
            'category',
        ));
        if ($where) {
            $select->where($where, $date);
        }
        if ($having) {
            $select->having($having, GeneralHelper::getDateValue($date, $dateType));
        }
        $select->group(array($dateType, 'category'));
        $select->order('amount DESC');
        $select->where('type = ?', $type);
        $this->_prepareSelect($select);

        $rows = $this->getConnection()->query($select)->fetchAll();

        return $rows;
    }
}
