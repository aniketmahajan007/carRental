/******************************************************************************
 * 					JavaScript for Form Validations                        	  *
 *******************************************************************************/

function Empty_check(formId) {
  //alert(formId);
  var elements = document.getElementById(formId).elements;
  var i;
  for (i = 0; i < elements.length; i++) {
    if (elements[i].value == "") return true;
  }
  return false;
}

function ValidateEmail(inputTextid) {
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (inputTextid.match(mailformat) || inputTextid == "") {
    return true;
  } else {
    return false;
  }
}

function Pass_check(pass, repass) {
  if (pass == repass) return true;
  else return false;
}
