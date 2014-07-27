function ask_url(ask,url,target){
	var detStatus=confirm(ask);
	if (detStatus){
		if(target){
		    location.href = url;
		}else{
			top.location = url;
		}
		
	}else{
		return false;
	}
}

function ask_form(ask,form_name){
	var detStatus=confirm(ask);
	if (detStatus){
		return true;
	}else{
		return false;
	}
}