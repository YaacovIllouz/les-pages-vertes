<?php

	$colname_rs_mod_logo = "-1";
	if (isset($_GET['id'])) {
		$colname_rs_mod_logo = $_GET['id'];
	}
	mysql_select_db($database_annuaire, $annuaire);
	$query_rs_mod_logo = sprintf("SELECT Id_ese, sigle, image FROM entreprise WHERE Id_ese = %s", GetSQLValueString($colname_rs_mod_logo, "int"));
	$rs_mod_logo = mysql_query($query_rs_mod_logo, $annuaire) or die(mysql_error());
	$row_rs_mod_logo = mysql_fetch_assoc($rs_mod_logo);
	$totalRows_rs_mod_logo = mysql_num_rows($rs_mod_logo);
?>

<article class="module width_full">
	<header>
		<h3><b>Modifier le logo de l' entreprise</b></span>  <span style="color: #090; font-size:14px;"><b> <?php echo $row_rs_mod_logo['sigle']; ?></b></h3>
	</header>
	<div class="module_content">

		<?php
			$editFormAction = $_SERVER['PHP_SELF'];
			if (isset($_SERVER['QUERY_STRING'])) {
				$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
			}

			if (isset($_POST['img_up']))
			{
				$Upload = new uploadImage(512,1500,1500,80,80,'../userfiles/image/');
				$Upload->SetExtension(".jpg;.jpeg;.gif;.png");
				$Upload->SetMimeType("image/jpg;image/gif;image/png");

				$msg = '';
				if($Upload->CheckUpload())
				{
					if($Upload->WriteFile())
					{
						$msg = "<p>image chargée avec succès</p>";
						$tableau = $Upload->GetSummary();

						$updateSQL = sprintf("UPDATE entreprise SET image=%s WHERE Id_ese=%s",
							GetSQLValueString(substr($tableau['chemin'],1), "text"),
							GetSQLValueString($_POST['Id_ese'], "int"));

						mysql_select_db($database_annuaire, $annuaire);
						$Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
						echo '<br />Logo modifié';
					}
					else
					{
						$msg = "<p>Echec 2 du transfert de l'image sur le serveur.</p>";
						$tableau = $Upload-> GetError();
						foreach ($tableau as $valeur)
						{
							$msg .= $valeur."<br />";
						}
					}
				}
				else
				{
					$msg = "<p>Echec 1 du transfert de l'image sur le serveur.</p>";
					$tableau = $Upload-> GetError();
					foreach ($tableau as $valeur)
					{
						$msg .= $valeur."<br />";
					}
				}
//$buffer .= '</infos>';
				echo $msg;
			}
		?>
		<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
			<table align="center">
				<tr valign="baseline">
					<td align="left" valign="middle" nowrap><b>Logo :</b></td>
					<td>
						<img src="../<?php echo $row_rs_mod_logo['image']; ?>" width="100" height="75">
					</td>
					<td> <input type="file" name="userfile" value="" size="32" /></td>
				</tr>
				<tr valign="baseline">
					<td nowrap align="right">&nbsp;</td>
					<td><br />
						<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
						<input type="submit" value="Valider" name="img_up" />
					</td>
				</tr>
			</table>
			<input type="hidden" name="MM_update" value="form1">
			<input type="hidden" name="Id_ese" value="<?php echo $row_rs_mod_logo['Id_ese']; ?>">
		</form>
		<p>&nbsp;</p>

		<?php
			mysql_free_result($rs_mod_logo);
		?>
	</div>
</article>