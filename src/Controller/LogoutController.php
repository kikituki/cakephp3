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
        //�Z�b�V�����̃��O�C�����[�U���N���A
        $this->request->session()->write('loginUser',null);
    }


}
