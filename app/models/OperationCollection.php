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
        $user = App::getUser();
        $family = $user->family();
        if ($family->getId()) {
            $members = $family->members();
            $users = array();
            foreach ($members as $member) {
                $users[] = $member->getId();
            }

            if (empty($users)) {
                $users = App::getUser()->getId();
            }

            $select->where('user IN (?)', $users);
            return $select;
        }

        $select->where('user = ?', $user->getId());

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
        $select->group(array($type, 'category'));
        $select->order('amount DESC');
        $this->_prepareSelect($select);

        $rows = $this->getConnection()->query($select)->fetchAll();

        return $rows;
    }
}
