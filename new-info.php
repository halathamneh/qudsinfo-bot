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
                        <a class="nav-link active" href="new-info.php">إضافة معلومة</a>
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
                <h1>معلومة جديدة</h1>
                <section>

                    <div class="row">
                        <div class="col-md-8">
                            <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post"
                                  enctype="multipart/form-data">
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label for="content" class="form-control-label">نص المعلومة</label>
                                        <textarea class="form-control" id="content" name="content" rows="10"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="image" class="form-control-label">صورة المعلومة</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="send_date" class="form-control-label">تاريخ الإرسال</label>
                                        <input type="text" class="form-control" id="send_date" name="send_date">
                                    </div>
                                    <div class="form-group col-md-12 text-left">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> حفظ
                                            المعلومة
                                        </button>
                                    </div>

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
<?php if ( ! function_exists('scripts') ) {
    function scripts() { ?>
        <script>
            $(document).ready(function () {
                function previewImage(opts) {
                    if (opts.input === undefined) {
                        console.error('Image Upload Preview: File input field is not defined!');
                        return false;
                    }
                    if (opts.target === undefined) {
                        console.error('Image Upload Preview: Target element is not defined!');
                        return false;
                    }
                    if (opts.isBackground === undefined) opts.isBackground = false;

                    if (opts.input.files && opts.input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            if (opts.isBackground)
                                $(opts.target).css('background-image', 'url(\"' + e.target.result + '\")');
                            else
                                $(opts.target).attr('src', e.target.result);
                            $(opts.target).show();
                        };

                        reader.readAsDataURL(opts.input.files[0]);
                    }
                }

                $('#image').change(function () {
                    previewImage({
                        input: this,
                        target: '.info-image'
                    });
                });
                $('#send_date').daterangepicker({
                    drops: 'up',
                    open: 'right',
                    singleDatePicker: true,
                    minDate: moment().format('DD/MM/YYYY'),
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });

            });
        </script>
    <?php }
}
include "layout/footer.php";
