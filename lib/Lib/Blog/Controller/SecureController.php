<?php

namespace API\Lib\Blog\Controller;

use API\Lib\Blog\Controller\Controller;

abstract class SecureController extends Controller {

    public function executeAction($action) {
        if($this->request->getSession()->existAttribut("userId")) {
            parent::executeAction($action);
        }
        else {
            $this->redirect("connexion");
        }
    }
}