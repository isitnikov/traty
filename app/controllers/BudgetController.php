<?php

class BudgetController extends AbstractController
{
    public function viewAction()
    {
        $dateRequest = App::getRequest('date', GeneralHelper::getDateValue(time(), 'date'));
        $categoryCollection = new CategoryCollection();
        $categories = $categoryCollection->loadAllCategories(Category::TYPE_SPEND);
        $operationCollection = new OperationCollection();
        $categoryAmounts     = $operationCollection->getOperationsGroupedBy(GeneralHelper::getDateValue(strtotime("-1 month"), 'date'), 'month');
        $categoryAmountsGrouped = array();
        foreach ($categoryAmounts as $amount) {
            $categoryAmountsGrouped[$amount['category']] = $amount;
        }
        $categoryAmounts = $categoryAmountsGrouped;

        $yearMonth = array();
        for ($i = 0; $i<=6; $i++) {
            $nextMonth = strtotime("+${i} month");
            $yearMonth[] = GeneralHelper::getDateValue($nextMonth, 'date');
        }

        $budgetCollection = new Budget_Collection();
        $budgetArray = $budgetCollection->loadByDateAndGroupedByCat(GeneralHelper::getDateValue($dateRequest, 'month'), GeneralHelper::getDateValue($dateRequest, 'year'));

        $view = $this->getView();
        $view->categories   = $categories;
        $view->budgetArray  = $budgetArray;
        $view->months       = $yearMonth;
        $view->categoryAmounts = $categoryAmounts;
        $view->currentMonthLabel = App::getRequest('date', GeneralHelper::getDateValue(time(), 'date'));
        $view->currentMonthLabel = GeneralHelper::getDateLabel($view->currentMonthLabel, 'month');

        return $view->render('budget/view.php');
    }

    public function reportAction()
    {
        $db = new OperationCollection();
        $amounts = $db->getAmountsGroupedBy('month');

        $categoryCollection = new CategoryCollection();
        $categories = $categoryCollection->loadAllCategories();

        $budgetCollection = new Budget_Collection();
        $budgetArray = $budgetCollection->loadAllByFields(array(
            'user'   => App::getUser()->getId(),
            'date'  =>  App::getRequest('date', GeneralHelper::getDateValue('2014-01-01', 'date')),
        ));

        $incomeBudget = 0;
        $spendBudget  = 0;

        $budgetGrouped = array();
        foreach ($budgetArray as $budget) {
            if (isset($categories[$budget->getCategory()])) {
                $category = $categories[$budget->getCategory()];
                $amount = $budget->getAmount();
                $budgetGrouped[$category->getId()] = $budget;
                if ($category->getType() == Category::TYPE_SPEND) {
                    $spendBudget += $amount;
                } else {
                    $incomeBudget += $amount;
                }
            }
        }

        $budgetArray = $budgetGrouped;



        $view = $this->getView();
        $view->incomeBudget = $incomeBudget;
        $view->spendBudget  = $spendBudget;
        $view->amounts      = $amounts;
        $view->categories   = $categories;
        $view->budgetArray  = $budgetArray;


        return $view->render('budget/report.php');
    }

    public function saveAction()
    {
        $budgets = App::getRequest('budget', array());
        $user  = App::getUser();
        $date = App::getRequest('date', GeneralHelper::getDateValue(time(), 'date'));
        $date = GeneralHelper::getDateValue($date, 'date');

        foreach ($budgets as $categoryId => $amount) {
            if (!ValidateHelper::validateAmount($amount)) {
                App::addErrorAlert('Неправильная сумма');
                GeneralHelper::redirect();
                return;
            }
        }

        foreach ($budgets as $categoryId => $amount) {
            $budget = new Budget();
            $budget->loadByFields(array(
                'user' => $user->familyMemberIds(),
                'category' => $categoryId,
                'date'     => $date
            ));
            $budget->setUser($user->getId());
            $budget->setCategory($categoryId);
            $budget->setDate($date);
            $budget->setAmount($amount);
            $budget->save();
        }
        App::addSuccessAlert();
        GeneralHelper::redirect();
    }
}