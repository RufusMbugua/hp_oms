<?php

class Imci_Model extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function imci_cadre() {
		$query = "SELECT 
    count(*) as total,f.facilityType as facility_type,c.cadre_name as cadre
FROM
    subprogramlog s,
    facility f,cadre c
WHERE
	c.cadre_id=s.cadre AND
    s.mfl_code = f.facilityMFC
GROUP BY facilityType,s.cadre;";

		$cadre = $this -> db -> query($query);
		return $cadre;
	}

	

}
