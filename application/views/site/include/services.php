<?php 
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
?>	
<div class="og-container">
	<div class="line-horizont"></div>
	<h6>Что мы предлагаем</h6>
	<p>Все задачи мы выполняем качественно и без шаблонов, к каждому проекту индивидуальный подход. Мы стараемся докапываться до мелочей чтобы преподнести Ваш продукт или услугу максимально эфектно для клиентов.</p>
	
	<div class="body">
		<!-- <a href="#auth_cabinet" class="auth" data-effect="mfp-zoom-in"><i class="fa fa-user-o" aria-hidden="true"></i></a> -->
		<a href="#serviceForm" class="service transition3s serviceForm" data-service="site" data-effect="mfp-zoom-in">Разработка сайтов <i class="fa fa-long-arrow-right transition3s" aria-hidden="true"></i></a>
		<a href="#serviceForm" class="service transition3s serviceForm" data-service="adv" data-effect="mfp-zoom-in">Продвижение <i class="fa fa-long-arrow-right transition3s" aria-hidden="true"></i></a>
		<a href="#serviceForm" class="service transition3s serviceForm" data-service="crm" data-effect="mfp-zoom-in">Разработка CRM <i class="fa fa-long-arrow-right transition3s" aria-hidden="true"></i></a>
		<a href="#serviceForm" class="service transition3s serviceForm" data-service="copy" data-effect="mfp-zoom-in">Копирайт <i class="fa fa-long-arrow-right transition3s" aria-hidden="true"></i></a>
		<a href="#serviceForm" class="service transition3s serviceForm" data-service="support" data-effect="mfp-zoom-in">Поддержка <i class="fa fa-long-arrow-right transition3s" aria-hidden="true"></i></a>
	</div>

	<div id="serviceForm" class="white-popup mfp-with-anim mfp-hide">
		<?php $form = ActiveForm::begin([
			'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}",
  
        ],
		]) ?>
			<h3>Обратная связь</h3>	
			<?= $form->field($model_services, 'name')->textInput() ?>
			<?= $form->field($model_services, 'phone')->textInput() ?>
			<?= $form->field($model_services, 'service')->hiddenInput()->label(false) ?>
			<div class="btn-wrapper">
				<?= Html::submitButton('Отправить', ['class' => 'og_btn transition3s']) ?>
			</div>
		<?php ActiveForm::end() ?>
		<ul class="info">
			<li><a href="tel:89527107231">8(952) 710-72-31</a></li>
			<li><a href="mailto:octogroud@yandex.ru">octogroud@yandex.ru</a></li>
		</ul>
	</div>

</div>