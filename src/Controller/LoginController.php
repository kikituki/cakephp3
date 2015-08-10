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
        //初期表示は何もしない
    }

    /**
     * Auth method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function auth()
    {
        //ログイン処理
        
        // パラメータの受取
        $name = $this->request->data['userId'];
        $pass = $this->request->data['pass'];

        //Usersテーブルを検索
        $tableUsers = TableRegistry::get('Users');
        $queryStr = "select name from users where name='" . $name . "' and password = '" . $pass . "'";
        // パスワード入力値 or 1=1;--
        //$queryStr = "select name from users where name='" . $name . "' and password = '" . $pass . "' or 1=1";

        Log::write('debug', $queryStr);
        //SQL発行        
        $data = $tableUsers->connection()->query($queryStr);
        //配列のサイズで判定する
        $cnt = sizeof($data);
        
        if ($cnt == 0) {
           //レコードなし認証NGとする
           Log::write('debug', '認証エラー');
           $this->Flash->error('Auth Error: id or password is incorrect');          
           // ログイン画面に戻る
           return $this->redirect(['action' => '../Login/index']);        
        }
        Log::write('debug', '認証OK');
        foreach ($data as $key => $value){
             Log::write('debug', 'userName is :'.$value['name']);
             $this->request->session()->write('loginUser',$value['name']);
        }
        
        // 成功した場合は記事一覧へ
        return $this->redirect(['action' => '../Articles/index']);
    }
}
