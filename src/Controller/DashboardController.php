<?php

declare(strict_types=1);

namespace App\Controller;

class DashboardController extends AppController
{
    public function index()
    {
        $usersTable = $this->fetchTable('Users');
        $users_count = $usersTable->find()->count();

        $this->set(compact('users_count'));
        $this->render('/dashboard');
    }
}
