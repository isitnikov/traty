<?php

class Moneybox_Collection extends Moneybox_Db
{
    public function loadAll()
    {
        $select = $this->getConnection()->select();
        $select->from($this->_getTable(new Moneybox()));
        $select->where('user IN (?)', App::getUser()->familyMemberIds());
        $select->order('id DESC');
        $rows = $this->getConnection()->query($select)->fetchAll();

        $result = array();
        foreach ($rows as $row) {
            $object = $this->map(new Moneybox(), $row);
            $result[$object->getId()] = $object;
        }

        return $result;
    }
}
