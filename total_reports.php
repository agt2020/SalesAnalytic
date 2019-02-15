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

    <title>مدیریت فروش(نسخه تحلیلی) - گزارش جامع</title>
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
            include 'lang/fa_total_reports.php';
        ?>
        <div class="loader"></div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2>گزارش جامع</h2>
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <input type="hidden" id="page" value="list">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $lang['LBL_EXPORT']; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="dateend">تاریخ شروع :</label>
                                    <input class="form-control" type="text" id="datestart" name="datestart">
                                </div>
                                <div class="col-lg-4">
                                    <label for="dateend">تاریخ پایان :</label>
                                    <input class="form-control" type="text" id="dateend" name="dateend">
                                </div>
                                <div class="col-lg-4">
                                    <input class="btn btn-primary hidden-print" type="button" value="نمایش گزارش" onclick="Total_Report();">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="users_table">
                                        <thead>
                                            <tr>
                                                <th><?php echo $lang['LBL_BRANCH']; ?></th>
                                                <th><?php echo $lang['LBL_DEP']; ?></th>
                                                <th><?php echo $lang['LBL_SALE_QTY']; ?></th>
                                                <th><?php echo $lang['LBL_SALE_PRICE']; ?></th>
                                                <th><?php echo $lang['LBL_REF_QTY']; ?></th>
                                                <th><?php echo $lang['LBL_REF_PRICE']; ?></th>
                                                <!--<th><?php echo $lang['LBL_BUY_QTY']; ?></th>
                                                <th><?php echo $lang['LBL_BUY_PRICE']; ?></th>
                                                <th><?php echo $lang['LBL_BUY_REF_QTY']; ?></th>
                                                <th><?php echo $lang['LBL_BUY_REF_PRICE']; ?></th>
                                                <th><?php echo $lang['LBL_TOTAL_AMOUNT']; ?></th>-->
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_list"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
    <script src="vendor/js/kamadatepicker/kamadatepicker.js"></script>
    <script src="vendor/js/total_reports.js"></script>
    <script>
        kamaDatepicker('datestart', { buttonsColor: "red" });
        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: false
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "blue"
            , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }

        kamaDatepicker('dateend', { buttonsColor: "red" });
        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: false
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "blue"
            , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
    </script>
</body>

</html>
