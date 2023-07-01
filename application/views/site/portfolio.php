<?php
\app\assets\PortfolioAsset::register($this);

use yii\helpers\Url;

$this->title = 'portfolio';

$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->title]);
$this->registerMetaTag(['name' => 'og:url', 'content' =>  'https://octoground.ru/site/portfolio']);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  'Здесь представлены все наши проекты. В каждый из них мы вкладывались по полной. Находили пути решения сложных и интресных задач. Благодаря нашим решениям клиенты получаюбт больше выгоды. Мы поможем Вашему бизнесу стать сильнее!']);
$this->registerMetaTag(['name' => 'og:image', 'content' => Url::to(['/images/default/bg-octo.jpg'])]);


$this->registerMetaTag(
    ['name' => 'description', 'content' =>  'Создание и продвижение сайтов - Digital-agency OctoGround - создаем и продвигаем современные и продающие сайты. Звоните +7 (952) 710-72-31']
);


?>
<div class="portfolio">
    <div class="portfolio_main max-width">
        <h3>Портфолио</h3>
        <p>Здесь представлены все наши проекты. В каждый из них мы вкладывались по полной. Находили пути решения сложных и интресных задач. Благодаря нашим решениям клиенты получаюбт больше выгоды. Мы поможем Вашему бизнесу стать сильнее!</p>
    </div>

    <div class="portfolio_navigation max-width">
        <ul class="flex">
            <li data-type="0">Все</li>
            <?php foreach ($navigations as $key => $navigation) : ?>
                <li data-type="<?= $navigation->id ?>"><?= $navigation->title ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="portfolio_items grid">

        <?= $this->render('include/_foreach_portfolio', compact('items')) ?>

    </div>




</div>