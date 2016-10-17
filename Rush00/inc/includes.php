<?php

	include_once ROOT."/inc/function.php";

	if (!file_exists(ROOT."/inc/config/config.php"))
		redirect("/install");
	else
		include_once ROOT."/inc/config/config.php";

	include_once ROOT."/inc/bddconnect.php";