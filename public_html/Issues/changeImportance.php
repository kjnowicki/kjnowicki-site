<?php
	session_start();
	require($_SESSION['root']."/DBConn.php");
	$connection = connect();
	
	$sql = 'UPDATE `Issues` SET `Important` = ((`Important` +1) MOD 2) WHERE `IssueID` = '.$_GET["id"].';';
	$connection -> query($sql);
	
	disconnect($connection);

	echo "<script>";
	echo "location.href='../main.php?ID=".$_GET['id']."';";
	echo "</script>";
?>