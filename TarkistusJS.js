function validateEmail(Sähköposti) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(Sähköposti);
}

function Submit() {
  $("#result").text("");
  var Sähköposti = $("#Sähköposti").val();
  if (validateEmail(Sähköposti)) {

  } else {
alert("Sähköposti väärin")
  }
  return false;
}

$("#Submit").bind("click", Submit);