<div>
<?php 
if(!empty($errors)){
// エラーメッセージ
    foreach ($errors as $error){
        echo h($error) . "<br/>";
    }
}
?>
<form action="/login/auth" method="POST">
ユーザID:<input type="text" name="userId" size="10"/>
パスワード:<input type="password" name="pass" size="10"/>
<input type="submit" value="ログイン"/>
</form>
</div>
