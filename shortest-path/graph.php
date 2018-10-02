<?php
setlocale(LC_ALL, 'en_GB.UTF8');
$time_start = microtime(true);
set_time_limit(0);
require_once __DIR__.'/constantes.php';
require_once __DIR__.'/class.dictionnaires.php';
$dictionnaire = new dictionnaire('en_GB.UTF-8');
$dictionnaire->get_fichiers(array(__DIR__.'/langages/en_GB.UTF-8/en_GB.UTF-8.xml'));
require_once __DIR__.'/class.graph.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php print i18N_T("Graph");?></title>
		<link rel="stylesheet" href="/graph/css/commun.css" media="screen"/>
		<script async="async" src="/graph/js/commun.js"></script>
	</head>
	<body>
		<h1><?php print i18N_T("Chemin le plus court");?></h1>
		<p><?php print i18N_T("Calcul du chemin le plus court (en distance ou temps) entre deux villes");?><br />
		<details>
			<summary><?php print i18N_T("Les codes utilisés sont ceux de villes d'Australie");?></summary>
			<ul>
				<li>ADL : Adelaide</li>
				<li>ASP : Alice Springs</li>
				<li>BNE : Brisbane</li>
				<li>CBR : Canberra</li>
				<li>CNS : Cairns</li>
				<li>DRW : Darwin</li>
				<li>MEL : Melbourne</li>
				<li>PER : Perth</li>
				<li>SYD : Sydney</li>
			</ul>
		</details></p>
<?php
//$graph = new graph('ADL', 'PER', DIST);
//$graph = new graph('ADL', 'PER', TEMPS);
$graph = new graph('SYD', 'PER', DIST);
//$graph = new graph('SYD', 'PER', TEMPS);
//$graph = new graph('MEL', 'CNS', DIST);
//$graph = new graph('MEL', 'CNS', TEMPS);
//$graph = new graph('SYD', 'DRW', DIST);
//$graph = new graph('SYD', 'DRW', TEMPS);
//$graph = new graph('MEL', 'DRW', DIST);
//$graph = new graph('MEL', 'DRW', TEMPS);
//$graph = new graph('PER', 'BNE', DIST);
//$graph = new graph('PER', 'BNE', TEMPS);
if(count($graph->collectionOK)>0){
	foreach($graph->collectionOK as $cle => $branche){
		if($graph->type==DIST){
			printf(i18N_T("La distance entre %s et %s est de %.2f km"),$graph->vd,$graph->va,$branche->get_distTot());
			print '<br />'.i18N_T("Le circuit le plus court est :").'<br />';
			foreach($branche->liste as $key => $chemin){
				printf("%s -> %s [%.2f km]",$chemin->ville1,$chemin->ville2,$chemin->dist);
				print '<br />';
			}
		}elseif($graph->type==TEMPS){
			$heures  = floor($branche->get_tempsTot()/60);
			$minutes = $branche->get_tempsTot() % 60;
			$duree = ($minutes > 0)?$heures.' heures '.$minutes.' minutes':$heures.' heures';
			printf(i18N_T("La distance entre %s et %s est de %s"),$graph->vd,$graph->va,$duree);
			print '<br />'.i18N_T("Le circuit le plus rapide est :").'<br />';
			foreach($branche->liste as $key => $chemin){
				printf("%s -> %s [%s]",$chemin->ville1,$chemin->ville2,str_replace('.',' h ',$chemin->temps));
				print '<br />';
			}
		}
	}
}else{
	if($graph->get_Graph()){
		if(!DEBUG){
			unset($graph->collection,$graph->omits);
		}
		if(DEBUG){
			$graph->affiche_Graph();
		}
		$graph->count = count($graph->collectionOK);
		if($graph->count > 0){
			foreach($graph->collectionOK as $cle => $branche){
				if($graph->type==DIST){
					printf(i18N_T("La distance entre %s et %s est de %.2f km"),$graph->vd,$graph->va,$branche->get_distTot());
					print '<br />'.i18N_T("Le circuit le plus court est :").'<br />';
					foreach($branche->liste as $key => $chemin){
						printf("%s -> %s [%.2f km]",$chemin->ville1,$chemin->ville2,$chemin->dist);
						print '<br />';
					}
				}elseif($graph->type==TEMPS){
					$heures  = floor($branche->get_tempsTot()/60);
					$minutes = $branche->get_tempsTot() % 60;
					$duree = ($minutes > 0)?$heures.' heures '.$minutes.' minutes':$heures.' heures';
					printf(i18N_T("La distance entre %s et %s est de %s"),$graph->vd,$graph->va,$duree);
					print '<br />'.i18N_T("Le circuit le plus rapide est :").'<br />';
					foreach($branche->liste as $key => $chemin){
						printf("%s -> %s [%s]",$chemin->ville1,$chemin->ville2,str_replace('.',' h ',$chemin->temps));
						print '<br />';
					}
				}
				$sql= "INSERT INTO chemins 
					(ville1,ville2,dist,temps,etapes,comp) 
					VALUES(\"".$graph->vd."\",\"".$graph->va."\",\"".number_format($branche->get_distTot(),1,'.','')."\",\"".$branche->get_tempsTot()."\",'".json_encode($branche->liste,JSON_HEX_APOS|JSON_HEX_QUOT|JSON_PRESERVE_ZERO_FRACTION)."',".$graph->type.")";
				$graph->enregChemin($sql);
			}
		}else{
			print $graph->message.'<br />';
		}
	}else{
		print $graph->message.'<br />';
	}
}
$time_end = microtime(true);
$time = $time_end - $time_start;
print "<br />Durée : ".$time." secondes<br />";
?>
</body>
</html>