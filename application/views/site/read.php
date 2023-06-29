<?php 
	use yii\helpers\Url;

	$this->title = $blog->subject;
	$this->registerMetaTag(
		['name' => 'description', 'content' => $blog->description]
	);
?>
<div class="read">

	<div class="info">
		<a href="<?= Url::to(['index']) ?>" class="back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> назад</a>
		<div class="body">		
			<h1><?= $blog->subject ?><div class="line-horizont"></div></h1>
			<?= $blog->text ?>
			<br>
			<div class="author">Автор: <span><?= $blog->author ?>, <?= yii::$app->formatter->asDate($blog->created_at) ?></span></div>
		</div>
		<div class="footer">
			<ul class="social">
				<li><a href="https://www.facebook.com/groups/641825729591266/" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://vk.com/octogroundstudio" target="_blank"><i class="fa fa-vk"></i></a></li>
				<li><a href="https://www.instagram.com/octoground" target="_blank"><i class="fa fa-instagram"></i></a></li>
			</ul>
			<!-- <div class="social">vk fc inst</div> -->
			<div class="octo">© OctoGround 2020</div>
			<!-- <div class="date">15.02.2015</div> -->
		</div>
	</div>

	<div class="img">
		<img src="<?= Url::to([$blog->read_img]) ?>" alt="<?= $this->title ?>">
	</div>

</div>
