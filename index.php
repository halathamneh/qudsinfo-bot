<?php
require_once "includes/common.php";
$bot = new Bot();
$current = 'home';
include "layout/header.php";
?>

    <div class="container-fluid">
    <div class="row">
    <nav class="col-sm-3 col-md-2 hidden-xs-down sidebar">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">نبذة سريعة <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">تقارير</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">إحصاءات</a>
            </li>
        </ul>
        <hr>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">إرسال رسالة</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">إرسال معلومة</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">إرسال ألبوم</a>
            </li>
        </ul>

    </nav>
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-1 bg-faded">

        <section class="row text-center placeholders">
            <div class="col-md-3 col-sm-6 placeholder ph-blue">
                <div class="content">
                    <h4><i class="fa fa-check mb-2 d-block"></i>تم إرساله</h4>
                    <div class="ph-data"><span><?= $bot->getSentCount() ?></span></div>

                    <div class="text-muted">عدد المعلومات التي تم إرسالها</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 placeholder ph-red">
                <div class="content">
                    <h4><i class="fa fa-hourglass-half mb-2 d-block"></i>في الانتظار</h4>
                    <div class="ph-data"><span><?= $bot->getWaitingCount() ?></span></div>
                    <span class="text-muted">المعلومات في انتظار الإرسال</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 placeholder ph-green">
                <div class="content">
                    <h4><i class="fa fa-th mb-2 d-block"></i>جميع المعلومات</h4>
                    <div class="ph-data"><span><?= $bot->getInfosCount() ?></span></div>
                    <span class="text-muted">جميع المعلومات المرفوعة على الموقع</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 placeholder ph-orange">
                <div class="content">
                    <h4><i class="fa fa-users mb-2 d-block"></i>المشتركين</h4>
                    <div class="ph-data"><span><?= $bot->getSubscribersCount() ?></span></div>
                    <span class="text-muted">عدد المشتركين في البوت</span>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-md-6 col-sm-12 dashboard-block">
                <div class="dashboard-block-content">
                    <h3 class="text-success">تم إرسالها مؤخراً</h3>
                    <?php $latestSent = $bot->getSent(3); ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المعلومة</th>
                                <th>تاريخ الإرسال</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0;foreach ($latestSent as $info) : ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= substrwords($info->content, 75) ?></td>
                                    <td><?= $info->send_date_str ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 dashboard-block">
                <div class="dashboard-block-content">
                    <h3 class="text-warning">المعلومات القادمة</h3>
                    <?php $nextInfos = $bot->getWaiting(3); ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المعلومة</th>
                                <th>تاريخ الإرسال</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; foreach ($nextInfos as $info) : ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= substrwords($info->content, 75) ?></td>
                                    <td><?= $info->send_date_str ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div></div>

<?php include "layout/footer.php";