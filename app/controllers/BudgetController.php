<?php

class BudgetController extends AbstractController
{
    public function viewAction()
    {
        $dateRequest = App::getRequest('date', GeneralHelper::getDateValue(time(), 'date'));
        $categoryCollection = new CategoryCollection();
        $categories = $categoryCollection->loadAllCategories();
        $operationCollection = new OperationCollection();
        $categoryAmounts     = $operationCollection->getOperationsGroupedBy(GeneralHelper::getDateValue($dateRequest, 'date'), 'month', Category::TYPE_ALL);
        $categoryAmountsGrouped = array();
        foreach ($categoryAmounts as $amount) {
            $categoryAmountsGrouped[$amount['category']] = $amount;
        }
        $categoryAmounts = $categoryAmountsGrouped;

        $yearMonth = array();
        for ($i = -2; $i<=6; $i++) {
            $nextMonth = strtotime("+${i} month");
            $yearMonth[] = GeneralHelper::getDateValue($nextMonth, 'date');
        }

        $budgetCollection = new Budget_Collection();
        $budgetArray = $budgetCollection->loadByDateAndGroupedByCat(GeneralHelper::getDateValue($dateRequest, 'month'), GeneralHelper::getDateValue($dateRequest, 'year'));

        $view = $this->getView();
        $view->categories   = $categories;
        $view->budgetArray  = $budgetArray;
        $view->months       = $yearMonth;
        $view->date         = $dateRequest;
        $view->categoryAmounts = $categoryAmounts;
        $view->currentMonthLabel = App::getRequest('date', GeneralHelper::getDateValue(time(), 'date'));
        $view->currentMonthLabel = GeneralHelper::getDateLabel($view->currentMonthLabel, 'month');

        return $view->render('budget/view.php');
    }

    public function saveAction()
    {
        $category = App::getRequest('category', array());
        $user  = App::getUser();
        $date = App::getRequest('date', GeneralHelper::getDateValue(time(), 'date'));
        $date = GeneralHelper::getDateValue($date, 'date');

        $budget = new Budget();
        $budget->loadByFields(array(
                'user' => $user->familyMemberIds(),
                'category' => $category,
                'date'     => $date
        ));
        $budget->setUser($user->getId());
        $budget->setCategory($category);
        $budget->setDate($date);
        $budget->setAmount(App::getRequest('amount'));
        $budget->save();

        App::addSuccessAlert();
        GeneralHelper::redirect();
    }
}