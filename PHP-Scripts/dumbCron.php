<?php

/** @var array $mName */
/** @var array $mPhoto */

require 'database.php';
require 'getPage.php';

$hour = date('H:i:s');
$content = getPage('https://www.x-kom.pl');
require 'pattern.php';

$mOldPrice = str_replace(',', '.', $mOldPrice['old_price'][0]);
$mOldPrice = str_replace(' ', '', $mOldPrice);

$mNewPrice = str_replace(',', '.', $mNewPrice['new_price'][0]);
$mNewPrice = str_replace(' ', '', $mNewPrice);

/** save to database old offer */
if (($hour >= '09:40:00' && $hour <= '09:50:00') || ($hour >= '21:40:00' && $hour <= '21:50:00')) {
    $query = $db->prepare(/** @lang MySQL */ 'INSERT INTO sold_product VALUES (NULL, :name, :photo, :old_price, :new_price, :date)');
    $query->bindValue(':name', $mName['name'][0], PDO::PARAM_STR);
    $query->bindValue(':photo', $mPhoto['photo'][0], PDO::PARAM_STR);
    $query->bindValue(':old_price', $mOldPrice, PDO::PARAM_STR);
    $query->bindValue(':new_price', $mNewPrice, PDO::PARAM_STR);
    $query->bindValue(':date', date('Y-m-d'), PDO::PARAM_STR);

    $query->execute();
}

/** send email with new offer */
if (($hour >= '09:55:00' && $hour <= '10:05:00') || ($hour >= '21:55:00' && $hour <= '22:05:00')) {
$to = 'solinski.mfs@gmail.com';
$subject = 'X-kom: ' . $mName['name'][0];
$headers = 'From: bot@psolinski.cba.pl' . "\r\n" .
    'Reply-To: bot@psolinski.cba.pl' . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=utf-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$message = '<div><strong>Nowa cena:</strong> ' . $mNewPrice . 'zł <strong>Stara cena:</strong> ' . $mOldPrice . 'zł</div>' .
    '<div><strong>Rabat:</strong> ' . ($mOldPrice - $mNewPrice) . 'zł</div>' .
    '<div><img src= ' . $mPhoto['photo'][0] . ' alt=""></div>';
mail($to, $subject, $message, $headers);
}