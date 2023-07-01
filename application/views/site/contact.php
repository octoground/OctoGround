<?php
\app\assets\ContactAsset::register($this);

use yii\helpers\Url;

$this->title = 'О нас';

$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->title]);
$this->registerMetaTag(['name' => 'og:url', 'content' =>  'https://octoground.ru/site/about']);
$this->registerMetaTag(['name' => 'og:description', 'content' => 'Немного о нас. Мы команда амбициозных профессионалов нацеленных на результат.']);
$this->registerMetaTag(['name' => 'og:image', 'content' => Url::to(['/images/default/bg-octo.jpg'])]);



$this->registerMetaTag(
    ['name' => 'description', 'content' =>  'Создание и продвижение сайтов - Digital-agency OctoGround - создаем и продвигаем современные и продающие сайты. Звоните +7 (922) 777-45-46']
);
?>

<div class="contact top">
    <div class="contact_main">

        <div class="contact_container flex">
            <div>
                <h1>Немного о нас</h1>
            </div>

            <ul>
                <li><a class="anchor" href="#teem">Команда</a></li>
                <li><a class="anchor" href="#advantages">Преимущества</a></li>
                <li><a class="anchor" href="#process">Процесс работы</a></li>
            </ul>
        </div>
        <div class="bg"></div>
    </div>


    <div class="teem max-width" id="teem">

        <div class="teem_container flex">
            <div class="left">
                <div class="teem_stiky_inner">
                    <h3>Наша команда</h3>
                    <p>Мы команда амбициозных профессионалов нацеленных на результат.</p>
                    <p>Каждый наш проект мы считаем произведением искусства и как настощие художники вкладываем всю душу и силы при работе и гордимся выполненным результатом!</p>
                    <p>Сотрудничая с нами вы выбираете качество и надежность за приемлемый бюджет.</p>
                </div>
            </div>

            <div class="right">


                <div class="flex">
                    <div class="teem_member" data-user-id="<?= $teems['0']->id ?>">
                        <div class="img_hover">
                            <img src="<?= Url::to([$teems['0']->img]) ?>" alt="<?= $teems['0']->fio ?>">
                        </div>
                        <div>
                            <p><?= $teems['0']->job->title ?></p>
                            <span><?= $teems['0']->fio ?></span>
                        </div>
                    </div>
                    <div class="teem_member" data-user-id="<?= $teems['1']->id ?>">
                        <div class="img_hover">
                            <img src="<?= Url::to([$teems['1']->img]) ?>" alt="<?= $teems['1']->fio ?>">
                        </div>

                        <div>
                            <p><?= $teems['1']->job->title ?></p>
                            <span><?= $teems['1']->fio ?></span>
                        </div>
                    </div>
                </div>

                <div class="grid">
                    <div class="teem_member" data-user-id="<?= $teems['2']->id ?>">
                        <div class="img_hover">
                            <img src="<?= Url::to([$teems['2']->img]) ?>" alt="<?= $teems['2']->fio ?>">
                        </div>

                        <div>
                            <p><?= $teems['2']->job->title ?></p>
                            <span><?= $teems['2']->fio ?></span>
                        </div>
                    </div>
                    <div class="teem_member" data-user-id="<?= $teems['3']->id ?>">
                        <div class="img_hover">
                            <img src="<?= Url::to([$teems['3']->img]) ?>" alt="<?= $teems['3']->fio ?>">
                        </div>

                        <div>
                            <p><?= $teems['3']->job->title ?></p>
                            <span><?= $teems['3']->fio ?></span>
                        </div>
                    </div>
                    <div class="teem_member" data-user-id="<?= $teems['4']->id ?>">
                        <div class="img_hover">
                            <img src="<?= Url::to([$teems['4']->img]) ?>" alt="<?= $teems['4']->fio ?>">
                        </div>

                        <div>
                            <p><?= $teems['4']->job->title ?></p>
                            <span><?= $teems['4']->fio ?></span>
                        </div>
                    </div>
                </div>


                <div class="teem_info transition3s">
                    <div class="flex"></div>
                    <div id="cursor">
                        <p>
                            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="advantages" id="advantages">
        <div class="max-width flex">
            <div class="left">
                <h3>Почему стоит выбрать именно нас?</h3>

                <div class="advantage">
                    <p>
                        <span>
                            <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.859619 7.1723L6.67892 11.6277" stroke="#FFE425" stroke-width="2" />
                                <line x1="14.9753" y1="0.622419" x2="5.78266" y2="12.1821" stroke="#FFE425" stroke-width="2" />
                            </svg>
                        </span>
                        Демократичные цены.
                    </p>
                </div>
                <div class="advantage">
                    <p>
                        <span>
                            <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.859619 7.1723L6.67892 11.6277" stroke="#FFE425" stroke-width="2" />
                                <line x1="14.9753" y1="0.622419" x2="5.78266" y2="12.1821" stroke="#FFE425" stroke-width="2" />
                            </svg>
                        </span>
                        Приятные бонусы.
                    </p>
                </div>
                <div class="advantage">
                    <p>
                        <span>
                            <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.859619 7.1723L6.67892 11.6277" stroke="#FFE425" stroke-width="2" />
                                <line x1="14.9753" y1="0.622419" x2="5.78266" y2="12.1821" stroke="#FFE425" stroke-width="2" />
                            </svg>
                        </span>
                        Мы следуем вырожению: “Время - деньги”.
                    </p>
                </div>
                <div class="advantage">
                    <p>
                        <span>
                            <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.859619 7.1723L6.67892 11.6277" stroke="#FFE425" stroke-width="2" />
                                <line x1="14.9753" y1="0.622419" x2="5.78266" y2="12.1821" stroke="#FFE425" stroke-width="2" />
                            </svg>
                        </span>
                        В разработке проектов мы используем современные технологии и методы.
                    </p>
                </div>
                <div class="advantage">
                    <p>
                        <span>
                            <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.859619 7.1723L6.67892 11.6277" stroke="#FFE425" stroke-width="2" />
                                <line x1="14.9753" y1="0.622419" x2="5.78266" y2="12.1821" stroke="#FFE425" stroke-width="2" />
                            </svg>
                        </span>
                        Профессионалы в своем деле.
                    </p>
                </div>
                <a href="#connect" class="btn flex connect" data-effect="mfp-move-horizontal" data-type="Общая">
                    <span class="flex"></span>
                    <p>Связаться с нами</p>
                </a>
            </div>
            <div class="right flex">
                <img src="<?= Url::to(['/images/default/bg-octo.jpg']) ?>" alt="">
                <img src="<?= Url::to(['/images/default/bg-octo.jpg']) ?>" alt="">
            </div>
        </div>
    </div>
</div>

<div class="process max-width" id="process">
    <div class="process_header">
        <h3>Процесс разработки</h3>
        <p>*Процессы могут отличаться в зависимости от вашего бюджета и необходимости выполнения.</p>
    </div>
    <div class="process_content">

        <div class="process_item flex">
            <div class="left">
                <p>Анализ конкурентов</p>
                <span>Изучаем сильные и слабые стороны ваших конкурентов. Ведь как "дурак учится на своих ошибках, а умный на чужих" - Теодор Рузвельт. </span>
            </div>
            <div class="right flex">
                <p>01</p>
            </div>
        </div>

        <div class="process_item flex">
            <div class="left">
                <p>Разрабатываем сайт</p>
                <span>На основе анализа конкурентов мы разработает продукт, который будет продуман и адаптирован под основную массу ваших посетителей.</span>
            </div>
            <div class="right flex">
                <p>02</p>
            </div>
        </div>
        <div class="process_item flex">
            <div class="left">
                <p>Работа над SEO</p>
                <span>Данный этап необходим для привлечения органического трафика. Ведь эта аудитория максимально расположена к взаимодействию с вами.</span>
            </div>
            <div class="right flex">
                <p>03</p>
            </div>
        </div>
        <div class="process_item flex">
            <div class="left">
                <p>Разрабатываем стратегию и запускаем рекламную кампанию</p>
                <span>После комплекса мероприятий по продвижению у ваших потенциальных клиентов не будет и шанса пройти мимо!</span>
            </div>
            <div class="right flex">
                <p>04</p>
            </div>
        </div>
        <div class="process_item flex">
            <div class="left">
                <p>Ведение вашего проекта</p>
                <span>Каждый месяц будем следить за тем, чтобы функционал, дизайн и юзибилити полностью соответствовали современным тенденциям.</span>
            </div>
            <div class="right flex">
                <p>05</p>
            </div>
        </div>


    </div>
</div>