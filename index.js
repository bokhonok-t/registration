function validPhone(){
	var re = /^[\+]380(\d){9}?/;
	var phone = document.getElementById("phone").value;
	var valid = re.test(phone);
	var warning = document.getElementById("warn_phone");
	if (valid) warning.innerHTML = " ";
	else warning.innerHTML = "Введите номер в формате +380xxxxxxxxx";
	return valid;
}

function validMail(){
	var re = /^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/;
	var mail = document.getElementById("email").value;
	var valid = re.test(mail);
	var warning = document.getElementById("warn_mail");
	if (valid) warning.innerHTML = " ";
	else warning.innerHTML = "<? echo $warn_email?>";
	return valid;
}

function equalPass(){
	var pass = document.getElementById("pass").value;
	var cpass = document.getElementById("cpass").value;
	var warning = document.getElementById("warn_pass");
	if(pass == cpass) warning.innerHTML = " ";
	else warning.innerHTML = "Пароли не совпадают";
}

function validPass(){
	var re = /^[a-z0-9_-]{3,16}$/
	var pass = document.getElementById("pass").value;
	var valid = re.test(pass);
	var warning = document.getElementById("warn_pass_l");
	if(valid) warning.innerHTML = " ";
	else warning.innerHTML = "Пароль короткий или содержит специальные символы";
	return valid;
}

function validName(){
	var re = /^[а-яА-ЯёЁa-zA-Z]+$/;
	var fname = document.getElementById("fname").value;
	
	var valid = re.test(fname);
	var warn = document.getElementById("warn_fname");
	if (valid) warn.innerHTML = " ";
	else warn.innerHTML = "Имя может содержать только буквы";
}

function validLName(){
	var re = /^[а-яА-ЯёЁa-zA-Z]+$/;
	var lname = document.getElementById("lname").value;
	var val = re.test(lname);
	var warning = document.getElementById("warn_lname");
	if (val) warn.innerHTML = " ";
	else warning.innerHTML = "Фамилия может содержать только буквы";
	
}

function validAdd(){
	var re = /^[а-яА-ЯёЁa-zA-Z0-9]+[\s]+/;
	var add = document.getElementById("address").value;
	var valid = re.test(add);
	var warning = document.getElementById("warn_add");
	if (valid) warning.innerHTML = " ";
	else warning.innerHTML = "Адрес должен содержать только буквы и цифры";
}

function validFile(){
	var re = /\.(?:jpg|gif|png)$/i;
	var file = document.getElementById("file").value;
	var valid = re.test(file);
	var warning = document.getElementById("war_file");
	if(valid) warning.innerHTML = "Файл успешно загружен";
	else warning.innerHTML = "Доступна загрузка только gif, png, jpg, файлов";
}

function unique(){
	var login = document.getElementById("login").value;
	$.post("index.php", {login:$(this).val()}), function(data){
		if (data == 'no'){
			$("#warn_login").fadeIn(200,0.1,function(){
				$(this).html('Это имя уже занято');
});
		}
	}
	
}