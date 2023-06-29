<?php
    use yii\helpers\Url;
    use app\models\Table;
    use app\modules\install\models\Settings;

    // MenuAsset::register($this);
?>
<nav>
        <div class="menu">
            <div><div></div></div>
            <div class="logo">
            </div>
        </div>
    
        <input type="search" placeholder="Поиск по сайту">

        <div class="settings">
            <ul class="nav navbar-right top-nav">
            
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['/user/logout'])?>" data-method="post"><i class="fa fa-user"></i> Профиль</a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['/user/logout'])?>" data-method="post"><i class="fas fa-cog"></i> Настройки</a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::to(['/user/logout'])?>" data-method="post"><i class="fa fa-fw fa-power-off"></i> Выход</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="menu_content">
        <div>
            <span>Контент</span>
            <?php if (!Settings::find()->where(['is_installed' => 0])->exists()): ?>
                <!-- <ul>
                    <li class="sub">Содержимое сайта -->
                        <ul>
                            <?php foreach (Table::find()->where(['name' => \Yii::$app->dbFrontEnd->schema->tableNames])->andWhere(['is_linked' => '0'])->all() as $table) : ?>
                                <li class="<?= \Yii::$app->controller->action->id == 'index' && \Yii::$app->request->get('id') == $table->id ? 'active' : ''?>">
                                    <a href="<?= Url::to(['/edit/main/index', 'id' => $table->id]);?>"><?= $table->alias; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <!-- </li>
                </ul> -->
            <?php endif; ?>
        </div>
        <div>
            <span>APP</span>
            <ul>
                <li><a href="<?= Url::to(['/site/index']) ?>">Dashboard</a></li>
                <li><a href="<?= Url::to(['/site/index']) ?>">To do</a></li>
            </ul>
        </div>
        <?php if (\Yii::$app->user->identity->is_admin): ?>
                        
            <div>
                <span>Настройки</span>
                <ul>
                    <li <?= \Yii::$app->controller->id == 'main' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/install/main/index']); ?>"><i class="fa fa-globe" aria-hidden="true"></i> Установка</a>
                    </li>
                    <li <?= \Yii::$app->controller->id == 'table' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/install/table/index']); ?>"><i class="fa fa-table"></i> Таблицы</a>
                    </li>
                    <li <?= \Yii::$app->controller->id == 'relation' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/install/relation/index']); ?>"><i class="fa fa-compress" aria-hidden="true"></i> Связи</a>
                    </li>
                    <li <?= \Yii::$app->controller->id == 'linked' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/install/linked/index']); ?>"><i class="fas fa-network-wired"></i> Связные таблицы</a>
                    </li>
                    <li <?= \Yii::$app->controller->id == 'gallery' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/install/gallery/index']); ?>"><i class="fa fa-fw fa-edit"></i> Фотогалереи</a>
                    </li>
                    <li <?= \Yii::$app->controller->id == 'cropper' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/install/cropper/index']); ?>"><i class="fa fa-crop" aria-hidden="true"></i> Обрезка изображений</a>
                    </li>
                    <li <?= \Yii::$app->controller->id == 'params' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/install/params/index']); ?>"><i class="fa fa-wrench" aria-hidden="true"></i></i> Параметры сайта</a>
                    </li>
                    <li <?= \Yii::$app->controller->id == 'params' ? 'class="active"' : ''?>>
                        <a href="<?= \yii\helpers\Url::to(['/users/main/index']); ?>"><i class="fas fa-user-friends" aria-hidden="true"></i></i> Пользователи</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>