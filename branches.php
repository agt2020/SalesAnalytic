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
<html lang="fa">

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
            include 'lang/fa_branches.php';
        ?>
        <div class="loader"></div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                <?php
                if ($_REQUEST['record'] == '' && $_REQUEST['branch'] == '')
                {
                    echo $lang['LBL_PANEL_HEADING'];
                    ?>
                    <h1 class="page-header">
                        <button name="add_user_btn" id="add_user_btn" class="btn btn-success pull-left" data-toggle="modal" data-target="#add_user_modal"><?php echo $lang['LBL_LIST_ADD_BRANCH_BTN']; ?></button>
                    </h1>
                <?php
                }?>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php
                if ($_REQUEST['branch'] != '')
                {
                    $branch = $db->GetBranch($_REQUEST['branch']);
                    ?>
                    <input id="page" value="branch_dashboard" type="hidden">
                    <input id="record" value="<?php echo $_REQUEST['branch']; ?>" type="hidden">
                    <h1 class="page-header">
                        شعبه <?php echo $branch['name'];?>
                    </h1>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> نمودار روند فروش
                            <div class="pull-left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        عملیات
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">تازه سازی</a>
                                        </li>
                                        <li><a href="#">تغییر بازه</a>
                                        </li>
                                        <li><a href="#">بستن</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">تنظیمات</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> موجودی محصول
                                </div>
                                <div class="panel-body">
                                    <div id="morris-donut-chart"></div>
                                    <a href="#" class="btn btn-default btn-block">جزییات</a>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                elseif ($_REQUEST['record'] != '')
                {
                    $branch = $db->GetBranch($_REQUEST['record']);
                    if ($branch['status'] == 'Active')
                    {
                        $active = 'selected';
                        $deactive = '';
                    }
                    elseif($branch['status'] == 'Inactive')
                    {
                        $active = '';
                        $deactive = 'selected';
                    }
                   ?>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="POST" action="save.php">
                                <input type="hidden" name="return_page" value="edit_branch">
                                <input type="hidden" name="id" value="<?php echo $branch['id']; ?>">
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">نام شعبه :</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $branch['name'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">وضعیت :</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="Inactive" <?php echo $deactive; ?>>غیر فعال</option>
                                                <option value="Active" <?php echo $active; ?>>فعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">آدرس :</label>
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $branch['address'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">پایگاه داده :</label>
                                            <input type="text" class="form-control" name="database" id="database" value="<?php echo $branch['db_name'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">نام کاربری :</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $branch['username'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">رمز عبور :</label>
                                            <input type="password" class="form-control" name="password" id="password" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">تاریخ ایجاد :</label>
                                            <input disabled type="text" class="form-control sql_input" id="date_entered" value="<?php echo Display_Date($branch['date_entered']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">تاریخ تغییر :</label>
                                            <input disabled type="text" class="form-control sql_input" id="date_modisabled" value="<?php echo Display_Date($branch['date_modified']); ?>">
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4" style="text-align: center;">
                                        <input type="submit" name="submit" value="ذخیره" class="btn  btn-primary">
                                        <input type="button" name="cancle" value="<?php echo $lang['LBL_LIST_CLOSE_BTN']; ?>" class="btn  btn-default" onclick="window.location.href = 'branches.php';">
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
                                                    <th><?php echo $lang['LBL_LIST_BRANCHNAME']; ?></th>
                                                    <th><?php echo $lang['LBL_LIST_PARENT']; ?></th>
                                                    <th><?php echo $lang['LBL_LIST_ADDRESS']; ?></th>
                                                    <th><?php echo $lang['LBL_LIST_STATUS']; ?></th>
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
                                <label for="usr">نام شعبه :</label>
                                <input type="text" class="form-control" name="name" id="name" value="" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">ماهیت شعبه :</label>
                                <select name="is_parent" id="is_parent" class="form-control" onchange="Parent_List();">
                                    <option value="0">شعبه</option>
                                    <option value="1">شعبه مادر</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">آدرس :</label>
                                <input type="text" class="form-control" name="address" id="address" value="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">پایگاه داده :</label>
                                <input type="text" class="form-control" name="database" id="database" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">نام کاربری :</label>
                                <input type="text" class="form-control" name="username" id="username" value="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12">
                            <div class="form-group">
                                <label for="usr">رمز عبور :</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sx-12" id="parent_name_section">
                            <div class="form-group">
                                <label for="usr">نام والد :</label>
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="blank">انتخاب کنید ... </option>
                                    <?php
                                        // GET PARENT BRANCHES
                                        $branches = $db->GetBranchesList(1);
                                        if (sizeof($branches))
                                        {
                                            foreach ($branches as $key => $value)
                                            {
                                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sx-12" style="display: none;">
                            <div class="form-group">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="save_user_btn" type="button" class="btn btn-primary" onclick="Save_Branch();"><?php echo $lang['LBL_LIST_SAVE_BTN']; ?></button>
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

    <script src="vendor/js/branches.js"></script>
</body>

</html>
