<?php

class ReportController extends AbstractController
{
    public function viewAction()
    {
        require APP_TEMPLATES_PATH . 'report.php';
    }
}
