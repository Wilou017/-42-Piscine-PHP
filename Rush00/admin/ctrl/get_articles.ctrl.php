<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/inc/global.php';


	$return['result'] = false;

	if (user_ranked(10) && isset($_POST['submit_getart']))
	{

		if (isset($_POST['nb']))
		{
			$nb = $_POST['nb'];

			if ($nb <= 0 || $nb > 200)
				$return['message'] = "Veuillez rentrer un nombre entre 1 et 200";
			else
			{
				$articles = json_decode(file_get_contents("http://api.randomuser.me/?results=$nb"), true)["results"];

				$descs .= json_decode(file_get_contents("http://www.randomtext.me/api/lorem/p-20/20-45/200"), true)["text_out"];

				$descs = explode("<p>", $descs);
				foreach ($descs as $key => $desc) {
					$descs[$key] = substr($desc, 0, -5);
				}

				$category = get("*", "category", false, false);

				$catId = Array();

				while ($cat = mysqli_fetch_assoc($category)):
					$catId[] = $cat['id'];
				endwhile;

				$return['img'] = Array();
				foreach ($articles as $article):

					$category = "";
					$catId_shuffle = $catId;
					shuffle($catId_shuffle);
					for ($i=0; $i <= (rand(1, 5) % (count($catId) - 1)); $i++)
						$category .= $catId_shuffle[$i].",";
					$category = substr($category, 0, -1);

					$newarticledata = array('category' => $category,
											'nat' => $article["nat"],
											'photo' => $article["picture"]["large"],
											'firstname' => $article["name"]["first"],
											'lastname' => $article["name"]["last"],
											'numders' => $article["cell"],
											'adress' => $article["location"]["street"]." ".$article["location"]["city"]." ".$article["location"]["state"]." ".$article["location"]["postcode"],
											'email' => $article["email"],
											'birthdate' => $article["dob"],
											'username' => $article["login"]["username"],
											'password' => $article["login"]["password"],
											'sexe' => $article["gender"],
											'size' => rand(147, 250),
											'description' => $descs[rand(0, (count($descs) - 1))],
											'stock' => rand(1, 300),
											'price' => rand(1, 1500),
											'time_delivery' => rand(30, 365));
					set('articles', $newarticledata);
					$return['img'][] = $article["picture"]["large"];
				endforeach;
				$return['result'] = true;
			}
		}
		else
			$return['message'] = "Merci de remplir le champs";
	}

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		die(json_encode($return));
	}