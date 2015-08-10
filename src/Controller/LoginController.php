<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Login Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
 
class LoginController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        //�����\���͉������Ȃ�
    }

    /**
     * Auth method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function auth()
    {
        //���O�C������
        
        // �p�����[�^�̎��
        $name = $this->request->data['userId'];
        $pass = $this->request->data['pass'];

        //Users�e�[�u��������
        $tableUsers = TableRegistry::get('Users');
        $queryStr = "select name from users where name='" . $name . "' and password = '" . $pass . "'";
        // �p�X���[�h���͒l or 1=1;--
        //$queryStr = "select name from users where name='" . $name . "' and password = '" . $pass . "' or 1=1";

        Log::write('debug', $queryStr);
        //SQL���s        
        $data = $tableUsers->connection()->query($queryStr);
        //�z��̃T�C�Y�Ŕ��肷��
        $cnt = sizeof($data);
        
        if ($cnt == 0) {
           //���R�[�h�Ȃ��F��NG�Ƃ���
           Log::write('debug', '�F�؃G���[');
           $this->Flash->error('Auth Error: id or password is incorrect');          
           // ���O�C����ʂɖ߂�
           return $this->redirect(['action' => '../Login/index']);        
        }
        Log::write('debug', '�F��OK');
        foreach ($data as $key => $value){
             Log::write('debug', 'userName is :'.$value['name']);
             $this->request->session()->write('loginUser',$value['name']);
        }
        
        // ���������ꍇ�͋L���ꗗ��
        return $this->redirect(['action' => '../Articles/index']);
    }
}
