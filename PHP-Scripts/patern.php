<?php

$paternName = "#<p class=\"product-name\">(?P<name>.+)<\/p>#";
$paternOldPrice = "#<div class=\"old-price\">(?P<old_price>[0-9 ]+,[0-9]{2}).+<\/div>#";
$paternNewPrice = "#<div class=\"new-price\">(?P<new_price>[0-9 ]+,[0-9]{2}).+<\/div>#";
$paternSoldInfo = "#<div class=\"sold-info\">(?P<sold_info>\w+)<\/div>#";
$paternPhoto = "#<img class=\"img-responsive center-block\" src=\"(?P<photo>.+)\"#";
$paternLeft = "#<div class=\"pull-left\">Pozostało: <strong>(?P<left>.+)<\/strong>#";
$paternSold = "#<div class=\"pull-right\">Sprzedano już: <strong>(?P<sold>.+)<\/strong>#";

preg_match_all($paternName, $content, $mNname);
preg_match_all($paternOldPrice, $content, $mOldPrice);
preg_match_all($paternNewPrice, $content, $mNewPrice);
preg_match_all($paternSoldInfo, $content, $mSoldInfo);
preg_match_all($paternPhoto, $content, $mPhoto);
preg_match_all($paternLeft, $content, $mLeft);
preg_match_all($paternSold, $content, $mSold);
