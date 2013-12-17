<?php

class Family_Db extends ResourceAbstract
{
    public function loadMembers($family, $onlyConfirmed)
    {
        $select = $this->getConnection()->select();
        $select->from('family_users');
        $select->where('family_id = ?', $family->getId());
        if ($onlyConfirmed) {
            $select->where('confirmed = ?', $onlyConfirmed);
        }

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

    public function assignUser($family, $user, $confirmed)
    {
        $members = $family->members(0);
        $memberIds = array();
        foreach ($members as $member) {
            $memberIds[] = $member->getId();
        }
        if (in_array($user->getId(), $memberIds)) {
            $where = $this->getConnection()->quoteInto('user_id = ?', $user->getId());
            $result = $this->getConnection()->update('family_users', array(
                'confirmed' => $confirmed
            ), $where);
        } else {
            $result = $this->getConnection()->insert('family_users', array(
                'family_id' => $family->getId(),
                'user_id'   => $user->getId(),
                'confirmed' => $confirmed
            ));
        }

        return $result;
    }

    public function unAssignUser($family, $user)
    {
        $where1 = $this->getConnection()->quoteInto('family_id = ?', $family->getId());
        $where2 = $this->getConnection()->quoteInto('user_id = ?', $user->getId());
        return $this->getConnection()->delete('family_users', array($where1, $where2));
    }

    public function checkUnconfirmedInvites($user)
    {
        $select = $this->getConnection()->select();
        $select->from('family_users');
        $select->where('user_id = ?', $user->getId());
        $select->where('confirmed = ?', 0);

        $rows = $this->getConnection()->query($select)->fetch();

        return $rows;
    }
}
