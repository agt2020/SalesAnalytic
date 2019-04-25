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
            include 'lang/fa_refounded_invoices.php';
        ?>
        <div class="loader"></div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                	<br><b>
                <?php
                	echo $lang['LBL_PANEL_HEADING'];
            	?>
                    </b><h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div> 
            <div class="panel panel-default">
				<div class="panel-heading"><?php echo $lang['LBL_PANEL_HEADING']; ?></div>
				<div class="panel-body">
                    <div class="col-lg-3">
                        <select id="date_select" class="form-control" onchange="Show_Refound_Invoices()">
                            <?php echo Last_7_Days(); ?>
                        </select>
                    </div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>شعبه</th>
								<th>تعداد فاکتور</th>
								<th>تاریخ</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php
								$result = $db->Get_NUMBEROF_REFOUNDED_INVOICE();
                                $sum = 0;
								foreach ($result as $key => $value)
								{
									echo '<tr>';
									echo '<td>'.$value['name'].'</td>';
									echo '<td>'.$value['result'].'</td>';
									echo '<td>'.$value['date_start'].'</td>';
									echo '</tr>';
									$date_start = $value['date_start'];
									$sum += (int)$value['result'];
								}
								echo '<tr>';
								echo '<td>مجموع</td>';
								echo '<td>'.$sum.'</td>';
								echo '<td>'.$date_start.'</td>';
								echo '</tr>';
							?>
						</tbody>
					</table>
				</div>
			</div>            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Modalس -->
    <!-- Global Script -->
    <?php
        include 'functions/Global_Script.php';
        echo $Global_Script;
    ?>
    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="vendor/js/invoices.js"></script>
</body>

</html>
