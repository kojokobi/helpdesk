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
			$filter['user_id'] = Auth::user()->id;
			$count = DB::table('tickets')
								->where(function($query) use($filter){
										$query = HelperFunction::filter_data($query,'assigned_to',$filter,'int');
								})->count();
			
			return array('count'=>$count);
			//return DataHelper::return_json_data(array('count'=>$count),true,'record loaded',0);
		}
		/**
		 * [count_resolved_tickets description]
		 * @return [type] [description]
		 */
		public static function count_resolved_tickets(){

			$filter = array();
			$filter['user_id'] = Auth::user()->id;
			$resolved_tickets = DB::table('tickets')
							->join('ticket_details','tickets.id','=','ticket_details.ticket_id')
							->where(function($query) use($filter){
										$query = HelperFunction::filter_data($query,'assigned_to',$filter,'int');
										$query->where('status_id','=',Config::get('globalconfig.closed_ticket_status_id'));
							})->count();

			$total = Summary::ticket_count();
			$percentage = $resolved_tickets/100 * $total;
			return array('count'=>$resolved_tickets,'percentage'=>round($percentage,2) . '%');
			//return DataHelper::return_json_data(array('count'=>$resolved_tickets,'percentage'=>round($percentage,2)),true,'record loaded',0);
		}
		public static function count_unresolved_tickets(){

			$filter = array();
			$filter['user_id'] 	= Auth::user()->id;
			$unresolved_tickets = DB::table('tickets')
								->join('ticket_details','tickets.id','=','ticket_details.ticket_id')
								->where(function($query) use($filter){

										$query = HelperFunction::filter_data($query,'assigned_to',$filter,'int');
										$query->where('status_id','!=',Config::get('globalconfig.closed_ticket_status_id'));

								})->count();

			$total = Summary::ticket_count();
			$percentage = $unresolved_tickets/100 * $total;
			return array('count'=>$unresolved_tickets,'percentage'=>round($percentage,2) . '%');
			//return DataHelper::return_json_data(array('count'=>$resolved_tickets,'percentage'=>round($percentage,2)),true,'record loaded',0);

		}
		public static function ticket_count(){

			$filter = array();
			$filter['user_id'] = Auth::user()->id;
			$count = DB::table('tickets')
							->count();
			
			return $count;

		}
		public static function get_counts(){

			$counts = array(

				'projects'=>Summary::count_projects_by_user_id(),
				'tickets' =>Summary::count_assigned_tickets(),
				'resolved'=>Summary::count_resolved_tickets(),
				'unresolved'=>Summary::count_unresolved_tickets()
			);
			return DataHelper::return_json_data($counts,true,'summaries computed',0);
		}


}