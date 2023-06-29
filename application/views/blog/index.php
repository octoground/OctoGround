<?php
\app\assets\BlogAsset::register($this);

use yii\helpers\Url;
?>

<div class="blog">
    <div class="blog_header">
        <picture>
            <source media="(max-width: 650px)" srcset="<?= Url::to(['/images/default/blog_mobile.png']) ?>">
            <img src="<?= Url::to(['/images/default/blog.png']) ?>" alt="">
        </picture>
        <!-- <img src="" alt=""> -->

        <ul class=" blog_menu flex">
        <li><a href="#" class="transition3s" data-type="0">Все</a></li>
        <?php foreach ($blog->typies as $key => $type) : ?>
            <li><a href="#" class="transition3s" data-type="<?= $type->id ?>"><?= $type->title ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>

    <div class="blog_body max-width">
        <?= $this->render('_blog_item', compact('blog')) ?>
    </div>
</div>