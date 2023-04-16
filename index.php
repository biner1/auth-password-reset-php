<?php session_start(); 
require_once 'config/app.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php require('views/layout/header.php'); ?>
</head>

<body>
    

    <?php require('views/layout/navbar.php'); ?>

    <main>

        <?php require_once('config/router.php'); ?>

    </main>

    <?php require('views/layout/footer.php'); ?>

</body>
</html>

