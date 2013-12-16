<?php

abstract class AbstractController
{
    public function init()
    {
        if (App::getRequest('controller') != 'user' && App::getRequest('action') != 'login' && !$this->_isLogedIn()) {
            GeneralHelper::redirect(GeneralHelper::getUrl('user', 'login'));
        }
        return $this;
    }

    protected function _isLogedIn()
    {
        return App::getUser()->isLogedIn();
    }

    public function notFoundAction()
    {
        header('Location: ' . BASE_URL);
    }
}
