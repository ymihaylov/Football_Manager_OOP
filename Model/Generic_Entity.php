<?php  
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/Modules/Database.php";

class Generic_Entity extends Database {

	public function __construct()
	{
		parent::__construct();
	}

	protected function getAll($table)
	{
		$get_all_query = "SELECT * 
					FROM `$table`";
		if($result=$this->connection->query($get_all_query))
		{
			while($row=$result->fetch_assoc())
			{
				$all_entities_array[]=$row;
			}
			$result->free();
		}
		if( ! empty($all_entities_array) )
			return $all_entities_array;
		else
			return false;
	}

	protected function updateById ($table, $entity_id, $prop_array)
	{
		$update_query = "UPDATE `$table` SET ";
		foreach ($prop_array as $key => $value) 
		{
			$update_query .= "`$key` = '$value', ";	
		}
		$update_query = mb_substr($update_query, 0, -2);
		$update_query .= " WHERE id = $entity_id";
		
		if( ! $this->connection->query($update_query))
		{	
			throw new Exception("DB Error", 1);
		}
	}
}
