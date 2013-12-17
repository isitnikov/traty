<?php

class OperationCollection extends OperationDb
{

    protected function _prepareSelect($select)
    {
        $user = App::getUser();
        $family = $user->family();
        if ($family->getId()) {
            $members = $family->members();
            $users = array();
            foreach ($members as $member) {
                $users[] = $member->getId();
            }
            $select->where('user IN (?)', $users);
            return $select;
        }

        $select->where('user = ?', $user->getId());
        return $select;
    }

    public function getTodayAmount()
    {
        $select = $this->getConnection()->select();
        $select->from('operation', array('amount' => new Zend_Db_Expr('SUM(amount)')));
        $select->where('DATE(date) = CURDATE()');
        $this->_prepareSelect($select);

        $todayAmount = $this->getConnection()->query($select)->fetchColumn();
        if (!$todayAmount) {
            $todayAmount = 0;
        }

        return $todayAmount;

    }

    public function getTodayOperations()
    {
        $select = $this->getConnection()->select();
        $select->from('operation');
        $select->where(new Zend_Db_Expr('DATE(date) = CURDATE()'));
        $select->order('id DESC');

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
            'name',
            'date',
            'week' => 'WEEK(date, 3)',
            'month' => 'MONTH(date)'
        ));
        $select->group($type);
        $select->order('date DESC');
        $this->_prepareSelect($select);

        $rows = $this->getConnection()->query($select)->fetchAll();

        return $rows;
    }

    public function getOperationsGroupedBy($type = 'date', $date)
    {
        $where = '';
        $having = '';
        if ($type == 'week' || $type == 'month') {
            $having = "${type} = ?";
        } elseif ($type == 'date') {
            $where = "${type} = ?";
        }

        $select = $this->getConnection()->select();
        $select->from('operation', array(
            'name',
            'amount' => 'SUM(amount)',
            'date',
            'week' => 'WEEK(date, 3)',
            'month' => 'MONTH(date)'
        ));
        if ($where) {
            $select->where($where, $date);
        }
        if ($having) {
            $select->having($having, GeneralHelper::getDateValue($date, $type));
        }
        $select->group(array($type, 'name'));
        $select->order('amount DESC');
        $this->_prepareSelect($select);

        $rows = $this->getConnection()->query($select)->fetchAll();

        return $rows;
    }
}
