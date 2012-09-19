// Provide the wiring information in a module
angular.module('myHelpers', []).
  factory('MSG', function($window) {
    return {
      	show : function (message,status, title){
      		var status = status ? status: "error";
      		$.pnotify({
				title: title || "",
				text: message,
				type: status
			});
	    }, 
	    hide : function (){
	    	
	    }
    };
  });