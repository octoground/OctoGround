<?php
\app\assets\PortfolioAsset::register($this);

use yii\helpers\Url;
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