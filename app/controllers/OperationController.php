<?php

class OperationController extends AbstractController
{
    public function viewAction()
    {
        $operationCollection = new OperationCollection();

        $todayOperations = $operationCollection->getTodayOperations();

        require APP_TEMPLATES_PATH  . 'index.php';

        return $this;
    }

    public function saveAction()
    {
        if (!empty($_POST)) {
            $operation = new Operation();
            $operation->setName($_POST['name']);
            $operation->setAmount($_POST['amount']);

            $date = $_POST['date'];
            $dateArray = explode('/', $date);
            $day = trim($dateArray[0]);
            $month = trim($dateArray[1]);
            $year = trim($dateArray[2]);
            $date = sprintf("%s-%s-%s 00:00:00", $year, $month, $day);
            $operation->setDate($date);

            $operation->save();
        }

        header('Location: ' . BASE_URL);
    }

    public function deleteAction()
    {
        $id = isset($_GET['operation_id'])? $_GET['operation_id'] : 0;
        $operation = new Operation();
        $operation->load($id);
        $operation->delete();
        header('Location: ' . BASE_URL);
    }

}
