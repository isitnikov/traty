<?php

class MoneyboxController extends AbstractController
{
    public function viewAction()
    {
        $view = $this->getView();
        $moneyboxCollection = new Moneybox_Collection();
        $view->moneyboxCollection = $moneyboxCollection->loadAll();

        return $view->render('moneybox/view.php');
    }

    public function editAction()
    {
        $view = $this->getView();
        return $view->render('moneybox/edit.php');
    }

    public function saveAction()
    {
        $name = App::getRequest('name');
        $cost = App::getRequest('cost');
        $accumulated = App::getRequest('accumulated');
        $date = App::getRequest('date');
        $date = (int) DateTime::createFromFormat('d/m/Y', $date)->format('U');
        $date = GeneralHelper::getDateValue($date, 'date');

        $moneybox = new Moneybox();
        $moneybox->setName($name);
        $moneybox->setCost($cost);
        $moneybox->setAccumulated($accumulated);
        $moneybox->setDate($date);
        $moneybox->setUser(App::getUser()->getId());

        $moneybox->save();

        App::addSuccessAlert();
        GeneralHelper::redirect();
    }
}
