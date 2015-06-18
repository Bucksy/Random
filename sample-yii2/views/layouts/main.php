<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php echo Html::jsFile('@web/js/main.js')?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
           /* NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();*/
        ?>
        <?php
         $session = Yii::$app->session;
        //$session->set('name', 'Joro');
        //  exit(var_dump(Yii::$app->user->identity));
         // exit(var_dump(Yii::$app->session->username));
        ?>
        <nav id="w0" class="navbar-inverse navbar-fixed-top navbar" role="navigation">
            <div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button><a class="navbar-brand" href="/sample-yii2/web/index.php">My First Yii Test</a></div>
                <div id="w0-collapse" class="collapse navbar-collapse"><ul id="w1" class="navbar-nav navbar-right nav"><li class="active"><a href="/sample-yii2/web/index.php?r=site%2Findex">Home</a></li>
                        <li><a href="/sample-yii2/web/index.php?r=site%2Fabout">About</a></li>
                        <li><a href="/sample-yii2/web/index.php?r=site%2Fcontact">Contact</a></li>
                        <li>
                            
                                <?php
                                 if(Yii::$app->user->id){
                                ?>
                                    <a href="/sample-yii2/web/index.php?r=site%2Flogout" data-method="post">
                                        Logout(admin)
                                    </a>
                                <?php }else{ ?>
                                    <a href="/sample-yii2/web/index.php?r=site%2Flogin" data-method="post">
                                        Please log in
                                    </a>
                                <?php } ?>
                        </li></ul></div></div>
        </nav>
        
        <div class="container">
           
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
