<?php

class Family_Db extends ResourceAbstract
{
    public function loadMembers($family)
    {
        $select = $this->getConnection()->select();
        $select->from('family_users');
        $select->where('family_id = ?', $family->getId());

        $rows = $this->getConnection()->query($select)->fetchAll();

        $result = array();
        foreach ($rows as $row) {
            $userId = $row['user_id'];
            $user = new User();
            $user->load($userId);
            $result[$userId] = $user;
        }

        return $result;
    }

    public function loadFamilyByUser($user)
    {
        $select = $this->getConnection()->select();
        $select->from('family_users', 'family_id');
        $select->where('user_id = ?', $user->getId());

        $select->limit(1);
        $row = $this->getConnection()->query($select)->fetchColumn();

        $family = new Family();
        $family->load($row);

        return $family;
    }

    protected function _getTable($object)
    {
        return $table = strtolower(get_class($object));
    }


}
