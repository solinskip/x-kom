<?php

require 'database.php';
require 'getPage.php';

$hour = date('H:i:s');

if (($hour >= '09:40:00' && $hour <= '09:50:00') || ($hour >= '21:40:00' && $hour <= '21:50:00')) {
    $content = getPage('https://www.x-kom.pl');
    require 'patern.php';

    $mOldPrice = str_replace(',', '.', $mOldPrice['old_price'][0]);
    $mNewPrice = str_replace(',', '.', $mNewPrice['new_price'][0]);

    $query = $db->prepare('INSERT INTO sold_product VALUES (NULL, :name, :photo, :old_price, :new_price, :date)');
    $query->bindValue(':name', $mNname['name'][0], PDO::PARAM_STR);
    $query->bindValue(':photo', $mPhoto['photo'][0], PDO::PARAM_STR);
    $query->bindValue(':old_price', $mOldPrice, PDO::PARAM_STR);
    $query->bindValue(':new_price', $mNewPrice, PDO::PARAM_STR);
    $query->bindValue(':date', date('Y-m-d'), PDO::PARAM_STR);

    $query->execute();
}