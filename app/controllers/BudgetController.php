<?php

class BudgetController extends AbstractController
{
    public function viewAction()
    {
        require APP_TEMPLATES_PATH . 'budget' . DIRECTORY_SEPARATOR . 'view.php';
    }
}