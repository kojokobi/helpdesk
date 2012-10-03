// Provide the wiring information in a module
angular.module('myHelpers', []).
  factory('MSG', function($window) {
    return {
      	show : function (message, status, title){
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
  }).
  factory("ARR",function (){
  	return {
  		sort : function  (arr, fieldToUse) {
  			var name  = fieldToUse || "name";
  			function compare (a,b) {
  				if (a[name] < b[name])
  					return -1;
  				if (a[name] > b[name])
  					return 1;
  				return 0;
  			}

  			return arr.sort(compare);
  		}
  	}
  }).factory("OBJ",function (){
    return {
      rectify : function (obj,_default) {
        var out = {}
        if(obj){
          for (var i in _default){
            console.log(i)
            obj[i] = obj[i] || _default[i]
          }

           out = obj;
        }else {
          out = _default;
        }
       return out;
      }
    }
  });