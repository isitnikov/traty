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
        var_dump(App::getRequest());
        $name = App::getRequest('name');
        $type = App::getRequest('type');

        $category = new Category();
        $category->setName($name);
        $category->setType($type);
        $category->save();

        App::addSuccessAlert();
        GeneralHelper::redirect(GeneralHelper::getUrl('category', 'view'));
    }
}
