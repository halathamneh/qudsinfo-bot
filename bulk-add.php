<?php
require_once "includes/common.php";
$bot = new Bot();
$current = 'information';
include "includes/info-handler.php";
include "layout/header.php";
?>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 hidden-xs-down sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="information.php">جميع المعلومات <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="new-info.php">إضافة معلومة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="bulk-add.php">إضافة مجموعة معلومات</a>
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
                <h1>إضافة أكثر من معلومة</h1>
                <section>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="action" value="bulk">
                                <ul class="list-group infos-create-list p-0">
                                    <li class="list-group-item list-group-item-success">
                                        <div class="form-group col-md-auto mb-0">
                                            <strong>#</strong>
                                        </div>
                                        <div class="form-group col-md-5 mb-0">
                                            <strong>نص المعلومة</strong>
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <strong>صورة المعلومة</strong>
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <strong>تاريخ النشر</strong>
                                        </div>
                                    </li>
                                    <li class="list-group-item" data-number="1">
                                        <div class="form-group col-md-auto mb-0">
                                            <span>1</span>
                                        </div>
                                        <div class="form-group col-md-5 mb-0">
                                            <textarea class="form-control" name="content[]"
                                                      placeholder="اكتب المعلومة..."></textarea>
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <input type="file" class="form-control" name="image[]">
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <input type="text" class="form-control is-date-picker" name="send_date[]">
                                        </div>
                                    </li>
                                    <li class="list-group-item" data-number="2">
                                        <div class="form-group col-md-auto mb-0">
                                            <span>2</span>
                                        </div>
                                        <div class="form-group col-md-5 mb-0">
                                            <textarea class="form-control" name="content[]"
                                                      placeholder="اكتب المعلومة..."></textarea>
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <input type="file" class="form-control" name="image[]">
                                        </div>
                                        <div class="form-group col-md-3 mb-0">
                                            <input type="text" class="form-control is-date-picker" name="send_date[]">
                                        </div>
                                    </li>
                                </ul>
                                <div class="add-multi-btns text-left py-3 my-3">
                                    <a href="javascript:;" class="btn btn-secondary add-info-multiple"><i class="fa fa-plus"></i>إضافة أكثر من صف</a>
                                    <a href="javascript:;" class="btn btn-primary add-info-btn"><i class="fa fa-plus"></i>إضافة صف</a>
                                    <button class="btn btn-success"><i class="fa fa-save"></i>حفظ المعلومات</button>
                                    
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <img src="#" alt="#" class="info-image" style="display: none;">
                        </div>

                    </div>

                </section>
            </main>
        </div>
    </div>
<?php
if ( ! function_exists('scripts') ) {
    function scripts() { ?>
        <script src="assets/js/bulk-add-info.js"></script>
    <?php }
}

include "layout/footer.php";
