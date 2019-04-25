<?php
session_start();

if (empty($_SESSION["username"]))
{
    header("Location: logout.php");
    die();
}

include('utils.php');
$db = new db();
$config = $db->config();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $lang['LBL_PAGE_TITLE']; ?></title>

    <!-- Global Style -->
    <?php
        include 'functions/Global_Style.php';
        echo $global_style;
    ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation AND SideMenu -->
        <?php
            include 'functions/Nav_Side_Menu.php';
            echo $menu;
            include 'lang/fa_users.php';
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php echo $lang['LBL_PANEL_HEADING'];
                        if ($_REQUEST['record'] == '' && $_REQUEST['access'] == '')
                        {
                            ?>
                            <button name="add_user_btn" id="add_user_btn" class="btn btn-success pull-left" data-toggle="modal" data-target="#add_user_modal"><?php echo $lang['LBL_LIST_ADD_USER_BTN']; ?></button>
                            <?php
                        }
                        ?>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php
                if ($_REQUEST['record'] != '')
                {
                    $user = $db->GetUser($_REQUEST['record']);
                    if ($user['status'])
                    {
                        $active = 'selected';
                        $deactive = '';
                    }
                    else
                    {
                        $active = '';
                        $deactive = 'selected';
                    }
                   ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="POST" action="save.php">
                                <input type="hidden" name="return_page" value="edit_user">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">نام کاربری :</label>
                                            <input disabled type="text" class="form-control" id="username" value="<?php echo $user['username'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">وضعیت :</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="0" <?php echo $deactive; ?>>غیر فعال</option>
                                                <option value="1" <?php echo $active; ?>>فعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">نام :</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $user['first_name'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">نام خانوادگی :</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $user['last_name'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">تلفن :</label>
                                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $user['phone'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">آدرس ایمیل :</label>
                                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $user['email'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">تاریخ ایجاد :</label>
                                            <input disabled type="text" class="form-control sql_input" id="date_entered" value="<?php echo Display_Date($user['date_entered']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">تاریخ تغییر :</label>
                                            <input disabled type="text" class="form-control sql_input" id="date_modisabled" value="<?php echo Display_Date($user['date_modified']); ?>">
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4" style="text-align: center;">
                                        <input type="submit" name="submit" value="ذخیره" class="btn  btn-primary">
                                        <input type="button" name="cancle" value="<?php echo $lang['LBL_LIST_CLOSE_BTN']; ?>" class="btn  btn-default" onclick="window.location.href = 'users.php';">
                                    </div>
                                    <div class="col-lg-4"></div>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                   <?php
                }
                elseif($_REQUEST['access'] != '')
                {
                    $user = $db->GetUser($_REQUEST['access']);
                    $access = json_decode(base64_decode($user['access']));
                    ?>
                    <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="POST" action="save.php">
                                <input type="hidden" name="return_page" value="access_user">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">دسترسی های <?php echo $user['username'];?> :</label>
                                        </div>
                                        <input type="checkbox" name="analytics" id="analytics" value="1" <?php if ($access->analytics){echo 'checked';} ?>>
                                        <label for="analytics"> تحلیل</label>
                                        <br>
                                        <input type="checkbox" name="sales_table" id="sales_table" value="1" <?php if ($access->sales_table){echo 'checked';} ?>>
                                        <label for="sales_table"> جداول فروش</label>
                                        <br>
                                        <input type="checkbox" name="orders" id="orders" value="1" <?php if ($access->orders){echo 'checked';} ?>>
                                        <label for="orders"> سفارشات</label>
                                        <br>
                                        <input type="checkbox" name="branches" id="branches" value="1" <?php if ($access->branches){echo 'checked';} ?>>
                                        <label for="branches"> شعب</label>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4" style="text-align: center;">
                                        <input type="submit" name="submit" value="ذخیره" class="btn  btn-primary">
                                        <button class="btn btn-warning" onclick="window.location.replace('users.php');">لغو </button>
                                    </div>
                                    <div class="col-lg-4"></div>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?php
                }
                else
                {
                    ?>
                        <!-- /.row -->
                        <input type="hidden" id="page" value="list">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo $lang['LBL_LIST_MANAGEMENT']; ?>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="users_table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $lang['LBL_LIST_USERNAME']; ?></th>
                                                    <th><?php echo $lang['LBL_LIST_FULL_NAME']; ?></th>
                                                    <th><?php echo $lang['LBL_LIST_EMAIL']; ?></th>
                                                    <th><?php echo $lang['LBL_LIST_ROLE']; ?></th>
                                                    <th><?php echo $lang['LBL_LIST_OPERATION']; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_list"></tbody>
                                        </table>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                    <?php
                }
            ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Modalس -->
    <div id="add_user_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                   <h4><?php echo $lang['LBL_LIST_ADD_USER_BTN']; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">نام کاربری :</label>
                                <input type="text" class="form-control" name="username" id="username" value="" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">نقش :</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="0">کاربر</option>
                                    <option value="1">مدیر</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">نام :</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">نام خانوادگی :</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">تلفن :</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">ایمیل :</label>
                                <input type="text" class="form-control" name="email" id="email" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">رمز عبور :</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">تکرار رمز عبور :</label>
                                <input type="password" class="form-control" name="repassword" id="repassword" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="save_user_btn" type="button" class="btn btn-primary" onclick="Save_User();"><?php echo $lang['LBL_LIST_SAVE_BTN']; ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['LBL_LIST_CLOSE_BTN']; ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Global Script -->
    <?php
        include 'functions/Global_Script.php';
        echo $Global_Script;
    ?>
    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <script src="vendor/js/users.js"></script>
</body>

</html>
