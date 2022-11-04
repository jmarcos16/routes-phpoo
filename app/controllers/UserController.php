<?php

namespace app\controllers;

use app\core\Request;

class UserController
{

    public function index()
    {
    }

    public function edit($id)
    {

        dd(Request::excepts('name'));
    }
}
