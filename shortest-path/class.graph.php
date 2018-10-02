<?php
/**
 * 
 * 
 * @return object graph
 *
 */
class graph
{
	static $db;
	public $success = false;
	public $message = '';
	public $count = 0;
	public $vd = '';
	public $va = '';
	public $type = 1;
	public $collection = [];
	public $collectionOK = [];
	public $omits = [];
	static $num = 0;

	/*
	 * @param $v1 élément de départ
	 * @param $v2 élément d'arrivée
	 * @param $type DIST (longueur du trajet) ou TEMPS (durée du trajet)
	 * Ouvre la base de données et vérifie si le résultat est déjà dans celle-ci
	 */
	function __construct(string $v1,string $v2,int $type=1)
	{
		if (!self::$db){
			self::$db = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
			$sql = "SET NAMES utf8";
			$result = self::$db->query($sql);
			mb_internal_encoding("UTF-8");
			mb_regex_encoding("UTF-8");
		}
		$this->vd = $v1;
		$this->va = $v2;
		$this->type = (int)$type;
		if($this->existe_Resultat()) return $this;
	}
	
	/*
	 * @type boolean
	 * @return true si le calcul est déjà dans la BDD, false sinon
	 */
	private function existe_Resultat()
	{
		include_once dirname(__FILE__).'/class.liste.php';
		$sql = "SELECT dist,temps,etapes 
				FROM chemins 
				WHERE ville1=\"".self::$db->real_escape_string($this->vd)."\" AND ville2=\"".self::$db->real_escape_string($this->va)."\" AND comp=".$this->type;
		$result = self::$db->query($sql);
		if(!$result){
			return false;
		}else{
			$nR = $result->num_rows;
			if($nR > 0){
				for($n=0;$n<$nR;$n++){
					$objet = $result->fetch_object();
					$etapes = json_decode($objet->etapes);
					$this->collectionOK[$n] = new liste();
					$this->collectionOK[$n]->liste = $etapes;
					$this->collectionOK[$n]->set_distTot($objet->dist);
					$this->collectionOK[$n]->set_tempsTot($objet->temps);
				}
				return true;
			}else{
				return false;
			}
		}
	}
	
	/*
	 * @type boolean
	 * @return true si l'opération s'est bien déroulée, false si erreur lors de l'accès à la table
	 * Créé le premier niveau de l'arbre
	 */
	public function get_Graph()
	{
		include_once dirname(__FILE__).'/class.liste.php';
		$sql = "SELECT ville1,ville2,dist,temps 
				FROM vvd 
				WHERE ville1=\"".self::$db->real_escape_string($this->vd)."\"";
		$result = self::$db->query($sql);
		if(!$result){
			print $sql.'<br />'.self::$db->error.'<br />';
			unset($sql);
			return false;
		}elseif($result->num_rows>0){
			unset($sql);
			$count = $result->num_rows;
			for($n=0;$n<$count;$n++){
				$objet = $result->fetch_object();
				if($objet->ville2 == $this->va){
					$objet->fin = true;
					$this->collectionOK[0] = new liste();
					$this->collectionOK[0]->ajout($objet);
					$this->collectionOK[0]->calc_distTot($objet->dist);
					$this->collectionOK[0]->calc_tempsTot($objet->temps);
					$this->success = true;
					unset($objet);
				}else{
					$objet->fin = false;
					$this->collection[$n] = new liste();
					$this->collection[$n]->ajout($objet);
					$this->collection[$n]->calc_distTot($objet->dist);
					$this->collection[$n]->calc_tempsTot($objet->temps);
					unset($objet);
					$this->count += 1;
				}
			}
			$result->free();
			if($this->count > 0){
				while($this->get_Branches());
				$this->collection = array_values($this->collection);
			}
		}
		return true;
	}
	
	/*
	 * @type boolean
	 * @return true s'il y a eu au moins une nouvelle étape d'ajoutée à une branche
	 * Élague le plus vite possible les branches sans intérêt pour simplifier l'arbre
	 */
	private function get_Branches()
	{
		$this->num++;
		foreach($this->collection as $key => $branche){
			foreach($branche as $cle => $liste){
				$ajout = false;
				end($liste);
				$clef = key($liste);
				$vvd = $liste[$clef];
				unset($clef);
				$sql = "SELECT ville1,ville2,dist,temps
						FROM vvd
						WHERE ville1=\"".self::$db->real_escape_string($vvd->ville2)."\"";
				$result = self::$db->query($sql);
				if(!$result){
					print $sql.'<br />'.self::$db->error.'<br />';
					unset($sql);
					return false;
				}elseif($result->num_rows>0){
					unset($sql);
					$count = $result->num_rows;
					$collection_base = clone $this->collection[$key];
					$cle_base = $key;
					for($n=0;$n<$count;$n++){
						$objet = $result->fetch_object();
						if(isset($this->omits[$key])){
							if(in_array($objet,$this->omits[$key])){
								unset($objet);
								continue;
							}
						}
						if($this->check_Opposite($branche->liste,$objet->ville1,$objet->ville2)){
							$this->omits[$key][] = $objet;
							continue;
						}
						if($objet->ville2 == $this->va){
							$objet->fin = true;
						}else{
							$objet->fin = false;
						}
						$collection = clone $collection_base;
						if(in_array($objet,$collection->liste)){
							unset($objet);
							continue;
						}
						if($this->check_V2InV1($objet->ville2,$collection->liste)){
							unset($objet);
							continue;
						}
						if(!$ajout){
							$this->collection[$cle_base]->ajout($objet);
							$this->collection[$cle_base]->calc_distTot($objet->dist);
							$this->collection[$cle_base]->calc_tempsTot($objet->temps);
							$this->count++;
							$ajout = true;
						}else{
							$collection->ajout($objet);
							$collection->calc_distTot($objet->dist);
							$collection->calc_tempsTot($objet->temps);
							$this->collection[] = $collection;
							unset($collection);
							end($this->collection);
							$old_cle_base = $cle_base;
							$cle_base = key($this->collection);
							$this->count++;
							$ajout = true;
						}
						if(in_array($this->collection[$cle_base]->liste,$this->omits)){
							unset($this->collection[$cle_base]);
							continue;
						}
						$nCollOK = count($this->collectionOK);
						if($objet->ville2 == $this->va){
							if($nCollOK > 0){
								if(!in_array($this->collection[$cle_base],$this->collectionOK)){
									if($this->type == 1){
										if($this->collection[$cle_base]->get_distTot() == $this->collectionOK[0]->get_distTot()){
											$this->collectionOK[] = $this->collection[$cle_base];
										}elseif($this->collection[$cle_base]->get_distTot() < $this->collectionOK[0]->get_distTot()){
											$this->collectionOK = [];
											$this->collectionOK[0] = $this->collection[$cle_base];
										}
									}elseif($this->type == 2){
										if($this->collection[$cle_base]->get_tempsTot() == $this->collectionOK[0]->get_tempsTot()){
											$this->collectionOK[] = $this->collection[$cle_base];
										}elseif($this->collection[$cle_base]->get_tempsTot() < $this->collectionOK[0]->get_tempsTot()){
											$this->collectionOK = [];
											$this->collectionOK[0] = $this->collection[$cle_base];
										}
									}
								}
							}else{
								$this->collectionOK[0] = $this->collection[$cle_base];
							}
							unset($this->collection[$cle_base],$this->omits[$cle_base]);
							$cle_base = $old_cle_base;
						}else{
							if($nCollOK > 0){
								if($this->type == 1){
									if($this->collection[$cle_base]->get_distTot() == $this->collectionOK[0]->get_distTot()){
										unset($this->collection[$cle_base],$this->omits[$cle_base]);
										$cle_base = $old_cle_base;
									}elseif($this->collection[$cle_base]->get_distTot() > $this->collectionOK[0]->get_distTot()){
										unset($this->collection[$cle_base],$this->omits[$cle_base]);
										$cle_base = $old_cle_base;
									}
								}elseif($this->type == 2){
									if($this->collection[$cle_base]->get_tempsTot() == $this->collectionOK[0]->get_tempsTot()){
										unset($this->collection[$cle_base],$this->omits[$cle_base]);
										$cle_base = $old_cle_base;
									}elseif($this->collection[$cle_base]->get_tempsTot() > $this->collectionOK[0]->get_tempsTot()){
										unset($this->collection[$cle_base],$this->omits[$cle_base]);
										$cle_base = $old_cle_base;
									}
								}
							}
						}
						unset($nCollOK);
					}
					$result->free();
					unset($collection_base);
					if(!$ajout){
						$this->omits[] = $this->collection[$key]->liste;
						unset($this->collection[$key]);
					}
				}else{
					return false;
				}
			}
		}
		if($ajout){
			return true;
		}else{
			return false;
		}
	}
	
	/*
	 * @type boolean
	 * @return true si le chemin est l'inverse d'un chemin déjà ajouté à la branche, sinon false
	 * Permet d'éviter de tourner en rond
	 */
	private function check_Opposite(array $lst,string $v1,string $v2)
	{
		foreach($lst as $key => $value){
			if($value->ville1 == $v2 && $value->ville2 == $v1){
				return true;
			}
		}
		return false;
	}
	
	/*
	 * @type boolean
	 * @return true si la ville de l'étape est déjà dans la branche, sinon false
	 * Permet d'éviter, là aussi, de tourner en rond
	 */
	private function check_V2InV1(string $v2,array $liste)
	{
		foreach($liste as $k => $o){
			if($o->ville1 == $v2){
				return true;
			}
		}
		return false;
	}

	/*
	 * @type boolean
	 * @param sql requête pour ajouter le résultat à la BDD
	 * @return true si le résultat est enregistré, sinon false
	 */
	public function enregChemin($sql)
	{
		$result = self::$db->query($sql);
		if(!$result){
			print $sql.'<br />'.self::$db->error.'<br />';
			unset($sql);
			return false;
		}
		unset($sql);
		//return $result->num_rows;
		return true;
	}
	
	/*
	 * @type void
	 * Affiche l'intégralité de l'arbre (pour debug)
	 */
	public function affiche_Graph()
	{
		print '<pre>';
		print_r($this);
		print '</pre>';
	}
	
	/*
	 * Ferme la base de donnée
	 */
	function __destruct()
	{
		self::$db->close();
	}
}
?>