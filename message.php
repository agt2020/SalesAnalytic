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

$messages = array();

$user_lable = 'به';
$disabled = '';

// USERS
$users = $db->GetUsersList();

?>
<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>پیام های سیستم</title>
    <!-- Global Style -->
    <link type="text/css" rel="stylesheet" href="css/kamadatepicker.css"/>
    <style type="text/css">
        .rtl-col {
            float: right;
        }
        #bd-next-date2, #bd-prev-date2 {
            font-size: 20px;
        }
        .tooltip > .tooltip-inner {
            font-family: Vazir;
            font-size: 12px;
            padding: 4px;
            white-space: pre;
            max-width: none;
        }
        #options-table {
            border-collapse: collapse;
            width: 100%;
        }
        #options-table td, #options-table th {
            border: 1px solid #777;
            text-align: left;
            padding: 8px;
        }
        #options-table tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
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
            include 'lang/message.php';
        ?>
        <div class="loader"></div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2>پیغام ها</h2>
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <input type="hidden" id="page" value="list">
<?php
    if ($_REQUEST['action'] == 'compose' || $_REQUEST['record'] != '')
    {?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php 
                            if ($_REQUEST['record'] != '')
                            {
                                // CURRENT USER MESSAGES
                                $messages = $db->Get_Message($_REQUEST['record']);
                                $user_lable = 'از';
                                $disabled = 'disabled';
                                $db->Read_Message($_REQUEST['record']);
                            }
                            if ($messages['title'] != '')
                            {
                                echo $messages['title'];
                            }
                            else
                            {
                                echo $lang['LBL_PANEL_TITLE'];
                            }
                            ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <lable for="send_to"><?php echo $user_lable; ?> :</lable>
                                    <select name="send_to" id="send_to" class="form-control" <?php echo $disabled; ?>>
                                        <option value="">کاربر مورد نظر را انتخاب نمایید ...</option>
                                        <?php
                                            $destination_user_id = $messages['destination_user_id'];
                                            foreach ($users as $key => $value)
                                            {
                                                if ($_SESSION['Current_User']['id'] != $value['id'])
                                                {
                                                    if ($value['id'] != $destination_user_id)
                                                    {
                                                        echo '<option selected value="'.$value['id'].'">'.$value['first_name'].' '.$value['last_name'].'</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="'.$value['id'].'">'.$value['first_name'].' '.$value['last_name'].'</option>';
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <lable for="severity">شدت :</lable>
                                    <select name="severity" id="severity" class="form-control" <?php echo $disabled; ?>>
                                        <option value="low">معمولی</option>
                                        <option value="med">مهم</option>
                                        <option value="high">ضروری</option>
                                    </select>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                            <div class="row">
                                <br>
                                <div class="col-lg-4">
                                    <lable for="title">عنوان :</lable>
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $messages['title']; ?>" <?php echo $disabled; ?>>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                            </div>
                            <div class="row">
                                <br>
                                <div class="col-lg-12">
                                    <lable for="message">متن پیام :</lable>
                                    <textarea class="form-control" name="message" id="message" <?php echo $disabled; ?>><?php
                                            if ($messages['message'] != '')
                                            {
                                                echo $messages['message'];
                                            }
                                        ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <br>
                                <div class="col-lg-4">
                                    <input type="button" class="btn btn-info" name="send" value="ارسال" onclick="send();" <?php echo $disabled; ?>>
                                    <input type="button" class="btn btn-warning" name="clean" value="پاک کردن" onclick="clean();" <?php echo $disabled; ?>>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
<?php
    }
    elseif($_REQUEST['action'] == 'list')
    {
        $messages = $db->Messages('','all');
        $status = array(0 => 'default', 1 => 'active');
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>عنوان</th>
                    <th>کاربر</th>
                    <th>تاریخ</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($messages as $key => $value)
                {
                    echo '<tr class="'.$status[$value['read_status']].'">';
                    echo '<td><a href="message.php?record='.$value['id'].'">'.$value['title'].'</a></td>';
                    echo '<td>'.$value['destination_user_name'].'</td>';
                    echo '<td>'.$value['date_entered'].'</td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    <?php
    }
?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Global Script -->
    <?php
        include 'functions/Global_Script.php';
        echo $Global_Script;
    ?>
    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="vendor/js/messages.js"></script>
</body>

</html>
