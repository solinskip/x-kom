<?php

require_once 'PHP-Scripts/getPage.php';
$content = getPage('https://www.x-kom.pl');
require_once 'PHP-Scripts/patern.php';
require_once 'PHP-Scripts/database.php';

//$content1 = fopen('template-site-product.txt', 'r+');
//$content = fread($content1, filesize("template-site-product.txt"));
//fclose($content1);
//$content = iconv("ISO-8859-2", "UTF-8", $content);

$mOldPrice = str_replace(',', '.', $mOldPrice['old_price'][0]);
$mNewPrice = str_replace(',', '.', $mNewPrice['new_price'][0]);

if (!isset($mSoldInfo['sold_info'][0])) {
    $mLeft = str_replace(',', '.', $mLeft['left'][0]);
    $mSold = str_replace(',', '.', $mSold['sold'][0]);
    $mRatio = round($mSold / ($mSold + $mLeft) * 100);
}

$tQuery = $db->prepare('SELECT * FROM sold_product');
$tQuery->execute();
$tResults = $tQuery->fetchAll();
$i = 1;

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <title>X-kom - offer</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script type="text/javascript" src="script.js"></script>
    <script src="jQuery/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="text-center display-4">Aktualna oferta</div>
            <div class="text-center my-3"><img src="<?= $mPhoto['photo'][0] ?>"></div>
            <div class="text-center h5"><?= $mNname['name'][0] ?></div>
            <div class="pt-4 text-center">
                <div class="d-inline pt-2 pr-2 text-right old-price align-text-bottom"><?= $mOldPrice ?> zł</div>
                <div class="d-inline new-price"><?= $mNewPrice ?> zł</div>
            </div>
            <div class="save h4 text-center pt-4">
                Oszczędzasz <?= str_replace(' ', '', $mOldPrice) - str_replace(' ', '', $mNewPrice) ?> zł
            </div>
            <?php if (isset($mSoldInfo['sold_info'][0])) : ?>
                <div class="h3 text-center pt-3"><?= $mSoldInfo['sold_info'][0]; ?></div>
            <?php else : ?>
                <div class="row mt-4">
                    <div class="col-md-3 text-right h5 px-0">Sprzedano: <?= $mSold ?></div>
                    <div class="col-md-6">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar" style="width: <?= $mRatio ?>%;"><?= $mRatio ?>%</div>
                        </div>
                    </div>
                    <div class="col-md-3 h5 px-0">Pozostało: <?= $mLeft ?></div>
                </div>
            <?php endif; ?>
            <div id="clock" class="text-center">
                <div class="text-clock">Do kolejnej promocji pozostało:</div>
                <div id="hh" class="d-inline number"></div>
                <div class="d-inline dot">:</div>
                <div id="mm" class="d-inline number"></div>
                <div class="d-inline dot">:</div>
                <div id="ss" class="d-inline number"></div>
            </div>
        </div>
        <div class="col-md-8 mx-0 px-0">
            <div class="text-center display-4 mb-3">Poprzednie oferty</div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nazwa</th>
                    <th>Zdjęcie</th>
                    <th>Stara cena</th>
                    <th>Nowa cena</th>
                    <th>Rabat</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tResults as $tResult) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $tResult['name'] ?></td>
                        <td class="pl-4 photo" style="position: relative">
                            <i class="far fa-image fa-2x"></i><img width="250px" style="display: none" src="<?= $tResult['photo'] ?>">
                        </td>
                        <td><?= $tResult['old_price'] ?> zł</td>
                        <td><?= $tResult['new_price'] ?> zł</td>
                        <td><?= $tResult['old_price'] - $tResult['new_price'] ?> zł</td>
                        <td><?= $tResult['date'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>