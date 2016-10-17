<html>
<head>
<style type="text/css">
* {font-size: 10pt;}
</style>
<script>
function goBack() {
    window.history.back();
}
</script>
</head>
<body>

<?php
$order = "";
$order0 = "";
$asc = "";
$dir = "";
/* racine */
$BASE = $_GET['dir'] ?? ".";
$PHP_SELF = $BASE;

/* infos à extraire */
function addScheme($entry,$base,$type) {
  $tab['name'] = $entry;
  $tab['type'] = filetype($base."/".$entry);
  $tab['date'] = filemtime($base."/".$entry);
  $tab['size'] = filesize($base."/".$entry);
  $tab['perms'] = fileperms($base."/".$entry);
  $tab['access'] = fileatime($base."/".$entry);
  $t = explode(".", $entry);
  $tab['ext'] = $t[count($t)-1];
  return $tab;
}

/* liste des dossiers */
function list_dir($base, $cur, $level=0) {
  global $PHP_SELF, $BASE, $order, $asc;
  if ($dir = opendir($base)) {
    $tab = array();
    while($entry = readdir($dir)) {
      if(is_dir($base."/".$entry) && !in_array($entry, array(".",".."))) {
        $tab[] = addScheme($entry, $base, 'dir');
      }
    }
    /* tri */
    usort($tab,"cmp_name");
    foreach($tab as $elem) {
      $entry = $elem['name'];
      /* chemin relatif à la racine */
      $file = $base."/".$entry;
     /* marge gauche */
      for($i=1; $i<=(4*$level); $i++) {
        echo "&nbsp;";
      }
      /* l'entrée est-elle le dossier courant */
      if($file == $cur) {
        echo "<img src=\"https://raw.githubusercontent.com/Wilou017/PaternPHP/master/Explorateur%20de%20Fichier/dir-open.gif?token=AH1cF-fi811dFBr9WRE_NYI1cjXw_Dq9ks5X8noSwA%3D%3D\" />&nbsp;$entry<br />\n";
      } else {
        echo "<img src=\"https://raw.githubusercontent.com/Wilou017/PaternPHP/master/Explorateur%20de%20Fichier/dir-close.gif?token=AH1cF0SWLczJMFpjMojMTGEhgRhGKLpLks5X8nowwA%3D%3D\" />&nbsp;<a href=\"$PHP_SELF?dir=". rawurlencode($file) ."\">$entry</a><br />\n";
      }
      /* l'entrée est-elle dans la branche dont le dossier courant est la feuille */
    }
    closedir($dir);
  }
}

/* liste des fichiers */
function list_file($cur) {
  global $PHP_SELF, $order, $asc, $order0;
  if ($dir = opendir($cur)) {
    /* tableaux */
    $tab_dir = array();
    $tab_file = array();
    /* extraction */
    while($file = readdir($dir)) {
      if(is_dir($cur."/".$file)) {
        if(!in_array($file, array(".",".."))) {
          $tab_dir[] = addScheme($file, $cur, 'dir');
        }
      } else {
          $tab_file[] = addScheme($file, $cur, 'file');
      }
    }
    /* tri */
    usort($tab_dir,"cmp_".$order);
    usort($tab_file,"cmp_".$order);
    /* affichage */
    echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
    echo "<tr style=\"font-size:8pt;font-family:arial;\">
    <th>Nom</th><td>&nbsp;</td>
    <th>Taille</th><td>&nbsp;</td>
    <th>Dernière modification</th><td>&nbsp;</td>
    <th>Type</th><td>&nbsp;</td>
    <th>Extention</th><td>&nbsp;</td>
    <th>Permissions</th><td>&nbsp;</td>
    <th>Dernier accès</th></tr>";
    foreach($tab_dir as $elem) {
      echo "<tr><td><img src=\"https://raw.githubusercontent.com/Wilou017/PaternPHP/master/Explorateur%20de%20Fichier/dir-close.gif?token=AH1cF0SWLczJMFpjMojMTGEhgRhGKLpLks5X8nowwA%3D%3D\" />&nbsp;".$elem['name']."</td><td>&nbsp;</td>
      <td>&nbsp;</td><td>&nbsp;</td>
      <td>".date("d/m/Y H:i:s", $elem['date'])."</td><td>&nbsp;</td>
      <td>".assocType($elem['type'])."</td><td>&nbsp;</td>
      <td>&nbsp;</td><td>&nbsp;</td>
      <td>".$elem['perms']."</td><td>&nbsp;</td>
      <td>".date("d/m/Y", $elem['access'])."</td></tr>\n";
    }
    foreach($tab_file as $elem) {
      echo "<tr><td><img src=\"https://raw.githubusercontent.com/Wilou017/PaternPHP/master/Explorateur%20de%20Fichier/file-none.gif?token=AH1cF301Oq6P-DR6soFpCOCxOzAPMo9Xks5X8nnkwA%3D%3D\" />&nbsp;<a href='$cur/".$elem['name']."'>".$elem['name']."</a></td><td>&nbsp;</td>
      <td align=\"right\">".formatSize($elem['size'])."</td><td>&nbsp;</td>
      <td>".date("d/m/Y H:i:s", $elem['date'])."</td><td>&nbsp;</td>
      <td>".assocType($elem['type'])."</td><td>&nbsp;</td>
      <td>".assocExt($elem['ext'])."</td><td>&nbsp;</td>
      <td>".$elem['perms']."</td><td>&nbsp;</td>
      <td>".date("d/m/Y", $elem['access'])."</td></tr>\n";
    }
    echo "</table>";
    closedir($dir);
  }
}

/* formatage de la taille */
function formatSize($s) {
  /* unités */
  $u = array('octets','Ko','Mo','Go','To');
  /* compteur de passages dans la boucle */
  $i = 0;
  /* nombre à afficher */
  $m = 0;
  /* division par 1024 */
  while($s >= 1) {
    $m = $s;
    $s /= 1024;
    $i++;
  }
  if(!$i) $i=1;
  $d = explode(".",$m);
  /* s'il y a des décimales */
  if($d[0] != $m) {
    $m = number_format($m, 2, ",", " ");
  }
  return $m." ".$u[$i-1];
}

/* formatage du type */
function assocType($type) {
  /* tableau de conversion */
  $t = array(
    'fifo' => "file",
    'char' => "fichier spécial en mode caractère",
    'dir' => "dossier",
    'block' => "fichier spécial en mode bloc",
    'link' => "lien symbolique",
    'file' => "fichier",
    'unknown' => "inconnu"
  );
  return $t[$type];
}

/* description de l'extention */
function assocExt($ext) {
  $e = array(
    '' => "inconnu",
    'doc' => "Microsoft Word",
    'xls' => "Microsoft Excel",
    'ppt' => "Microsoft Power Point",
    'pdf' => "Adobe Acrobat",
    'zip' => "Archive WinZip",
    'txt' => "Document texte",
    'gif' => "Image GIF",
    'jpg' => "Image JPEG",
    'png' => "Image PNG",
    'php' => "Script PHP",
    'php3' => "Script PHP",
    'htm' => "Page web",
    'html' => "Page web",
    'css' => "Feuille de style",
    'js' => "JavaScript"
  );
  if(in_array($ext, array_keys($e))) {
    return $e[$ext];
  } else {
    return $e[''];
  }
}

function cmp_name($a,$b) {
    global $asc;
    if ($a['name'] == $b['name']) return 0;
    if($asc == 'a') {
        return ($a['name'] < $b['name']) ? -1 : 1;
    } else {
        return ($a['name'] > $b['name']) ? -1 : 1;
    }
}
function cmp_size($a,$b) {
    global $asc;
    if ($a['size'] == $b['size']) return cmp_name($a,$b);
    if($asc == 'a') {
        return ($a['size'] < $b['size']) ? -1 : 1;
    } else {
        return ($a['size'] > $b['size']) ? -1 : 1;
    }
}
function cmp_date($a,$b) {
    global $asc;
    if ($a['date'] == $b['date']) return cmp_name($a,$b);
    if($asc == 'a') {
        return ($a['date'] < $b['date']) ? -1 : 1;
    } else {
        return ($a['date'] > $b['date']) ? -1 : 1;
    }
}
function cmp_access($a,$b) {
    global $asc;
    if ($a['access'] == $b['access']) return cmp_name($a,$b);
    if($asc == 'a') {
        return ($a['access'] < $b['access']) ? -1 : 1;
    } else {
        return ($a['access'] > $b['access']) ? -1 : 1;
    }
}
function cmp_perms($a,$b) {
    global $asc;
    if ($a['perms'] == $b['perms']) return cmp_name($a,$b);
    if($asc == 'a') {
        return ($a['perms'] < $b['perms']) ? -1 : 1;
    } else {
        return ($a['perms'] > $b['perms']) ? -1 : 1;
    }
}
function cmp_type($a,$b) {
    global $asc;
    if ($a['type'] == $b['type']) return cmp_name($a,$b);
    if($asc == 'a') {
        return ($a['type'] < $b['type']) ? -1 : 1;
    } else {
        return ($a['type'] > $b['type']) ? -1 : 1;
    }
}
function cmp_ext($a,$b) {
    global $asc;
    if ($a['ext'] == $b['ext']) return cmp_name($a,$b);
    if($asc == 'a') {
        return ($a['ext'] < $b['ext']) ? -1 : 1;
    } else {
        return ($a['ext'] > $b['ext']) ? -1 : 1;
    }
}
?>

<table border="1" cellspacing="0" cellpadding="10" bordercolor="gray">
<tr valign="top"><td>

<!-- liste des répertoires
et des sous-répertoires -->
<?php
if(!in_array($order, array('name','date','size','perms','ext','access','type'))) {
  $order = 'name';
}
if(($order == $order0) && ($asc != 'b')) {
  $asc = 'b';
} else {
  $asc = 'a';
}
/* lien sur la racine */
if($BASE != ".") {
  echo "<div onclick=\"goBack()\"><img src=\"https://raw.githubusercontent.com/Wilou017/PaternPHP/master/Explorateur%20de%20Fichier/dir-open.gif?token=AH1cF-fi811dFBr9WRE_NYI1cjXw_Dq9ks5X8noSwA%3D%3D\" />&nbsp;../</div>\n";
} else {
  echo "<img src=\"https://raw.githubusercontent.com/Wilou017/PaternPHP/master/Explorateur%20de%20Fichier/dir-close.gif?token=AH1cF0SWLczJMFpjMojMTGEhgRhGKLpLks5X8nowwA%3D%3D\"/>&nbsp;<a href=\"$PHP_SELF\">/</a><br />\n";
}
list_dir($BASE, rawurldecode($dir), 1);
?>

</td><td>

<!-- liste des fichiers -->
<?php
/* répertoire initial à lister */
if(!$dir) {
  $dir = $BASE;
}
list_file(rawurldecode($dir));
?>

</td></tr>
</table>

</body>
</html>