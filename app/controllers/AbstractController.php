<?php

abstract class AbstractController
{
    public function notFoundAction()
    {
        header('Location: ' . BASE_URL);
    }
}
