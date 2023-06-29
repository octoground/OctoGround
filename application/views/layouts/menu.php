<?php

use yii\helpers\Url;
?>

<div class="menu transition3s <?= Yii::$app->controller->action->id != 'main'  ? 'scroll stop' : '' ?>">
    <div class="flex max-width">

        <div class="logo">
            <!-- <a><span>O</span>cto<span>G</span>round<span>.</span></a>
                    <a>OctoGround<span>.</span></a> -->
            <a href="<?= Url::to(['site/main']) ?>">OctoGround.</a>
        </div>


        <div class="right flex">
            <!-- <div class="number"> +7 (952) 710-72-31</div> -->
            <menu class="flex desktop">
                <li><a href="<?= Url::to(['blog/index']) ?>">Блог</a></li>
                <li><a href="<?= Url::to(['site/portfolio']) ?>">Портфолио</a></li>
                <li><a href="<?= Url::to(['site/about']) ?>">О нас</a></li>
            </menu>
            <div class="menu_btn side_btn side_btn_toggle flex">
                <div></div>
            </div>
        </div>
    </div>

    <div class="side active">
        <div class="side_btn  close flex">
            <div class="side_btn_toggle"></div>
        </div>
        <div class="side_desk">
            <p>OctoGround.</p>
            <p>Профессионалы своего дела, готовые помочь вам взобраться на новые вершины!</p>
        </div>

        <menu class="flex mobile">
            <li><a href="<?= Url::to(['blog/index']) ?>">Блог</a></li>
            <li><a href="<?= Url::to(['site/portfolio']) ?>">Портфолио</a></li>
            <li><a href="<?= Url::to(['site/about']) ?>">О нас</a></li>
        </menu>

        <ul class="flex side_btn_offer">
            <li><a href="<?= Url::to(['site/brief']) ?>">Заполнить бриф</a></li>
            <li><a href="#connect" class="connect" data-effect="mfp-move-horizontal" data-type="Связаться">Связаться</a></li>
        </ul>

    </div>
    <div class="side_sub"></div>
</div>