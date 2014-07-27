function ask_url(ask,url){
	var detStatus=confirm(ask);
	if (detStatus){
		    location.href = url;
	}else{
		return false;
	}
}


function CheckAll(form,field)
{
var t=0;
var c=form[field];
for(var i=0;i<c.length;i++){
c[i].checked = true;
}
}

function UnCheckAll(form,field)
{
var t=0;
var c=form[field];
for(var i=0;i<c.length;i++){
c[i].checked = false;
}
}

function cCheck(form,field,rID) {
var t=0;
var c=form[field];
for(var i=0;i<c.length;i++){
c[i].checked?t++:null;
}
document.getElementById(rID).value= "Delete Selected ("+t+")";
}

function ask_form(ask,form_name){
	var detStatus=confirm(ask);
	if (detStatus){
		return true;
	}else{
		return false;
	}
}