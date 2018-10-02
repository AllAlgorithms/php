<?php
/**
 * 
* @return object bibliothèque
*
*/
class liste
{
	static $n = 0;
	public $liste = [];
	private $distTot = 0;
	private $tempsTot = 0;

	function __construct()
	{
		
	}
	
	/*
	 * @param objet l'objet à ajouter à la liste
	 */
	public function ajout(stdClass $objet)
	{
		$this->liste[] = $objet;
	}

	/*
	 * @param dst la distance à ajouter
	 * Calcul la distance totale parcourue dans cette branche 
	 */
	public function calc_distTot(float $dst)
	{
		$this->distTot += $dst;
	}
	
	/*
	 * @param temps
	 * Calcul le temps total mis pour parcourir cette branche
	 */
	public function calc_tempsTot(float $temps)
	{
		$dummy = explode('.',$temps);
		if(count($dummy)==1){
			$d = $dummy[0]*60;
			$this->tempsTot += $d;
		}elseif(count($dummy)==2){
			$d = ($dummy[0]*60)+$dummy[1];
			$this->tempsTot += $d;
		}
		unset($dummy);
	}
	
	/*
	 * @param dst
	 * Force la distance totale
	 */
	public function set_distTot(float $dst)
	{
		$this->distTot = $dst;
	}
	
	/*
	 * @return distTot
	 * Donne la distance totale
	 */
	public function get_distTot()
	{
		return $this->distTot;
	}
	
	/*
	 * @param temps
	 * Force la durée totale
	 */
	public function set_tempsTot(int $temps)
	{
		$this->tempsTot = $temps;
	}
	
	/*
	 * @return tempsTot
	 * Donne la durée totame
	 */
	public function get_tempsTot()
	{
		return $this->tempsTot;
	}

	function __destruct()
	{
		
	}
}
?>