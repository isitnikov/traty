<?php

class CategoryDb extends ResourceAbstract
{
    protected function _getTable($object)
    {
        return strtolower(get_class($object));
    }
}
