<?php
include '../utils.php';
$user = $_SESSION['Current_User'];
$access = json_decode(base64_decode($user['access']));

include 'lang/fa_nav_side_menu.php';
$menu = '<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">'.$lang['LBL_DASHBOARD'].'</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>ابوالفضل غفاری</strong>
                                    <span class="pull-left text-muted">
                                        <em>دیروز</em>
                                    </span>
                                </div>
                                <div>شعبه چالوس خارج از دسترس</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>ایمان شعاری</strong>
                                    <span class="pull-left text-muted">
                                        <em>دیروز</em>
                                    </span>
                                </div>
                                <div>سفارشات تحویل گرفته شد و به انبار منتقل شد</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>ابوالفضل غفاری</strong>
                                    <span class="pull-left text-muted">
                                        <em>دیروز</em>
                                    </span>
                                </div>
                                <div>سفارشات جدید ارسال شد با انبار هماهنگ شود</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>'.$lang['LBL_ALL_MESSAGE'].'</strong>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
               <!-- </li>-->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> پاسخ جدید
                                    <span class="pull-left text-muted small">4 دقیقه قبل</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 کاربر جدید
                                    <span class="pull-left text-muted small">12 دقیقه قبل</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> پیغام ارسال شد
                                    <span class="pull-left text-muted small">4 دقیقه قبل</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> وظیفه جدید
                                    <span class="pull-left text-muted small">4 دقیقه قبل</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> سرور مجددا راه اندازی شد
                                    <span class="pull-left text-muted small">4 دقیقه قبل</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>'.$lang['LBL_ALL_NOTIF'].'</strong>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> '.$lang['LBL_PROFILE'].'</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> '.$lang['LBL_SETTINGS'].'</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> '.$lang['LBL_EXIT'].'</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="'.$lang['LBL_SEARCH'].'">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>-->';
if (1)
{
                       $menu .= '<li>
                            <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>'.$lang['LBL_DASHBOARD'].'</a>
                        </li>';
}
else
{
    echo "شما به این صفحه دسترسی ندارید !";
    //die();
}
if ($user['is_admin'] == 1 || $access->analytics == 1)
{
                      $menu .= '<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>'.$lang['LBL_REPORTS'].'<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="total_reports.php">'.$lang['LBL_TOTAL'].'</a>
                                </li>
                                <li>
                                    <a href="top10.php">'.$lang['LBL_TOP_10'].'</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>';
}
else
{

}
if ($user['is_admin'] == 1 || $access->sales_table == 1)
{
                       $menu .= ' <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>'.$lang['LBL_SALE_TABLES'].'</a>
                        </li>';
}
else
{

}
if ($user['is_admin'] == 1 || $access->orders == 1)
{
                        $menu .= ' <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i>'.$lang['LBL_ORDERS'].'</a>
                        </li>';
}
else
{

}
if ($user['is_admin'] == 1)
{
                        $menu .= '<li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>'.$lang['LBL_SETTINGS'].'<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="settings_config.php">'.$lang['LBL_DATABASE'].'</a>
                                </li>
                                <li>
                                    <a href="branches.php">'.$lang['LBL_BRANCHES'].'</a>
                                </li>
                               <!--<li>
                                    <a href="#">'.$lang['LBL_ACCOUNTS'].'</a>
                                </li>
                                <li>
                                    <a href="#">'.$lang['LBL_INVENTORY'].'</a>
                                </li>-->
                                <li>
                                    <a href="users.php">'.$lang['LBL_USERS'].'</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>';
}
if ($user['is_admin'] == 1 || $access->branches == 1)
{
    $br_list = '';
    $branches = $db->GetBranchesList(1);
    if (sizeof($branches))
    {
        foreach ($branches as $key => $value)
        {
            $sb_br_list = '';
            $sub_branches = $db->GetBranchesChilds($value['id']);
            if (sizeof($sub_branches))
            {
                $br_list .= '<li>
                                    <a href="#">'.$value['name'].'<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">';
                foreach ($sub_branches as $key2 => $value2)
                {
                    $sb_br_list .= '<li>
                                <a href=\'branches.php?branch='.$value2['id'].'\'>'.$value2['name'].'</a>
                            </li>';
                }              
                $br_list .= $sb_br_list.'</ul>
                                    <!-- /.nav-third-level -->
                                </li>';
            }
            else
            {
                $br_list .= '<li>
                                <a href=\'branches.php?branch='.$value['id'].'\'>'.$value['name'].'</a>
                            </li>';
            }
        }
    }
            $menu .= '<li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i>'.$lang['LBL_BRANCHS'].'<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                '.$br_list.'
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>';
}
                        $menu .= '<!--<li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>'.$lang['LBL_DOCUMENTS'].'<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">'.$lang['LBL_BUY'].'</a>
                                </li>
                                <li>
                                    <a href="#">'.$lang['LBL_SALE'].'</a>
                                </li>
                            </ul>
                        </li>-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>';





