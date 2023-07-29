function goBack() 
{
  window.history.back();
}


function SignIn()
{
  document.querySelector(".loader").style.display = "block";
  document.querySelector(".loader span").style.display = "block";
  document.querySelector(".bg-loader").style.display = "block";
  document.querySelector(".loader-text").style.display = "block";
  setTimeout(function() {
      document.querySelector(".loader").style.display = "none";
      document.querySelector(".loader span").style.display = "none";
      document.querySelector(".bg-loader").style.display = "none";
      document.querySelector(".loader-text").style.display = "none";
  }, 2000);
}

function signUp()
{
  var user = document.createElement("username").value;
  var pass = document.createElement("password").value;
  var confpass = document.createElement("confirm-password").value;

  
}