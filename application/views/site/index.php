<?php
\app\assets\MainAsset::register($this);

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<!-- <div class="vh"></div>
<div class="perc"></div> -->
<div class="main flex">
    <div class="main_content">
        <p class="main_stroke">
            digital agency
        </p>
        <p>
            <img src="<?= Url::to(['/images/default/svg/octoground_name.svg']) ?>" alt="OctoGround">
        </p>
        <p>Помогаем Вашему бизнесу стать сильнее</p>
    </div>

    <div class="main_fraime">
        <img src="<?= Url::to(['/images/default/svg/main_frame.svg']) ?>" alt="">
    </div>
</div>




<div class="service">
    <div class="service_content max-width">
        <div class="service_content_header">
            <h3>Что мы предлагаем</h3>
            <p>Все задачи мы выполняем качественно и без шаблонов, к каждому проекту индивидуальный подход. Мы стараемся докапываться
                до мелочей чтобы преподнести Ваш продукт или услугу максимально эфектно для клиентов.</p>
        </div>

        <div class="service_content_items flex">


            <a href="#connect" class="service_content_item connect" data-effect="mfp-move-horizontal" data-type="Разработка">
                <div class="flex">
                    <img src="" alt="">
                </div>


                <div class="item">
                    <h4>Разработка</h4>
                    <p>Мы используем исключительно современные технологии и методы. Таким образом мы обеспечиваем надежность, качество и быстродействие.</p>
                </div>

                <div class="sub"></div>
            </a>
            <a href="#connect" class="service_content_item connect" data-effect="mfp-move-horizontal" data-type="Маркетинг">
                <div class="flex">
                    <img src="" alt="">
                </div>


                <div class="item">
                    <h4>Маркетинг</h4>
                    <p>Мы используем комплекс мероприятий по продвижению, обеспечивающий максимальный результат сближающий ваш бизнес с целевой аудиторией.</p>
                </div>

                <div class="sub"></div>
            </a>
            <a href="#connect" class="service_content_item connect" data-effect="mfp-move-horizontal" data-type="Сопровождение">
                <div class="flex">
                    <img src="" alt="">
                </div>


                <div class="item">
                    <h4>Сопровождение</h4>
                    <p>Устарел сайт? Нет нужного функционала? Мы справимся с любой задачей любой сложности. Гарантии! Качество! Скидки!</p>
                </div>

                <div class="sub"></div>
            </a>
            <a href="#connect" class="service_content_item connect" data-effect="mfp-move-horizontal" data-type="Копирайт">
                <div class="flex">
                    <img src="" alt="">
                </div>


                <div class="item">
                    <h4>Копирайт</h4>
                    <p>Написание качественных, интересных и полезных текстов, которые не оставят ваших посетителей равнодушними.</p>
                </div>

                <div class="sub"></div>
            </a>



        </div>
    </div>
</div>

<div class="projects max-width desktop">
    <div class="projects_content grid">
        <div class="left projects_sticky">
            <div class="projects_sticky_inner">
                <p>Портфолио</p>
                <h3>Наши последние творения для Вашего ознакомления</h3>
                <a href="<?= Url::to(['/site/portfolio']) ?>" class="btn flex"><span class="flex"></span>
                    <p>Смотреть все проекты</p>
                </a>
            </div>
        </div>
        <div class="right">
            <div class="projects_content_items flex">

                <?php foreach ($portfolio as $key => $item) : ?>
                    <a href="<?= $item->url ?>" class=" item cursor-hover">
                        <img src="<?= Url::to([$item->img]) ?>" alt="<?= $item->title ?>">

                        <div class="item_info">
                            <span><?= $item->typeItem->title ?></span>
                            <h4><?= $item->title ?></h4>
                            <p><?= $item->desc ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>



    </div>
</div>


<div class="swiper mobile">
    <div class="left projects_sticky">
        <div class="projects_sticky_inner">
            <p>Портфолио</p>
            <h3>Наши последние творения для Вашего ознакомления</h3>
            <a href="<?= Url::to(['/site/portfolio']) ?>" class="btn flex"><span class="flex"></span>
                <p>Смотреть проекты</p>
            </a>
        </div>
    </div>
    <div class="swiper-wrapper">

        <?php foreach ($portfolio as $key => $item) : ?>
            <div href="<?= $item->url ?>" class=" item cursor-hover swiper-slide">
                <img src="<?= Url::to([$item->img]) ?>" alt="<?= $item->title ?>">

                <div class="item_info">
                    <span><?= $item->typeItem->title ?></span>
                    <h4><?= $item->title ?></h4>
                    <p><?= $item->desc ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="swiper-scrollbar"></div>
</div>




<div class="main_blog move-wrap">
    <header class="">
        <h3>Последнее из блога</h3>
        <p>Несколько интересных статей написанных людьми, которые плавают в своем направлении как рыба в воде! </p>
    </header>

    <div class="items flex max-width">

        <?php foreach ($blogs as $key => $blog) : ?>
            <a href="<?= Url::to(['/blog/view', 'id' => $blog->id]) ?>" class="item js-move-item cursor-hover">
                <div>
                    <img src="<?= Url::to([$blog->img]) ?>" alt="<?= $blog->header ?>">
                </div>
                <div class="item_info">
                    <div class="billet">
                        <p><?= $blog->type->title ?></p>
                    </div>
                    <div class="head">
                        <p><?= $blog->header ?></p>
                        <p><?= $blog->author->fio ?> | <?= yii::$app->formatter->asDate($blog->date)  ?></p>
                    </div>
                    <div class="content">
                        <p><?= mb_strimwidth($blog->desc, 0, 155, "...") ?></p>
                    </div>

                </div>
            </a>
        <?php endforeach; ?>


    </div>
</div>




<div class="main_fastform">
    <div class="fastform_content flex">
        <div class="left">
            <img src="<?= Url::to(['/images/default/bg-octo.jpg']) ?>" alt="">
        </div>
        <div class="right">
            <span>Время деньги! Скорее оставляйте данные и мы Вам перезвоним.</span>
            <h4>Покорить новую вершину легко</h4>
            <div class="fastform_form flex">

                <?php $forms = ActiveForm::begin([
                    'fieldConfig' => [
                        'template' => "{input}{label}",
                        'labelOptions' => ['class' => 'placeholder transition3s'],
                        'inputOptions' => ['class' => 'input transition3s'],
                        'wrapperOptions' => ['class' => 'input transition3s'],
                        'options' => [
                            'class' => 'fastform_up'
                        ]
                    ],

                ]); ?>
                <?= $forms->field($form, 'name')->textInput(); ?>
                <?= $forms->field($form, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                    'options' => ['id' => 'another-id'],
                    'mask' => '+7 (999) 999 99 99',
                    'clientOptions' => [
                        'showMaskOnHover' => false,
                    ]
                ]); ?>
                <?= $forms->field($form, 'email')->textInput(); ?>
                <?= $forms->field($form, 'text')->textarea(); ?>
                <?= $forms->field($form, 'type')->hiddenInput(['value' => 'Общая'])->label(false); ?>

                <button type="submit" class="btn flex"><span class="flex"></span>
                    <p class="transition3s">Отправить</p>
                </button>

                <?php ActiveForm::end(); ?>

                <!-- <a href="#" class="btn flex"><span class="flex"></span>
                    <p class="transition3s">Отправить</p>
                </a> -->
            </div>
        </div>
    </div>
</div>