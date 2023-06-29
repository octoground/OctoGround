<?php

use yii\helpers\Url;
?>

<a href="<?= $item->url ?>" class="item box w5 h5 anim8">
    <div class="transition3s">
        <img src="<?= Url::to([$item->img]) ?>" alt="<?= $item->title ?>" class="transition3s">

        <div>
            <span><?= $item->title ?></span>
            <p><?= $item->desc ?></p>
            <div class="btn mobile ">
                <div class="flex">
                    <span class="flex"></span>
                    <p>Перейти по ссылке</p>
                </div>

            </div>
        </div>
    </div>
</a>