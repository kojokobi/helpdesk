angular.module('helpdeskServices', ['ngResource']).
factory("User", function ($resource){
	return $resource('users/:id', {id : '@id'}, {
	    query: {
	    	method:'GET', params:{}, //isArray:true
		},
	    update : {method : 'PUT'}
	});
}).factory("Project", function ($resource){
	return $resource('projects/:id', {id : '@id'}, {
	    query: {
	    	method:'GET', params:{}, //isArray:true
		},
	    update : {method : 'PUT'}
	});
}).factory("ProjectGroup", function ($resource){
	return $resource('projectgroups/:id', {id : '@id'}, {
	    query: {
	    	method:'GET', params:{}, //isArray:true
		},
	    update : {method : 'PUT'}
	});
}).factory("UserGroup", function ($resource){
	return $resource('usergroups/:id', {id : '@id'}, {
	    query: {
	    	method:'GET', params:{}, //isArray:true
		},
	    update : {method : 'PUT'}
	});
}).factory("Ticket", function ($resource){
	return $resource('tickets/:id', {id : '@id'}, {
	    query: {
	    	method:'GET', params:{}, //isArray:true
		},
	    update : {method : 'PUT'}
	});
}).factory("User", function($resource){
	return $resource("users/:id", {id : '@id'},{
		query : {
			method: "GET", params : {}
		},
		update : {method : 'PUT'}
	});
}).factory("Role", function($resource){
	return $resource("roles/:id", {id : '@id'},{
		query : {
			method: "GET", params : {}
		},
		update : {method : 'PUT'}
	});
}).factory("Module", function($resource){
	return $resource("modules/:id", {id : '@id'},{
		query : {
			method: "GET", params : {}
		},
		update : {method : 'PUT'}
	});
}).factory("Securable", function($resource){
	return $resource("securables/:id", {id : '@id'},{
		query : {
			method: "GET", params : {}
		},
		update : {method : 'PUT'}
	});
}).factory("Permission", function($resource){
	return $resource("permisssions/:id", {id : '@id'},{
		query : {
			method: "GET", params : {}
		},
		update : {method : 'PUT'}
	});
});