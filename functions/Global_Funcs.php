<?php
include_once("PersianCalendar.php");
function IDC()
{
	$ID = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)); 
	return $ID;
}

function Display_Date($date)
{
	$format = "Y-m-d H:i:s";
	$date_value = $date;
	$DateTime = new DateTime($date_value, new DateTimeZone("UTC"));
	$DateTime->setTimezone(new DateTimeZone("Asia/Tehran"));
	$date = $DateTime->format($format);

	$DATE_TIME = explode(' ', $date);
	$DATE = explode('-', $DATE_TIME[0]);
	$DATE = gregorian_to_mds($DATE[0],$DATE[1],$DATE[2]);
	return $DATE[0].'/'.$DATE[1].'/'.$DATE[2].' '.$DATE_TIME[1];
}

function Fa_Today($sign,$int)
{
	$format = "Y-m-d H:i:s";
	$date_value = date('Y-m-d');
	if ($sign != '' && $int != '')
	{
		$date_value = date('Y-m-d',strtotime($date_value . $sign.$int." days"));
	}
	$DateTime = new DateTime($date_value, new DateTimeZone("UTC"));
	$DateTime->setTimezone(new DateTimeZone("Asia/Tehran"));
	$date = $DateTime->format($format);

	$DATE = Display_Date($date);
	$DATE = explode(' ', $DATE);
	$fa_date = explode('/', $DATE[0]);
	if (strlen($fa_date[1]) == 1)
	{
		$fa_date[1] = '0'.$fa_date[1];
	}
	if (strlen($fa_date[2]) == 1)
	{
		$fa_date[2] = '0'.$fa_date[2];
	}
	$DATE = $fa_date[0].'/'.$fa_date[1].'/'.$fa_date[2];
	return $DATE;
}

function Last_7_Days()
{
	$option = '';
	for ($i=0; $i < 7; $i++)
	{
		$option .= '<option val="'.Fa_Today('-',$i).'">'.Fa_Today('-',$i).'</option>';
	}
	return $option;
}