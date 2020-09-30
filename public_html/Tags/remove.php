<?php
	session_start();
	require_once($_SESSION['root'].'/DBconn.php');
	$connection = connect();
	

	$sql = 'DELETE FROM `IssuesEffects` WHERE `IssueID` = '.$_SESSION['id'].' AND `EffectID` = '.$_GET['id'].';';
	$connection -> query($sql);

	disconnect($connection);

echo <<<END
		<script>
			location.href='../main.php';
		</script>
END
?>