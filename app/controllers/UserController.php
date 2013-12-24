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

        if (!$username) {
            GeneralHelper::redirect(GeneralHelper::getUrl('user', 'login', array('message' => 'Заполните имя пользователя')));
            return $this;
        }
        if (!$password) {
            GeneralHelper::redirect(GeneralHelper::getUrl('user', 'login', array('message' => 'Введите пароль')));
            return $this;
        }

        $user = new User();
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

    public function generatedemozzzAction()
    {
        $user = App::getUser();
        if ($user->getUsername() != strtolower('demo')) {
            return self::notFoundAction();

        }

        for ($i=1; $i<=12; $i++) {
            $this->_generateDemoDataMonth($i);
        }
        $month = App::getRequest('month', 12);


        App::addSuccessAlert();
        GeneralHelper::redirect();
    }

    protected function _generateDemoDataMonth($month)
    {

        $income = App::getRequest('income', 10000);
        $outcome = App::getRequest('outcome', 7600);
        $year  = 2013;
        $maxDay = date('t', strtotime("01-${month}-${year}"));

        $categories = array(
            "Транспорт",
            "Продукты",
            "Одежда, косметика",
            "Отдых",
            "Медицина",
            "Авто",
            "Жилье",
            "Еда вне дома",
            "Обучение",
            "Работа",
            "Спорт",
            "Разное",
            "Домашние животные",
            "Долги, кредиты",
            "Накопления",
        );

        for ($i = 1; $i<=$maxDay; $i++) {
            for ($j=0; $j<rand(0, 8); $j++) {
                if ($i > date('j') && $month == date('n')) {
                    break;
                }
                if ($income <= 0) {
                    //continue;
                }
                $amount = rand(0,300);
                $income = $income - $amount;
                if ($amount <= 0 ) {
                    //continue;
                }
                $operation = new Operation();
                $operation->setCategory($categories[rand(0, count($categories) -1 )]);
                $operation->setAmount($amount);
                $operation->setUser(App::getUser()->getId());


                $date = sprintf("%s-%s-%s 00:00:00", $year, $month, $i);
                $operation->setDate($date);

                $operation->save();
            }
        }
    }
}
