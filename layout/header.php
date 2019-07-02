<!DOCTYPE html>
<html lang="ar-jo" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/imgs/theLogo_icon.png">
    
    <title>معلومة مقدسية بوت</title>
    
    <link href="assets/css/style.min.css?4" rel="stylesheet">
</head>

<body class="bg-faded">
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse main-navbar">
    <button class="navbar-toggler navbar-toggler-left hidden-lg-up" type="button" data-toggle="collapse"
            data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?= BOT_SITE_URL ?>">
        <img src="assets/imgs/theLogo_icon.png" width="30" alt="" class="ml-2"> معلومة مقدسية بوت</a>
    <?php if($auth->isAuthenticated()) :  ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= (isset($current) && $current=='home') ? 'active' : '' ?>">
                <a class="nav-link" href="index.php">الرئيسية</a>
            </li>
            <li class="nav-item <?= (isset($current) && $current=='information') ? 'active' : '' ?>">
                <a class="nav-link" href="information.php">المعلومات <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= (isset($current) && $current=='settings') ? 'active' : '' ?>">
                <a class="nav-link" href="#">الإعدادات</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="login.php?action=logout">خروج</a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</nav>
