<?php

class MoneyboxController extends AbstractController
{
    public function viewAction()
    {
        $view = $this->getView();

        return $view->render('moneybox/view.php');
    }

    public function editAction()
    {
        $view = $this->getView();

        return $view->render('moneybox/edit.php');
    }
}
