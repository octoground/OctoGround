<?php 
	use yii\helpers\Url;
?>
<div class="og-container teem_content_js">
	<h6>Команда</h6>
	<div class="content">
		<div class="photo">
			<img src="<?= Url::to(['images/default/teem/Ivan.jpg']) ?>" alt="Иван Гончар - backend разработчик веб студии OctoGround" class="noVisible visible">
			<img src="<?= Url::to(['images/default/teem/kricha.jpg']) ?>" alt="Кричевцов Александр - frontend разработчик веб студии OctoGround" class="noVisible">
			<img src="<?= Url::to(['images/default/teem/sergo.jpg']) ?>" alt="Ясногурский Сергей - Дизайнер веб студии OctoGround" class="noVisible">
		</div>
		
		<div class="info teem_info_js">
			<div class="noVisible visible">				
				<div class="headline">Гончар Иван, <span>backend developer</span></div>
				<p>От идеи до воплощения - волшебный творческий процесс, требующий четкой организации. Время - самое бесценное в нашей жизни. Мы стремимся к эффективному управлению проектами, чтобы Ваш будущий интернет-ресурс стал ближе уже сегодня.</p>
			</div>
			<div class="noVisible">				
				<div class="headline">Кричевцов Александр, <span>frontend developer</span></div>
				<p>Мы - группа творческих людей, влюбленных в свое дело. Более года мы занимаемся дизайном. Свежий взгляд и неординарный подход к созданию интернет-ресурса - наше кредо.</p>
			</div>
			<div class="noVisible">				
				<div class="headline">Ясногурский Сергей, <span>Дизайнер</span></div>
				<p>Человек и дизайн неразрывно связаны и находятся в постоянном взаимодействии. Моя задача - настроить эту связь на нужную волну, создав гармонично звучащий интернет-ресурс.</p>
			</div>
		</div>
	</div>
	<footer>
		<i class="fa fa-angle-left fa-3x og_teem_prev" aria-hidden="true" data-type="prev"></i>
		<i class="fa fa-angle-right fa-3x og_teem_next" aria-hidden="true" data-type="next"></i>
	</footer>
</div>