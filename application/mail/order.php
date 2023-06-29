<?php

use app\models\Product;

$prod = new Product();
?>

Имя: <?= $fio ?> <br>
Телефон: <?= $phone ?> <br>
Email: <?= $email ?> <br>
Комментарий: <?= $comment ?> <br>
Способ доставки: <?= $delivery ? 'Самовывоз' : 'Доставка' ?> <br>
Адрес доставки: <?= $address ?> <br>



<?php foreach ($products as $key => $product) : ?>
    -----------------------------------------------<br>
    Наименование: <?= $product['title'] ?> <br>
    Материал: <?= $product['material'] ?> <br>
    Кол-во: <?= $product['qty'] ?> <br>
    В наличие: <?= $product['instock'] ? 'да' : 'нет' ?> <br>
    <?php if (isset($product['color'])) : ?>
        Цвет:<?= $product['color'] ?> <br>
    <?php endif; ?>
    <?php if (isset($product['walls'])) : ?>
        Боковые стенки: <?= $prod->getWallEmail($product['walls'])->title ?> <br>
    <?php endif; ?>
    <?php if (isset($product['sizes'])) : ?>
        Размер: <?= $product['sizes'] ?> <br>
    <?php endif; ?>
    Стоимость: <?= $product['price'] ?>
    <br>
    <!-- /****************************************** */<br> -->
<?php endforeach; ?>

<p>Общее количество товаров: <?= $count ?></span></p>
<p>Общая стоимость заказа: <?= $sum ?> руб.</p>