<?php

require 'database.php';

$name = $_POST['name'];
$query = $db->prepare(/** @lang MySQL */ 'SELECT photo FROM sold_product WHERE name = :name');
$query->execute(['name' => $name]);

$url = $query->fetch();

echo json_encode(['url' => $url]);