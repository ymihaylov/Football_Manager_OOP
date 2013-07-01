<?php  
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/Modules/Database.php";

class Generic_Entity extends Database {

	public function __construct()
	{
		parent::__construct();
	}

	protected function get_by_id($table, $entity_id, $prop_array) 
	{
		$query = "SELECT ";

		$prop_array_length = sizeof($prop_array);

		for ($i=0; $i < $prop_array_length; $i++) 
		{ 
			$query .= "$prop_array[$i], ";
		}
		$query = mb_substr($query, 0, -2);
		$query  .= " FROM `$table` 
					WHERE id ='$entity_id' LIMIT 1";
		$result = $this->connection->query($query);
		$result_array = $result->fetch_assoc();
		return $result_array;
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

	protected function deleteById ($table, $entity_id)
	{
		$delete_query = "DELETE FROM `$table`
							  WHERE id = $entity_id";
		if ( ! $this->connection->query($delete_query))
		{
			throw new Exception("DB Error. Cannot delete this", 1);
		}
	}

	protected function create($table, $field_array)
	{
		$create_query = "INSERT INTO $table SET ";
		foreach ($field_array as $key => $value) {
			$create_query .= "`$key` = '$value', ";
		}
		
		$create_query = mb_substr($create_query, 0, -2);
		if ( ! $this->connection->query($create_query)) 
		{
			throw new Exception("DB Error. Cannot create new team", 1);
		}
		else
		{
			return $this->connection->insert_id;
		}
	}

}
