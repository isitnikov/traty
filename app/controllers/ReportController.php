<?php

class ReportController extends AbstractController
{
    public function viewAction()
    {

        $view = $this->getView();
        $collection = new OperationCollection();
        $reportType = isset($_GET['report_type'])? $_GET['report_type'] : 'date';
        $operations = $collection->getAmountsGroupedBy($reportType);


        $view->operations = $operations;
        $view->reportType = $reportType;

        return $this->_view->render('report.php');
    }

    public function detailAction()
    {
        $view = $this->getView();
        $reportType = isset($_GET['report_type'])? $_GET['report_type'] : 'date';
        $date = isset($_GET['date'])? $_GET['date'] : '';
        $db = new OperationCollection();

        $view->reportType = $reportType;
        $view->date       = $date;
        $view->db         = $db;

        return $view->render('report_detail.php');
    }
}
