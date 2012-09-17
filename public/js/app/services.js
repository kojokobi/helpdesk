angular.module('helpdeskServices', ['ngResource']).
factory("User", function ($resource){
	return $resource('user/:id', {id : '@id'}, {
	    query: {method:'GET', params:{}, //isArray:true
	},
	    update : {method : 'PUT'}
	  });
});