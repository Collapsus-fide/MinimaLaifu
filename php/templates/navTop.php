<?php
$page->appendToHead(<<<HTML
<link rel="stylesheet" type="text/css" href="css/navTop.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">

<script src="js/navTop.js"></script>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
<script src="bootstrap/js/bootstrap.esm.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>

<script src="jquery/jquery-3.6.0.min.js"></script>

HTML
);
$page->appendContent(<<<HTML
<header class="header">
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container"><a href="#" class="navbar-brand text-uppercase font-weight-bold">MinimaLaifu</a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="#" class="nav-link text-uppercase font-weight-bold">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Gallery</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">commissions</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
HTML
);