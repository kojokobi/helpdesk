<?php

class DataHelper extends Eloquent {

	/**
	 * Inserts a record into a dbTable
	 * @param  string $table_name             [dbTable to insert record ]
	 * @param  array $insert_parameters_array [array of  table columns and values]
	 * @return array                          [an array of the inserted record.]
	 */
	public static function insert_record($table_name,$insert_parameters_array){

		try{

		$id = DB::table($table_name)->insert_get_id(
				$inserted_record = $insert_parameters_array
			);

		if($id > 0)
			$inserted_record['id'] = $id;
		else
			return DataHelper::return_json_data(array(),true,HelperFunction::success_save_message());	

		 $data_to_return  = DataHelper::return_json_data($inserted_record,true,HelperFunction::success_save_message());	
		 return $data_to_return;
		
	}catch(Exception $e){

		return DataHelper::return_json_data(array(),false,$e);
	}
}
public static function insert_get_id($table_name,$insert_parameters_array){

		try{

		$id = DB::table($table_name)->insert_get_id(
				$inserted_record = $insert_parameters_array
			);

		return $id;
		
	}catch(Exception $e){

		return 0;
	}
}
	
	public static function insert_and_update($table_name,$insert_parameters_array,$key,$operator,$update_field,$value){

		try{

		$id = DB::table($table_name)->insert_get_id(
				$inserted_record = $insert_parameters_array
			);

		if($id > 0){
			$inserted_record['id'] = $id;
			$id = DB::table($table_name)
					->where($key,$operator,$id)
					->update(

							$update_array = array($update_field => $value . $inserted_record['id'])
					);
			$inserted_record[$update_field] = $value . $inserted_record['id'];
		}
		else
			return DataHelper::return_json_data(array(),true,HelperFunction::success_save_message());	

		 $data_to_return  = DataHelper::return_json_data($inserted_record,true,HelperFunction::success_save_message());	
		 return $data_to_return;
		
	}catch(Exception $e){

		return DataHelper::return_json_data(array(),false,$e);
	}

}
	/**
	 * [update_record description]
	 * @param  [string] $table_name              [the dbtable to update]
	 * @param  [string] $key                     [the update key column.defaults to 'id']
	 * @param  [string] $operator                [the update where clause operator.defaults to '=']
	 * @param  [] $value                   		 [the update where clause value]
	 * @param  [array] $update_parameters_array  [description]
	 * @return [type]                            [description]
	 */
	public static function update_record($table_name,$value,$update_parameters_array,$key='id',$operator='='){
		
		try{

			$id = DB::table($table_name)
					->where($key,$operator,$value)
					->update(

							$update_array = $update_parameters_array
					);
			
			$data_to_return =  DataHelper::return_json_data($update_array,true,HelperFunction::success_update_message());
			return $data_to_return;

		}catch(Exception $e){
			return return_json_data(array(),false,$e);
		}
	}
	/**
	 * [delete_record description]
	 * @param  [type] $table_name            [description]
	 * @param  [type] $array_keycolumn_value [description]
	 * @return [type]                        [description]
	 */
	public static function delete_record($table_name,$key_value){

		try{

			$res = DB::table($table_name)->delete($key_value);
			echo $res;
			return return_json_data(array('id',$key_value),true);

		}catch(Exception $e){

			return return_json_data(array(),false,$e);
		}
	}
	/**
	 * Builds a key value pair array which will latter be converted to a json object and sent to the client side
	 * @param  array   $data    [data or recordset]
	 * @param  boolean $success [state of the operation.whether failed or not]
	 * @param  string  $message [message to return to clientSide for notifications,error msgs etc]
	 * @param  integer $total   [total number  of records in a recordset for paging]
	 * @return array            []
	 */
	public static function return_json_data($data =null,$success = false,$message="",$total=0){
		
		$dataToReturn = array(

			'data' 		=>	$data,
			'success' 	=>	$success,
			'message' 	=>	$message,
			'total'		=>	$total,

			);

		return $dataToReturn;
	}
	/**
	 * A function to filter recordsets.
	 * @param  [type] $query [the query to filter.defaults to null]
	 * @param  string $key   [the columnName to filter the query on.defaults to id]
	 * @param  [type] $array [array of values for filtering]
	 * @param  string $type  [dataType of the column to filter on.defaults to int]
	 * @return [type]        [query]
	 */
	public static function filter_data($query = null,$key='id',$array = null,$type='int'){
				// var_dump($query);
				// var_dump($key);
				// var_dump($array);
				//var_dump($array[$key]);
				if($query == null or $array == null) return;
				switch ($type) {

					case 'int':
						if(array_key_exists($key, $array))
						{
								$query -> where($key,'=',$array[$key]);
						}
						break;
					default:
						
						if(array_key_exists($key, $array))
						{
							if($key != '')
								$query -> where($key,'=',$array[$key]);
						}
						break;
				}
				return $query;
	}
    public static function create_audit_entries($user_id){
        
    	$audit_array = array(

    		'created_at' =>	HelperFunction::get_date(),
    		'updated_at' => HelperFunction::get_date(),
    		'created_by' => $user_id,
    		'updated_by' => $user_id

    		);
    	return $audit_array;
    }
    public static function update_audit_entries($user_id){
        
    	$audit_array = array(

    		'updated_at' => HelperFunction::get_date(),
    		'updated_by' => $user_id

    		);

    	return $audit_array;
    }

}