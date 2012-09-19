angular.module('helpdeskServices', ['ngResource']).
factory("User", function ($resource){
	return $resource('users/:id', {id : '@id'}, {
	    query: {method:'GET', params:{}, //isArray:true
	},
	    update : {method : 'PUT'}
	  });
}).factory("Project", function ($resource){
	return $resource('projects/:id', {id : '@id'}, {
	    query: {method:'GET', params:{}, //isArray:true
	},
	    update : {method : 'PUT'}
	  });
});