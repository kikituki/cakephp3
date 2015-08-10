<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Logout Controller
 *
 */
 
class LogoutController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        //セッションのログインユーザをクリア
        $this->request->session()->write('loginUser',null);
    }


}
