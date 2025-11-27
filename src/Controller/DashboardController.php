<?php

declare(strict_types=1);

namespace App\Controller;

use Aws\S3\S3Client;

class DashboardController extends AppController
{
    public function index(S3Client $client)
    {
        // debug($client);
        // exit;

        $usersTable = $this->fetchTable('Users');
        $users_count = $usersTable->find()->count();

        $this->set(compact('users_count'));
        $this->render('/dashboard');
    }
}
