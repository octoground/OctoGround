<?php 
	use yii\helpers\Url;
?>	
<div class="og-container">
	<h6>Портфолио</h6>
	<p>Несколько наших выполненных проектов, чтобы у Вас могло сложиться первичное мнение о нашей работе.</p>
	<div class="btn-switch">
		<i class="fa fa-angle-left fa-3x portfolio_btn_prev" aria-hidden="true"></i>
		<i class="fa fa-angle-right fa-3x portfolio_btn_next" aria-hidden="true"></i>
	</div>
	<!-- <div class="body slider"> -->
	<div class="body slider" data-current=0>

		<?php foreach ($portfolios as $portfolio): ?>
			<div class="box">
				<div class="imgBx transition3s">
					<img src="<?= Url::to([$portfolio->img]) ?>" alt="<?= $portfolio->title ?>">
				</div>
				<div class="content">
					<h5 class="transition3s"><?= $portfolio->title ?></h5>
					<p class="transition3s"><?= $portfolio->desc ?></p>
					<a href="<?= $portfolio->url ?>" class="transition3s" target="_blank">посмотреть</a>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>