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
include('lang/fa_settings.php');

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
        ?>
        <!-- /Navigation AND SideMenu -->
        <div id="page-wrapper">
            <nav aria-label="breadcrumb" style="padding-top: 5px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">تنظیمات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">پایگاه داده</li>
                </ol>
            </nav>
            <div class="row">
            <div class="loader"></div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-cog"></i> <?php echo $lang['LBL_PANEL_HEADING']; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="POST" action="save.php">
                                <input type="hidden" name="return_page" value="settings_config">
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">آدرس :</label>
                                            <input type="text" class="form-control sql_input" name="address" id="address" value="<?php echo $config['sale_server']['address'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">پایگاه داده :</label>
                                            <input type="text" class="form-control sql_input" name="database" id="database" value="<?php echo $config['sale_server']['database'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">نام کاربری :</label>
                                            <input type="text" class="form-control sql_input" name="username" id="username" value="<?php echo $config['sale_server']['username'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sx-12">
                                        <div class="form-group">
                                            <label for="usr">رمز عبور :</label>
                                            <input type="password" class="form-control sql_input" name="password" id="password" value="<?php echo $config['sale_server']['password'];?>">
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4" style="text-align: center;">
                                        <input type="submit" name="submit" value="ذخیره" class="btn  btn-primary">
                                        <input type="button" name="button" value="تست ارتباط" class="btn  btn-success" onclick="test_connection()">
                                    </div>
                                    <div class="col-lg-4"></div>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
    </div>
    <!-- /#wrapper -->
    <!-- Global Script -->
    <?php
        include 'functions/Global_Script.php';
        echo $Global_Script;
    ?>
    <script src="js/settings_config.js"></script>
</body>

</html>
