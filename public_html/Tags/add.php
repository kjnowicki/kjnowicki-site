<?php
	session_start();
	require($_SESSION['root']."/DBConn.php");
	$connection = connect();
	
	foreach($_POST['tags'] as $tag)
	{
		$sql = 'INSERT INTO `IssuesEffects` (`IssueID`, `EffectID`) VALUES ('.$_SESSION['id'].', '.$tag.');';
		$connection -> query($sql);
	}
	
	
	disconnect($connection);
    echo "<script>";
	echo "location.href='../main.php';";
	echo "</script>";
?>