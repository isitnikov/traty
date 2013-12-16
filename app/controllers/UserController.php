<?php

class UserController extends AbstractController
{
    public function loginAction()
    {
        require APP_TEMPLATES_PATH . 'user/login.php';
    }

    public function logoutAction()
    {
        $user = App::getUser();
        $user->logout();
        GeneralHelper::redirect();
    }

    public function authAction()
    {
        $username   = App::getRequest('username');
        $password   = App::getRequest('password');
        $rememberMe = App::getRequest('rememberme');

        $user = App::getUser();
        $user->setUsername($username);
        $user->setPassword(GeneralHelper::hash(trim($password)));
        $result = $user->auth($rememberMe);

        if ($result === true) {
            GeneralHelper::redirect();
        } else {
            GeneralHelper::redirect(GeneralHelper::getUrl('user', 'login', array('message' => $result)));
        }
    }

    public function registrationAction()
    {
        $username = App::getRequest('username');
        $password = App::getRequest('password');

        $user = App::getUser();
        $user->setUsername($username);
        $user->setPassword(GeneralHelper::hash(trim($password)));

        if ($user->loadUserByUsername()) {
            $errorMessage = 'Такой пользователь уже существует';
            GeneralHelper::redirect(GeneralHelper::getUrl('user', 'login', array('registration-tab' => 1, 'message' => $errorMessage)));
            return;
        }

        $user->save();
        if ($user->getId()) {
            $user->auth(true);
            GeneralHelper::redirect();
        }

        GeneralHelper::redirect(GeneralHelper::getUrl('user', 'registration', array('message' => 'Не удалось зарегистрировать пользователя')));
    }
}
