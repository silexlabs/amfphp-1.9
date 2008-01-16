<?php
// Wade Arnold: 1/16/2008
// Example is designed to show how to use datagrid. 
// TODO: Add method to update the dataset array. 
// TODO: Add an additional call that shows how to get data from a database. 
// TODO: Add a method to update the database dataset. 
 
class DataGrid {
	var $aRoster;
	
	public function __construct() {
		// Create an array to populate the datagrid. This data set is for an example without a DB
		$this->aRoster = array( 
			array( Name =>"Wade Arnold", 
				Bats => "R",
				Throws => "R", 
				Year => "Sr",
				Home => "Cedar Falls, IA"),
			array( Name =>"Wilma Carter", 
				Bats => "R",
				Throws => "R", 
				Year => "So",
				Home => "Redlands, CA"),
			array( Name =>"Sue Pennypacker", 
				Bats => "L",
				Throws => "R", 
				Year => "Fr",
				Home => "Athens, GA"),
			array( Name =>"Jill Smithfield", 
				Bats => "R",
				Throws => "L", 
				Year => "Sr",
				Home => "Spokane, WA"),
			array( Name =>"Shirley Goth", 
				Bats => "R",
				Throws => "R", 
				Year => "Sr",
				Home => "Carson, NV"),
			array( Name =>"Jennifer Dunbar", 
				Bats => "R",
				Throws => "R", 
				Year => "Fr",
				Home => "Seaside, CA"),
			array( Name =>"Patty Crawford", 
				Bats => "L",
				Throws => "L", 
				Year => "So",
				Home => "Whittier, CA"),
			array( Name =>"Angelina Davis", 
				Bats => "R",
				Throws => "R", 
				Year => "So",
				Home => "Odessa, TX"),
			array( Name =>"Debbie Ferguson", 
				Bats => "R",
				Throws => "R", 
				Year => "Jr",
				Home => "Bend, OR"),
			array( Name =>"Karen Bronson", 
				Bats => "R",
				Throws => "R", 
				Year => "Sr",
				Home => "Billings, MO"),
			array( Name =>"Sylvia Munson", 
				Bats => "R",
				Throws => "R", 
				Year => "Jr",
				Home => "Pasadena, CA"),
			array( Name =>"Carla Gomez", 
				Bats => "R",
				Throws => "R", 
				Year => "Sr",
				Home => "Corona, CA"),
			array( Name =>"Betty Kay", 
				Bats => "R",
				Throws => "R", 
				Year => "Fr",
				Home => "Palo Alto, CA"),
			);
	}
	
	public function getDataSet() {
		return $this->aRoster;
	}
	
}
?>