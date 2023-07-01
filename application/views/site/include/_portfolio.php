<?php

use yii\helpers\Url;
?>

<a href="<?= $item->url ?>" class="item box w5 h5 anim8" target="_blank" rel="nofollow">
    <noindex>
        <div class="transition3s">
            <img src="<?= Url::to([$item->img]) ?>" alt="<?= $item->title ?>" class="transition3s">

            <div>
                <span><?= $item->title ?></span>
                <p><?= $item->desc ?></p>
                <div class="btn mobile ">
                    <div class="flex">
                        <span class="flex"></span>
                        <!-- <p>Перейти по ссылке</p>
                    <p>Перейти на сайт</p> -->
                        <p>Оценить сайт</p>
                    </div>

                </div>
            </div>
        </div>
    </noindex>
</a>