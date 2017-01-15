<?php
include("config.php");

function labelStatus($status){
	if ($status == 0){
		return "<span class='label label-danger'>Inactive</span>";
	}else if($status == 1){
		return "<span class='label label-success'>Active</span>";
	}
}

function isSelectedA($status){
	if ($status == 0){
		return "";
	}else if($status == 1){
		return "selected='selected'";
	}
}

function isSelectedI($status){
	if ($status == 1){
		return "";
	}else if($status == 0){
		return "selected='selected'";
	}
}

function labelAllowed($status){
	if ($status == 0){
		return "<span class='label label-danger'>Forbidden</span>";
	}else if($status == 1){
		return "<span class='label label-success'>Allowed</span>";
	}
}

function labelRecords($period){
	if ($period == "24h"){
		return "Records from today (Last 24 hours)";
	}else if ($period == "yesterday"){
		return "Records from yesterday";
	}else if ($period == "week"){
		return "Records from last week";
	}else if ($period == "month"){
		return "Records from last month";
	}else if ($period == "year"){
		return "Records from last year";
	}else if ($period == "alltime"){
		return "Records of all time";
	}
}
?>