<?php

class UserController extends AbstractController
{
    public function loginAction()
    {
        require APP_TEMPLATES_PATH . 'user/login.php';
    }
}
