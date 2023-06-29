<?php foreach ($items as $key => $item) : ?>
    <?= $this->render('_portfolio', compact('item')) ?>
<?php endforeach; ?>