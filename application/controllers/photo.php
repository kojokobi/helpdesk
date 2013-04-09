<?php 
class Photo_Controller extends Base_Controller{
	public $restful = true;
	public static $rootPath = "public/";
	public static $folderPath = "img/uploads/";

	public function get_photos()
	{
		return Response::json(["msg" => "It works"]);
	}

	public function get_photo($userId)
	{
		$user = User::find($userId);
		if($user){
			return Response::json(
				[
					"message" => "", 
					"data" => [
						"image" => self::$folderPath .$user->image
					],
					"success" => true
				]);
		}else {
			return Response::json(["message" => "This user is not valid", "success" => false]);
		}
	}

	public function post_photo()
	{
		$userId = Input::get("userId");
		$user = User::find($userId);
		$newFileName = Str::random(28) . ".jpg";
		
		if($user){
			//todo: remove old image first
			Input::upload('fileName',self::$rootPath . self::$folderPath,$newFileName);
			$user->image = $newFileName;
			$user->save();
			return Response::json(
				[
					"message" => "Photo Uploaded", 
					"success" => true, 
					"data" => [
						"image" =>  self::$folderPath . $newFileName
					]
				]
			);
		}else {
			return Response::json(["message" => "This user is not valid", "success" => false]);
		}
		
	}

	public function  delete_photo ($id){
		
	}

}