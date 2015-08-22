//function validPhone(){
//	var re = /^[\+]?(\d+)([\-]+)?/;
//	var phone = document.getElementById("phone").value;
//	var valid = re.test(phone);
//	var warning = document.getElementById("warn");
//	if (valid) warning.outerHTML;
//	else warning.innerHTML = "Wrong Phone";
//	return valid;
//}
//
//function validMail(){
//	var re = /^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/;
//	var mail = document.getElementById("email").value;
//	var valid = re.test(mail);
//	var warning = document.getElementById("warn");
//	if (valid) return true;
//	else return false;
//	return valid;
//}
//
//function valid(){
//	if(!validPhone()) document.getElementById("warn").innerHTML = "wrong phone";
//	if(!validMail()) document.getElementById("warn").innerHTML = "wrong mail";	
//}

function showError(container, errorMessage) {
      container.className = 'error';
      var msgElem = document.createElement('span');
      msgElem.className = "error-message";
      msgElem.innerHTML = errorMessage;
      container.appendChild(msgElem);
    }

 function resetError(container) {
	 container.className = '';
	 if (container.lastChild.className == "error-message") {
		 container.removeChild(container.lastChild);
     }
 }

function validate(form) {
	var elems = form.elements;

      resetError(elems.pass.parentNode);
      if (elems.pass.value != elems.cpass.value) {
        showError(elems.pass.parentNode, ' Пароли не совпадают.');
      }

    }