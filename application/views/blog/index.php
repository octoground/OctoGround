<?php
\app\assets\BlogAsset::register($this);

use yii\helpers\Url;
$this->title = 'Статьи';

$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->title]);
$this->registerMetaTag(['name' => 'og:url', 'content' =>  'https://octoground.ru/blog/index']);
$this->registerMetaTag(['name' => 'og:description', 'content' => 'Наш блог']);
$this->registerMetaTag(['name' => 'og:image', 'content' => Url::to(['/images/default/bg-octo.jpg'])]);


$this->registerMetaTag(
    ['name' => 'description', 'content' =>  'Создание и продвижение сайтов - Digital-agency OctoGround - создаем и продвигаем современные и продающие сайты. Звоните +7 (922) 777-45-46']
);
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