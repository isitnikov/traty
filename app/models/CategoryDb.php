<?php

class CategoryDb extends ResourceAbstract
{
    protected function _getTable($object)
    {
        return strtolower(get_class($object));
    }

    public function loadByNameAndType($category)
    {
        $select = $this->getConnection()->select();
        $select->from($this->_getTable($category));
        $select->where('name = ?', $category->getName());
        $select->where('type = ?', $category->getType());

        $row = $this->getConnection()->query($select)->fetch();

        $this->map($category, $row);

        return $category;
    }

    public function assignToUser($category, $user)
    {

        if ($this->isAssignedCategoryToUser($category, $user)) {
            throw new Exception('Категория уже добавлена');
        }
        $result = $this->getConnection()->insert('category_user', array(
            'category_id' => $category->getId(),
            'user_id'     => $user->getId()
        ));

        return $result;
    }

    public function isAssignedCategoryToUser($category, $user)
    {
        $select = App::getConnection()->select();
        $select->from('category_user');
        $select->where('user_id = ?', $user->getId());
        $select->where('category_id = ?', $category->getId());

        $row = $this->getConnection()->query($select)->fetch();

        return $row;
    }
}
