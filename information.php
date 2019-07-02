<?php
require_once "includes/common.php";
$bot = new Bot();
$current = 'information';
include "layout/header.php";
?>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="information.php">جميع المعلومات <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="new-info.php">إضافة معلومة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bulk-add.php">إضافة مجموعة معلومات</a>
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

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">خروج</a>
                    </li>
                </ul>
            </nav>
            <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 bg-faded">
                <div class="row">
                    <div class="col-12">
                        <h1>جميع المعلومات</h1>
                        <div class="alert alert-info">جميع المعلومات المخصصة للنشر على البوت تجدها هنا</div>
                        <?php $infos = $bot->getInfos();
                        ?>
                        <div class="table-responsive bg-white infos-table">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المعلومة</th>
                                    <th>صورة</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإرسال</th>
                                    <th>رفعت بواسطة</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; foreach ($infos as $info) : ?>
                                    <tr class="info-item">
                                        <td><?= ++$i ?></td>
                                        <td><?= $info->excerpt ?>
                                            <br>
                                            <div class="info-links">
                                                <a href="#">تعديل</a>
                                                <a href="#" class="text-danger">حذف</a>
                                            </div>
                                        </td>
                                        <td><img src="<?= $info->image ?>" width="45" height="45"></td>
                                        <td><?= ($info->sent)
                                                ? "<span class='badge badge-success'>تم الإرسال</span>"
                                                : "<span class='badge badge-warning'>في الانتظار</span>" ?></td>
                                        <td><?= $info->send_date_str ?></td>
                                        <td><?= $info->user_fullname ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php
include "layout/footer.php";
