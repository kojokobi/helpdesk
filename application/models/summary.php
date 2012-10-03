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
						
			return DataHelper::return_json_data(array('count'=>$count),true,'record loaded',0);
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
						
			return DataHelper::return_json_data(array('count'=>$count),true,'record loaded',0);
		}
		/**
		 * [count_resolved_tickets description]
		 * @return [type] [description]
		 */
		public static function count_resolved_tickets(){

			$filter = array();
			$filter['user_id'] = Auth::user()->id;
			$count_query = DB::table('tickets')
							->join('ticket_details','tickets.id','=','ticket_details.ticket_id');
							// ->where(function($query) use($filter){
							// 			$query = HelperFunction::filter_data($query,'assigned_to',$filter,'int');
							// 	})->count();
							// 	
			
			return DataHelper::return_json_data(array('count'=>$count),true,'record loaded',0);
		}


}