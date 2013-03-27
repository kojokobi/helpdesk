var StatusModule = angular.module("statusservicemod",[]);
StatusModule.factory("StatusService", function (){
	return  {
		checkStatus : function (status){
			var label = "label ";
			switch(status.toLowerCase()){
				case "open":
					label += "label-important"
				break;
				case "pending":
					label += "label-warning";
				break;
				case "resolved":
					label += "label-info"
				break;
				case "unresolved":
					label += "label-inverse";
				break;
				case "closed":
					label += 'label-success';
				break;
			}

			return label;
		}
	}
});