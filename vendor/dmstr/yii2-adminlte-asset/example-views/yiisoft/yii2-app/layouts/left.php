<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <?php  

            $menuItems = [
                            ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['site/login']];
            } else {
                $menuItems = [
                      ['label' => 'Daftar SMK', 'url' => ['/daftar-smk'],'icon' => 'fa fa-university'],
                      ['label' => 'Daftar Jurusan', 'url' => ['/daftar-jurusan'],'icon'=>'fa fa-bars'],
                      ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                      ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                ];
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'icon' => 'fa fa-sign-out',
                    'linkOptions' => ['data-method' => 'post']
                ];
            }

            ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
