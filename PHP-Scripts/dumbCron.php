<?php

require 'database.php';
require 'getPage.php';

$hour = date('H:i:s');
$content = getPage('https://www.x-kom.pl');
require 'patern.php';

$mOldPrice = str_replace(',', '.', $mOldPrice['old_price'][0]);
$mNewPrice = str_replace(',', '.', $mNewPrice['new_price'][0]);

if (($hour >= '09:40:00' && $hour <= '09:50:00') || ($hour >= '21:40:00' && $hour <= '21:50:00')) {
    $query = $db->prepare('INSERT INTO sold_product VALUES (NULL, :name, :photo, :old_price, :new_price, :date)');
    $query->bindValue(':name', $mNname['name'][0], PDO::PARAM_STR);
    $query->bindValue(':photo', $mPhoto['photo'][0], PDO::PARAM_STR);
    $query->bindValue(':old_price', $mOldPrice, PDO::PARAM_STR);
    $query->bindValue(':new_price', $mNewPrice, PDO::PARAM_STR);
    $query->bindValue(':date', date('Y-m-d'), PDO::PARAM_STR);

    $query->execute();
}

if (($hour >= '09:55:00' && $hour <= '10:05:00') || ($hour >= '21:55:00' && $hour <= '22:05:00')) {
    $to = 'solinski.mfs@gmail.com';
    $subject = 'X-kom: ' . $mNname['name'][0];
    $message = 'Nowa cena: ' . $mNewPrice . 'zl Stara cena: ' . $mOldPrice . 'zl
Rabat: ' . ($mOldPrice - $mNewPrice) . 'zl';
    $headers = 'From: bot@psolinski.cba.pl' . "\r\n" .
        'Reply-To: bot@psolinski.cba.pl' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}