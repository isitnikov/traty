<?php

class CategoryController extends AbstractController
{
    public function viewAction()
    {
        $categoryCollection = new CategoryCollection();
        $allCategories = $categoryCollection->loadAllCategories();
        include APP_TEMPLATES_PATH . 'category' . DIRECTORY_SEPARATOR . 'view.php';
    }

    public function saveAction()
    {
        $name = App::getRequest('name');
        $type = App::getRequest('type');

        $category = new Category();
        $category->setName($name);
        $category->setType($type);

        try {
            $category->loadByNameAndType();

            if (!$category->getId()) {
                $category->save();
            }

            $category->assignToUser(App::getUser());

            App::addSuccessAlert();
        } catch (Exception $e) {
            App::addErrorAlert($e->getMessage());
        }

        GeneralHelper::redirect(GeneralHelper::getUrl('category', 'view'));
    }

    public function statusAction()
    {
        $categoryId = App::getRequest('id', 0);
        $category = new Category();
        $category->load($categoryId);

        if (!$category->getId()) {
            App::addErrorAlert('Нет такой категории');
            GeneralHelper::redirect(GeneralHelper::getUrl('category', 'view'));
            return;
        }

        $category->unassignFromUser(App::getUser());
        GeneralHelper::redirect(GeneralHelper::getUrl('category', 'view'));
    }
}
