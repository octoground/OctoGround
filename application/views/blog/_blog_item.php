<?php

use yii\helpers\Url;
?>
<a href="<?= Url::to(['blog/view', 'id' => $blog->articlies[0]->id]) ?>" class="items_main flex anim8">
    <div class="left">
        <img src="<?= Url::to([$blog->articlies[0]->img]) ?>" alt="<?= $blog->articlies[0]->header ?>">
        <div class="item_hover transition3s">
            <img src="<?= Url::to(['/images/default/svg/arrow.svg']) ?>" alt="">
        </div>
        <div class=" substrate transition3s">
        </div>
    </div>
    <div class="right">
        <span><?= $blog->articlies[0]->type->title ?></span>
        <h3><?= $blog->articlies[0]->header ?></h3>
        <p><?= $blog->articlies[0]->desc ?></p>

        <div class="autor flex">
            <div class="l">
                <img src="<?= Url::to([$blog->articlies[0]->author->img]) ?>" alt="">
            </div>
            <div class="r flex">
                <span><?= $blog->articlies[0]->author->fio ?></span>
                <p><?= yii::$app->formatter->asDate($blog->articlies[0]->date) ?></p>
            </div>
        </div>
    </div>
</a>

<div class="items_all grid">

    <?php foreach ($blog->articlies as $key => $article) : ?>
        <?php if ($key > 0) : ?>


            <a href="<?= Url::to(['blog/view', 'id' => $article->id]) ?>" class="item anim8">
                <div class="item_img">
                    <img src="<?= Url::to([$article->img]) ?>" alt="<?= $article->header ?>">
                    <div class="item_hover transition3s">
                        <img src="<?= Url::to(['/images/default/svg/arrow.svg']) ?>" alt="">
                    </div>
                    <div class="substrate transition3s"></div>
                </div>


                <div class="info">
                    <span><?= $article->type->title ?></span>
                    <h4><?= $article->header ?></h4>
                    <p><?= $article->desc ?></p>
                    <div class="autor flex">
                        <div class="l">
                            <img src="<?= Url::to([$article->author->img]) ?>" alt="">
                        </div>
                        <div class="r flex">
                            <span><?= $article->author->fio ?></span>
                            <p><?= yii::$app->formatter->asDate($article->date) ?></p>
                        </div>
                    </div>
                </div>
            </a>


        <?php endif; ?>
    <?php endforeach; ?>


</div>