<?php
declare(strict_types=1);
require_once 'php/class/WebPage.class.php';

$page = new WebPage('MinimaLaifu');
$page->appendToHead(<<<HTML
<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>index</title>
HTML
);

include("php/templates/navTop.php");