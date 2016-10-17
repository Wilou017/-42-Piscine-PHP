<?php

	function redirect($page)
	{
		header('Location: '.$page);
		exit();
	}

	function get($colonne = "*", $table, $cdt = false, $return = true)
	{
		global $db;

		$sql = "SELECT $colonne FROM `$table`";
		if($cdt != false)
		{
			$sql .= " WHERE ";
			foreach ($cdt as $key => $value) {
				$sql .= "`$key` = '".mysqli_real_escape_string($db, htmlspecialchars($value))."' AND";
			}
			$sql = substr($sql, 0, -4);
		}

		$query = mysqli_query($db, $sql);

		if(mysqli_num_rows($query) < 1)
			return (false);

		if ($return)
			return(mysqli_fetch_assoc($query));
		else
			return ($query);
	}

	function set($table, $array)
	{
		global $db;

		$col = "";
		$val = "";

		foreach ($array as $colonne => $value) {
			$col = $col."`$colonne`, ";
			$val = $val."'".mysqli_real_escape_string($db, htmlspecialchars($value))."', ";
		}
		$col = substr($col, 0, -2);
		$val = substr($val, 0, -2);

		$query = "INSERT INTO `$table` ($col) VALUES ($val)";

		return mysqli_query($db, $query);
	}

	function del($table, $cdt)
	{
		global $db;

		$sql = "DELETE FROM `$table`";

		$sql .= " WHERE ";
		foreach ($cdt as $key => $value) {
			$sql .= "`$key` = '".mysqli_real_escape_string($db, htmlspecialchars($value))."' AND";
		}
		$sql = substr($sql, 0, -4);

		return mysqli_query($db, $sql);
	}

	function update($table, $array, $cdt)
	{
		global $db;

		$query = "";

		foreach ($array as $colonne => $value) {
			$query = $query."`$colonne`='".mysqli_real_escape_string($db, htmlspecialchars($value))."', ";
		}
		$query = substr($query, 0, -2);

		$sql = "";
		if($cdt != false)
		{
			foreach ($cdt as $key => $value) {
				$sql .= "`$key` = '".mysqli_real_escape_string($db, htmlspecialchars($value))."' AND";
			}
			$sql = substr($sql, 0, -4);
		}

		$query = "UPDATE `$table` SET $query WHERE $sql";

		return mysqli_query($db, $query);
	}

	function get_catById($id)
	{
		$id = explode(',', $id);

		$str = '';
		foreach ($id as $value) {
			$str .= get("category", "category", array("id" => $value))['category'].', ';
		}

		return substr($str, 0, -2);
	}

	function send_email_register($user)
	{
		$to      = $user['email'];
    	$subject = 'Inscription sur ' . SITENAME;
    	$message = "Bonjour ".$user['firstname']."! \n\n Confirmer votre adresse email grace au lien suivent: " . SITEURL . "/validemail/".$user['token'];
    	$headers = 'From: ' . SITEMAIL . "\r\n" .
    	'Reply-To: ' . SITEMAIL . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

    	mail($to, $subject, $message, $headers);
	}

	function user_logged()
	{
		return isset($_SESSION['user']);
	}

	function user_ranked($rank)
	{
		return (user_logged() && $_SESSION['user']['rank'] >= $rank);
	}

	function addToPanier($articleId, $nb)
	{
		$articles = get("*", "articles", array("id" => $articleId));
		if($articles)
		{
			if (!isset($_SESSION['panier']))
				$_SESSION['panier'] = Array();
			$articles['count'] = $nb;
			for ($i=0; $i < count($_SESSION['panier']); $i++) {
				if ($_SESSION['panier'][$i]['id'] == $articles['id'])
					return false;
			}
			$_SESSION['panier'][] = $articles;
			if (user_logged())
			update('panier', array("panier" => json_encode($_SESSION['panier'])), array("userid" => $_SESSION['user']['id'], "payed" => 0));
		}
	}