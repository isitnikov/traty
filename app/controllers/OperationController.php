<?php

class OperationController extends AbstractController
{
    public function viewAction()
    {
        $collection = new CategoryCollection();
        $spendCategories = GeneralHelper::getOptions($collection->loadAllCategories(Category::TYPE_SPEND), 'name');
        $incomeCategories = GeneralHelper::getOptions($collection->loadAllCategories(Category::TYPE_INCOME), 'name');

        $operationCollection = new OperationCollection();

        $todayOperations = $operationCollection->getTodayOperations();
        $todayAmount = true;

        require APP_TEMPLATES_PATH  . 'index.php';

        return $this;
    }

    public function saveAction()
    {
        if (!empty($_POST)) {
            $amount = App::getRequest('amount');
            $categoryId = App::getRequest('category');
            $date = App::getRequest('date');

            $pattern = '@[0-9]{1,2}[/][0-9]{1,2}[/][0-9]{4}@i';
            if (!$categoryId) {
                App::addErrorAlert('Выберите категорию расходов или доходов');
                GeneralHelper::redirect();
            } elseif (!preg_match($pattern, $date)) {
                App::addErrorAlert('Дата должна быть в формате дд/мм/гггг');
                GeneralHelper::redirect();
            } elseif ($amount <= 0) {
                App::addErrorAlert('Сумма должна быть больше 0');
                GeneralHelper::redirect();
            }

            $operation = new Operation();
            $operation->setCategory($categoryId);
            $operation->setAmount($amount);
            $operation->setUser(App::getUser()->getId());


            $dateArray = explode('/', $date);
            $day = trim($dateArray[0]);
            $month = trim($dateArray[1]);
            $year = trim($dateArray[2]);
            $date = sprintf("%s-%s-%s 00:00:00", $year, $month, $day);
            $operation->setDate($date);

            $operation->save();
        }

        App::addSuccessAlert('Операция добавлена');
        GeneralHelper::redirect(GeneralHelper::getUrl('operation', 'view'));
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
