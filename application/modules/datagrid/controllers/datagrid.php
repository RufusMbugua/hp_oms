<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datagrid extends MY_Controller {

	function __construct()
	{
	   	/* Load datatables server-side scripting library 'Ssp' */
		$this->load->library('Ssp');
	}
  
	public function load_grid()
	{
		$this->load->view("index");
	}

	public function get_remote()
	{
        $table = 'access_level';

		// Table's primary key
		$primaryKey = 'id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
			array( 'db' => 'level_name', 'dt' => 0 ),
			array( 'db' => 'description',  'dt' => 1 ),
			array( 'db' => 'indicator',   'dt' => 2 ),
		);

		// SQL server connection information
		$CI = &get_instance();
		$sql_details = array(
						'user' => $CI -> db -> username,
						'pass' => $CI -> db -> password,
						'db'   => $CI -> db -> database,
						'host' => $CI -> db -> hostname
		);

		echo json_encode(SSP::simple($_GET,$sql_details,$table,$primaryKey,$columns));
	}

}

/* End of file datagrid.php */
/* Location: ./application/modules/datagrid/datagrid.php */