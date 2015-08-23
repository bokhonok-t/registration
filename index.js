function validPhone(){
	var re = /^[\+]?(\d+)([\-]+)?/;
	var phone = document.getElementById("phone").value;
	var valid = re.test(phone);
	var warning = document.getElementById("warn_phone");
	if (valid) warning.innerHTML = " ";
	else warning.innerHTML = "Неправильный номер";
	return valid;
}

function validMail(){
	var re = /^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/;
	var mail = document.getElementById("email").value;
	var valid = re.test(mail);
	var warning = document.getElementById("warn_mail");
	if (valid) warning.innerHTML = " ";
	else warning.innerHTML = "Неправильный e-mail";
	return valid;
}

function equalPass(){
	var pass = document.getElementById("pass").value;
	var cpass = document.getElementById("cpass").value;
	var warning = document.getElementById("warn_pass");
	if(pass == cpass) warning.innerHTML = " ";
	else warning.innerHTML = "Пароли не совпадают";
}

function validAddr{
	var re = '';
	var addr = document.getElementById("address").value;
}

function unique(){
	var login = document.getElementById("login").value;
	
}