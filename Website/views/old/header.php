<!DOCTYPE HTML>
<!--
    Retrospect by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<head>
    <title>Adventure Time</title>
    <!-- <meta charset="utf-8" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <base href="/apache2-default/">
    <!--[if lte IE 8]>
    <script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/stylesheets/main.css"/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/stylesheets/ie8.css"/><![endif]-->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/stylesheets/ie9.css"/><![endif]-->
</head>
<body>
<!-- Header -->
<header id="header">
    <h1><a href="home">SomethingCorp</a></h1>
    <a href="#nav">Menu</a>
</header>
<!-- Nav -->
<nav id="nav">
    <ul class="links">
        <li><a href="home">Home</a></li>
        <li><a href="tags">Tags</a></li>
    </ul>
    <?php
    if (isset($_SESSION['logged'])) {
       require $_SESSION['role'] . '-menu.php';
    } else require 'user-menu.html';
    ?>
    <h1>Quick search</h1>
    <form action="search" method="POST">
        <input name='searchtags' placeholder="" type="text"/>
        <input type="hidden" value="keyword" name="searchtype" id="Search"/>
        <br>
        <input class="button alt fit" type="submit" value="searchpost" name="search" id="Search"/>
    </form>
</nav>
<?php
    if(isset($data['info'])){
        echo "<p>".$data['info']."</p>";
    }

?>



