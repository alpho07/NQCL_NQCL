<?php

class Refsubs extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('standard_type', 'varchar', 30);
		$this -> hasColumn('source', 'varchar', 30);
		$this -> hasColumn('batch_no', 'varchar', 30);
		$this -> hasColumn('rs_code', 'varchar', 30);
		$this -> hasColumn('date_received', 'date');
		$this -> hasColumn('effective_date', 'date');
		$this -> hasColumn('date_of_expiry', 'date');
		$this -> hasColumn('date_of_restandardisation', 'date');
		$this -> hasColumn('potency', 'decimal', 16 , array('type'=>'decimal','scale'=> 6, 'length'=> 16));
		$this -> hasColumn('potency_unit', 'varchar', 15);
		$this -> hasColumn('init_mass', 'decimal', 6, array('type'=>'decimal','scale'=> 2, 'length'=> 6));
		$this -> hasColumn('init_mass_unit', 'varchar', 15);
		$this -> hasColumn('status', 'varchar', 30);
		$this -> hasColumn('restandardisation_status', 'varchar', 20);
		$this -> hasColumn('application', 'varchar', 30);
		$this -> hasColumn('standard_type', 'varchar', 30);
		$this -> hasColumn('version_id', 'int', 11);
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('refsubs');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("refsubs");
		//s-> where("id IN (select max(id) from refsubs group by rs_code)");
		$clientData = $query -> execute();
		return $clientData;
	}//end getall


	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("refsubs");
		//-> where("id IN (select max(id) from refsubs group by rs_code)");
		$clientData = $query -> execute() -> toArray();
		return $clientData;
	}//end getall




	public function getCount($name, $standard_type) {
		$query = Doctrine_Query::create() 
		-> select('count(name)')
		-> from("refsubs")
		-> where('name = ?',$name)
		-> andWhere('standard_type = ?', $standard_type);
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}

}
?>