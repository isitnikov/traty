<?php

abstract class AbstractController
{
    public function init()
    {
        return $this;
    }

    public function notFoundAction()
    {
        header('Location: ' . BASE_URL);
    }
}
