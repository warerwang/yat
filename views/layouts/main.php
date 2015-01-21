<?php
use yii\helpers\Html;
use yii\widgets\Menu;
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
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->id,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $this->context->navbarItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget(['links' => $this->context->breadcrumbs]) ?>
            <?php if ( $this->context->menu ): ?>
            <div style="width: 90%; margin: 0 auto;">
                <div class="col-md-2" style="margin-top: 20px">
                    <nav class="navbar navbar-default">
                        <?php

                        echo Menu::widget([
                            'items' => $this->context->menu,
                            'options' => array('class' => 'nav'),
                        ]);

                        ?>
                    </nav><!-- sidebar -->
                </div>

                <div class="col-md-10 last">
            <?php endif; ?>
                    <section>
                        <div id="content">
                            <?php //$this->context->showFlashes() ?>
                            <?php echo $content; ?>
                        </div><!-- content -->
                    </section>
                    <?php if ( $this->context->menu ): ?>
                </div>
            </div>
            <?php endif; ?>
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
