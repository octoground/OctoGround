<?php 
	use yii\helpers\Url;
?>
<div class="og-container">

	<div class="reviews">
		<div class="company-logo">
			<!-- <img src="<?= Url::to(['images/default/logo/repartion.png']) ?>" alt="Репартион" class="transition3s active" data-content="1" style="height: 70px"> -->
			<img src="<?= Url::to(['images/default/logo/blunt.png']) ?>" alt="Blunt shop" class="transition3s active" data-content="1" style="height: 70px">
			<img src="<?= Url::to(['images/default/logo/rodent_house.png']) ?>" alt="Дом грызунов" class="transition3s" data-content="2" style="height: 70px">
		</div>
		<!-- <div class="content " id="1">
			<div class="photo">
				<img src="<?= Url::to(['images/default/teem/kricha.jpg']) ?>" alt="Иван Гончар - backend разработчик веб студии OctoGround">
			</div>
			<div class="body">
				<header>
					<div class="line-horizont"></div>
					<h6>Что о нас говорят?</h6>
					<p>все для принтера - интернет магазин репартион</p>
				</header>
				<p>Отличное агенство, очень профессионально подходят к работе. Все поставленные задачи выполнили в срок и без нариканий.</p>
				<footer>
					<div class="line-horizont"></div>
					Ответственный за разработку сайта
				</footer>
			</div>
		</div> -->
		<div class="content" id="1">
			<div class="photo">
				<img src="<?= Url::to(['images/default/review/andrew.jpg']) ?>" alt="Андрей - ответственный за разработку интернет-магазина">
			</div>
			<div class="body">
				<header>
					<div class="line-horizont"></div>
					<h6>Что о нас говорят?</h6>
					<p>магазин спортивной одежды - blunt shop</p>
				</header>
				<p>Заказал проект, очень очковал т. к. портфолио небольшое. Сроки были поставлены в 2 недели и они не укладывались, в этот момент я уже подумал что киданули. Буквально через 2 дня мне кидают сборку, готовый дизайн и я просто в шоке, всё хорошо, без багов, дизайн на высоте. Я полностью удовлетворён. Советую и рекомендую digital agency OctoGround.</p>
				<footer>
					<div class="line-horizont"></div>
					Андрей, ответственный за разработку сайта
				</footer>
			</div>
		</div>
		<div class="content hidden" id="2">
			<div class="photo">
				<img src="<?= Url::to(['images/default/review/rodent.jpg']) ?>" alt="Владимир - ответственный за разработку интернет-магазина">
			</div>
			<div class="body">
				<header>
					<div class="line-horizont"></div>
					<h6>Что о нас говорят?</h6>
					<p>магазин витрин для грызунов - Дом грызунов</p>
				</header>
				<p>Отличная студия, с самого начала все по делу, оценили проект, написали конкретное уточнение. Все выполнили без лишних слов в ходе работы предлагали интересные идеи. Очень рекомендую и сам буду работать дальше.</p>
				<footer>
					<div class="line-horizont"></div>
					Владимир, ответственный за разработку сайта
				</footer>
			</div>
		</div>
	</div>

	<div class="blog" data-current="0">
		<h6>Блог</h6>
		<div class="content">
			<div class="btn-control blog_prev">prev</div>
			<div class="body">
				
				<?php foreach ($blogs as $blog): ?>
					<div class="blog-item">
 						<div class="author">
							<div class="line-horizont"></div>
							<?= $blog->author ?><br>
							<span><?= $blog->post ?></span> 
						</div>
						<div class="blog-item-img">
							<img src="<?= Url::to([$blog->main_img]) ?>" alt="<?= $blog->subject ?>">
							<div class="subject"><?= $blog->subject ?></div>
						</div>
						
						<a href="<?= Url::to(['site/read-news', 'new_id' => $blog->id]) ?>">читать <div class="line-horizont"></div></a>
					</div>
				<?php endforeach ?>

			</div>
			<div class="btn-control blog_next">next</div>
		</div>
	</div>
	
	<footer>
		<h6>Работай вмести с нами</h6>
		<p>Мы всегда рады обсудить, как мы можем помочь Вам, воплотить свою идею в реальность!</p>
		<ul class="social">
			<li><a href="https://vk.com/octogroundstudio" target="_blank" data-mobile="vk">vkontakte</a></li>
			<li><a href="https://www.facebook.com/groups/641825729591266/" target="_blank"  data-mobile="fc">facebook</a></li>
			<li><a href="https://www.instagram.com/octoground" target="_blank"  data-mobile="inst">instagram</a></li>
		</ul>
		<div class="octoground"><i class="fa fa-copyright" aria-hidden="true"></i> OctoGround 2020</div>
	</footer>
</div>