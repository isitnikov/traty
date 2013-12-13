<?php

class ReportController extends AbstractController
{
    public function viewAction()
    {
        $db = new OperationCollection();
        require APP_TEMPLATES_PATH . 'report.php';
    }
}
