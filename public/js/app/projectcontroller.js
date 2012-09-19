function ProjectController ($scope,$http,Project,MSG) {
	$scope.formTitle = "Add Project";
	$scope.projects = [];

	/**
	 * Gets all projects
	 * @return void
	 */
	function getProjects (){
		Project.query(function (res){
			$scope.projects = res.data;
		})
	}

	$scope.addProject =  function (newProject){
		if (newProject["id"]){
			Project.update(newProject, function (res){
				if (res.success){
					getProjects();
					$scope.clear();
				}else {

				}
				
			});
			
		}else {
			var project =  angular.copy(newProject);
			var theProject = new Project(project);
			window.xx = newProject;
			theProject.$save(function (res){
				//fetch fresh items
				if(res.success){
					getProjects();
					$scope.clear();	
				}else {
					var msg = res.message || "Sorry errors were ecountered"; 
					MSG.show(msg);
				}
				
			});
		}
	}

	$scope.clear =  function (){
		$scope.newProject = {};
		//$scope.title = "Add New User";
		//$scope.statusText = "Add User";
	}


	//make calls here
	getProjects();
}