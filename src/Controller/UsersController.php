<?php

declare(strict_types=1);

namespace App\Controller;

class UsersController extends AppController
{
    public array $paginate = [
        'limit' => 25, 
        'order' => [
            'Users.created' => 'DESC'
        ]
    ];

    public function index()
    {   
        $this->set('users', $this->paginate($this->Users));
        $this->render('/users/index');
    }
}
