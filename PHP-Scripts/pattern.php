<?php

$patternName = "#<p class=\"product-name\">(?P<name>.+)<\/p>#";
$patternOldPrice = "#<div class=\"old-price\">(?P<old_price>[0-9 ]+,[0-9]{2}).+<\/div>#";
$patternNewPrice = "#<div class=\"new-price\">(?P<new_price>[0-9 ]+,[0-9]{2}).+<\/div>#";
$patternSoldInfo = "#<div class=\"sold-info\">(?P<sold_info>\w+)<\/div>#";
$patternPhoto = "#<img class=\"img-responsive center-block\" src=\"(?P<photo>.+\.PNG)#";
$patternLeft = "#<div class=\"pull-left\">pozostało <span class=\"gs-quantity\"<strong>(?P<left>.+)<\/strong>#";
$patternSold = "#<div class=\"pull-right\">sprzedano <span class=\"gs-quantity\"<strong>(?P<sold>.+)<\/strong>#";

preg_match_all($patternName, $content, $mName);
preg_match_all($patternOldPrice, $content, $mOldPrice);
preg_match_all($patternNewPrice, $content, $mNewPrice);
preg_match_all($patternSoldInfo, $content, $mSoldInfo);
preg_match_all($patternPhoto, $content, $mPhoto);
preg_match_all($patternLeft, $content, $mLeft);
preg_match_all($patternSold, $content, $mSold);