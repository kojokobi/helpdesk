<?php

class Summary extends Eloquent{


		/**
		 * gets the count of projects filtered by the logged-in user
		 * @return [json] [a json object]
		 */
		public static function count_projects_by_user_id(){

			$filter = array();
			$filter['user_id'] = Auth::user()->id;
			$count = DB::table('Projects')
								->where(function($query) use($filter){

										$query = HelperFunction::filter_data($query,'created_by',$filter,'int');

								})->count();
			return array('count'=>$count);
			//return DataHelper::return_json_data(array('count'=>$count),true,'record loaded',0);
		}
		/**
		 * gets the count of tickets assigned to a logged in user
		 * @return [json] [a json object]
		 */
		public static function count_assigned_tickets(){

			$filter = array();
			$filter['assigned_to'] = Auth::user()->id;
			$count = DB::table('tickets')
								->where(function($query) use($filter){
										$query = HelperFunction::filter_data($query,'assigned_to',$filter,'int');
								})->count();
			
			return array('count'=>$count);
		}
		/**
		 * [count_resolved_tickets description]
		 * @return [type] [description]
		 */
		public static function count_resolved_tickets(){

			$filter = array();
			$filter['assigned_to'] = Auth::user()->id;
			$resolved_tickets = DB::table('tickets')
							->where(function($query) use($filter){
										$query = HelperFunction::filter_data($query,'assigned_to',$filter,'int');
										$query->where('ticket_status_id','=',Config::get('globalconfig.closed_ticket_status_id'));
							})->count();

			$total = Summary::ticket_count();
			$percentage = $resolved_tickets/$total * 100;
			return array('count'=>$resolved_tickets,'percentage'=>round($percentage,2) . '%');
		}
		public static function count_unresolved_tickets(){
			$filter = array();
			$filter['assigned_to'] 	= Auth::user()->id;
			$unresolved_tickets = DB::table('tickets')
								->where(function($query) use($filter){

										$query = HelperFunction::filter_data($query,'assigned_to',$filter,'int');
										$query->where('ticket_status_id','<>',Config::get('globalconfig.closed_ticket_status_id'));

								})->count();

			$total = Summary::ticket_count();
			$percentage = $unresolved_tickets/$total * 100;
			return array('count'=>$unresolved_tickets,'percentage'=>round($percentage,2) . '%');

		}
		public static function ticket_count(){

			$filter = array();
			$filter['assigned_to'] = Auth::user()->id;
			$count = DB::table('tickets')
							->where('assigned_to','=',HelperFunction::get_user_id())
							->count();

			
			return $count;

		}
		public static function get_counts(){

			$counts = array(

				'projects'=>Summary::count_projects_by_user_id(),
				'tickets' =>Summary::count_assigned_tickets(),
				'closed'=>Summary::count_resolved_tickets(),
				'unresolved'=>Summary::count_unresolved_tickets()
			);
			return DataHelper::return_json_data($counts,true,'summaries computed',0);
		}
		public static function get_incoming_tickets(){

			try{

					$filter_array = array();
					$filter_array['assigned_to'] = Auth::user()->id;
					$query_results = DB::table('tickets')
									 ->join('ticket_statuses','ticket_status_id','=','ticket_statuses.id')
									 ->join('ticket_types','ticket_type_id','=','ticket_types.id')
									 ->join('projects', 'project_id', "=", 'projects.id')
									 ->where(function($query) use($filter_array){

									 		$query = DataHelper::filter_data($query,'assigned_to',$filter_array,'int');
									 });
					// print_r($filter_array);
					// var_dump($query_results);
					$total = $query_results->count();
					$data = $query_results->get(

							array('tickets.id as ticket_id','ticket_statuses.id as ticket_status_id','ticket_statuses.name as ticket_status',
									'tickets.title as title','ticket_types.id as ticket_type_id','ticket_types.name as ticket_type',
									'projects.name as project_name'
									)
						);

				$out = array_map(function($data){

					$arr = array();
					$arr['ticketId'] = $data->ticket_id;
					$arr['ticketStatusId'] = $data->ticket_status_id;
					$arr['ticketStatus'] =   $data->ticket_status;
					$arr['title'] 		 =   $data->title;
					$arr['ticketTypeId'] =   $data->ticket_type_id;
					$arr['ticketType'] =   $data->ticket_type;
					$arr['projectName'] = $data->project_name;

					return $arr;

				}, $data);	

				return DataHelper::return_json_data($out,true,"data loaded");

			}catch(Exception $e){

				return HelperFunction::catch_error($e,true,Config::get("globalconfig.global_error_message"));
			}
		}
		public static function get_outgoing_tickets(){

			try{

					$filter_array = array();
					$filter_array['tickets.created_by'] = HelperFunction::get_user_id();
					//print_r($filter_array);
					$query_results = DB::table('tickets')
									 ->join('ticket_statuses','ticket_status_id','=','ticket_statuses.id')
									 ->join('ticket_types','ticket_type_id','=','ticket_types.id')
									 ->join('projects', 'project_id', "=", 'projects.id')
									 ->where(function($query) use($filter_array){

									 		$query = DataHelper::filter_data($query,'tickets.created_by',$filter_array,'int');
									 });
					$total = $query_results->count();
					$data = $query_results->get(

							array('tickets.id as ticket_id','ticket_statuses.id as ticket_status_id','ticket_statuses.name as ticket_status',
									'tickets.title as title','ticket_types.id as ticket_type_id','ticket_types.name as ticket_type',
									'projects.name as project_name'
									)
						);

				$out = array_map(function($data){

					$arr = array();
					$arr['ticketId'] = $data->ticket_id;
					$arr['ticketStatusId'] = $data->ticket_status_id;
					$arr['ticketStatus'] =   $data->ticket_status;
					$arr['title'] 		 =   $data->title;
					$arr['ticketTypeId'] =   $data->ticket_type_id;
					$arr['ticketType'] =   $data->ticket_type;
					$arr['projectName'] = $data->project_name;
					
					return $arr;

				}, $data);	

				return DataHelper::return_json_data($out,true,"data loaded");

			}catch(Exception $e){

				return HelperFunction::catch_error($e,true,Config::get("globalconfig.global_error_message"));
			}
		}
	

}