<?php

class BudgetController extends AbstractController
{
    public function viewAction()
    {
        $db = new OperationCollection();
        $amounts = $db->getAmountsGroupedBy('month');

        $categoryCollection = new CategoryCollection();
        $categories = $categoryCollection->loadAllCategories();

        $budgetCollection = new Budget_Collection();
        $budgetArray = $budgetCollection->loadAllByFields(array(
            'user'   => App::getUser()->getId(),
            'month'  => 12,
        ));

        $incomeBudget = 0;
        $spendBudget  = 0;
        foreach ($budgetArray as $budget) {
            if (isset($categories[$budget->getCategory()])) {
                $category = $categories[$budget->getCategory()];
                $amount = $budget->getAmount();

                if ($category->getType() == Category::TYPE_SPEND) {
                    $spendBudget += $amount;
                } else {
                    $incomeBudget += $amount;
                }
            }
        }


        require APP_TEMPLATES_PATH . 'budget' . DIRECTORY_SEPARATOR . 'view.php';
    }

    public function saveAction()
    {
        $budgets = App::getRequest('budget', array());
        $user  = App::getUser();
        $month = date('n');

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
                'user' => $user->getId(),
                'category' => $categoryId,
                'month'     => $month
            ));
            $budget->setUser($user->getId());
            $budget->setCategory($categoryId);
            $budget->setMonth($month);
            $budget->setAmount($amount);
            $budget->save();
        }
        App::addSuccessAlert();
        GeneralHelper::redirect();
    }
}