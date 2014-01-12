<?php

abstract class AbstractController
{
    /**
     * @var Zend_View
     */
    protected $_view;

    /**
     * @return Zend_View
     */
    public function getView()
    {
        if (!$this->_view) {
            $view = new Zend_View();
            $view->setScriptPath(APP_TEMPLATES_PATH);
            $this->_view = $view;
        }
        return $this->_view;
    }

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
