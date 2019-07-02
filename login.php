<?php
include "includes/common.php";
include "includes/usershandler.php";
include "layout/header.php";
?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-main">
                    <div class="card-block">
                        <h1>تسجيل الدخول</h1>
                        <?php if ( isset($u_errs) && count($u_errs) > 0 ) : ?>
                            <ul class="list-group pr-0 mb-3 w-50 mx-auto">
                                <?php foreach ($u_errs as $u_err) : ?>
                                    <li class="list-group-item list-group-item-danger">
                                        <i class="fa fa-times-circle ml-2"></i><?= $u_err ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <form action="<?= $_SERVER['REQUEST_URI'] ?>" class="pt-2" method="post"
                              id="user-logn-form">
                            <input type="hidden" name="action" value="user_login">
                            <div class="container">
                                <div class="form-group row">
                                    <label for="uname" class="form-control-label col-md-4">اسم المستخدم:</label>
                                    <input type="text" class="form-control col-md-8" id="uname" name="uname"
                                           value="<?= $uname ?>">
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="form-control-label col-md-4">كلمة المرور:</label>
                                    <input type="password" class="form-control col-md-8" id="password" name="password">
                                </div>
                            </div>
                            <div class="form-group text-left">
                                <button class="btn btn-primary">تسجيل الدخول</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "layout/footer.php";
