<?php

abstract class AbstractController
{
    public function init()
    {
        if (!$this->_isLogedIn() && App::getRequest('controller') != 'user' && !in_array(App::getRequest('action'), array('login', 'registration'))) {
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
