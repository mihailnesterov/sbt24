<?php

/** @var $this \yii\web\View */
/** @var $link string */
/** @var $paramExample string */

?>

<h2>Получен заказ № sbt24-<?= $order_id ?> от <?= $order_date ?></h2>
<p><?= $client_company ?></p>
<p><?= $client_contact ?></p>
<p><?= $client_phone ?></p>
<p><?= $client_email ?></p>
<h3>Детали заказа № sbt24-<?= $order_id ?> от <?= $order_date ?></h3>
<table>
    <tr>
        <th>№</th>
        <th>Наименование товара</th>
        <th>Цена, руб</th>
        <th>Кол-во, шт</th>
        <th>Сумма, руб</th>
    </tr>
    <?php $itemCount = $sum = $total = $count = 0; ?>
    <?php foreach ( $orderItems as $key => $item ): ?>
        <?php 
            $itemCount++;
            $sum = ($item->sum * $item->count); 
            $total += $sum;
            $count += $item->count;
        ?>
        <tr>
            <td><?= $itemCount ?></td>
            <td class="text-left"><a href="http://sbt24.ru/view?id=<?= $item->tovar->id ?>" target="_blank"><?= $item->tovar->name ?></a></td>
            <td><?= $item->sum ?></td>  
            <td><?= $item->count ?></td>
            <td><?= $sum ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
    if(strpos($total, '.')) {
        if(substr($total, -3, 1) != '.') {
            $total = round($total,2).'0';
        }
    }
    if(!strpos($total, '.')) {
        $total = $total.'.00';
    } else
    $total = round($total,2);

    $nds = round(($total / 1.2*0.2),2);
    if(strpos($nds, '.')) {
        if(substr($nds, -3, 1) != '.') {
            $nds = round($nds,2).'0';
        }
    }
    if(!strpos($nds, '.')) {
        $nds = $nds.'.00';
    }
?>
<h4>Всего наименований <?= $count ?> на сумму <?= $total ?> руб.</h4>
<hr>
<a href="http://sbt24.ru/invoice-pdf?id=<?= $order_id ?>" target="_blank" id="pdf">Скачать счет в PDF</a>