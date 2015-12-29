<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Login PHP</title>
</head>
<body background="<?= Url::to(['/images/gedung-bapeten.jpg'])?>">
<br/>
<br/>
<br/>

    <div class="lg-container">
        <center><img src="<?= Url::to(['/images/login.png'])?>"/></center>
        <h2 align="center">Reset Password Anda</h2>
        <?php $form = ActiveForm::begin(['id' => 'login-form','options' => ['class' => 'form-horizontal form-bordered form-control-borderless'],]); ?>
            
            <div>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>"Masukan Email"])->label(false) ?>
            </div>
            
            <div class="form-group">
                    <?= Html::submitButton('Reset', ['class' => 'btn btn-block btn-primary ', 'name' => 'login-button']) ?>
                     <?= Html::a(Yii::t('app', 'Login'), ['login'], ['class' => 'btn btn-block btn-primary']) ?>
                
                </div>
            
        <?php ActiveForm::end(); ?>
        <div id="message"></div>
    </div>
        <h2 align="center"><font color="white">Copyright <?php echo date('Y') ?> Subbag Perjalanan Dinas Biro Umum BAPETEN</font></h2>
        <br/>
        <br/>

</body>
</html>
<script type="text/javascript">
 
</script>
<style type="text/css">
.btn-primary {
    background-color: #5c2040;
    border-color: #1bbae1;
    color: #fff;
}

.lg-container{
    width:675px;
    margin:100px auto;
    padding:20px 20px;
    border:1px solid #f4f4f4;
    background:rgba(255,255,255,.5);
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    
    -webkit-box-shadow: 0 0 2px #aaa;
    -moz-box-shadow: 0 0 2px #aaa;
    box-shadow: 0 0 2px #aaa;
}
.lg-container h1{
    font-size:40px;
    text-align:center;
}
#lg-form > div {
    margin:10px 5px;
    padding:5px 0;
}
#lg-form label{
    display: none;
    font-size: 20px;
    line-height: 25px;
}
#lg-form input[type="text"],
#lg-form input[type="password"]{
    border:1px solid rgba(51,51,51,.5);
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    padding: 5px;
    font-size: 16px;
    line-height: 20px;
    width: 100%;
    font-family: 'Oleo Script', cursive;
    text-align:center;
}
#lg-form div:nth-child(3) {
    text-align:center;
}
#lg-form button{
    font-family: 'Oleo Script', cursive;
    font-size: 18px;
    border:1px solid #000;
    padding:5px 10px;
    border:1px solid rgba(51,51,51,.5);
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    
    -webkit-box-shadow: 2px 1px 1px #aaa;
    -moz-box-shadow: 2px 1px 1px #aaa;
    box-shadow: 2px 1px 1px #aaa;
    cursor:pointer;
}
#lg-form button:active{
    -webkit-box-shadow: 0px 0px 1px #aaa;
    -moz-box-shadow: 0px 0px 1px #aaa;
    box-shadow: 0px 0px 1px #aaa;
}
#lg-form button:hover{
    background:#f4f4f4;
}
#message{width:100%;text-align:center}
.success {
    color: green;
}
.error {
    color: red;
}
</style>