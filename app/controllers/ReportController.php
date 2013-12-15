<?php

class ReportController extends AbstractController
{
    public function viewAction()
    {
        $reportType = isset($_GET['report_type'])? $_GET['report_type'] : 'date';
        $db = new OperationCollection();
        require APP_TEMPLATES_PATH . 'report.php';
    }

    public function detailAction()
    {
        $reportType = isset($_GET['report_type'])? $_GET['report_type'] : 'date';
        $date = isset($_GET['date'])? $_GET['date'] : '';
        $db = new OperationCollection();
        require APP_TEMPLATES_PATH . 'report_detail.php';
    }
}
