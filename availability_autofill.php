<?php


	$currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('availability');
	if(!$table_perms[0]){ die('// Access denied!'); }

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk){
		die('// No js code available!');
	}

	switch($mfk){

		case 'route':
			if(!$id){
				?>
				$j('#amount<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `routes`.`id` as 'id', `routes`.`name` as 'name', `routes`.`time` as 'time', `routes`.`amount` as 'amount' FROM `routes`  WHERE `routes`.`id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#amount<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['amount']))); ?>&nbsp;');
			<?php
			break;


	}

?>
