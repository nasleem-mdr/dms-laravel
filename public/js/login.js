console.log('test');

function showPass(idElPassword, idShowPassword){

  const INPUTPASSWORD = document.getElementById(idElPassword);
  const SHOWPASSWORD = document.getElementById(idShowPassword);
  
  if(SHOWPASSWORD.checked){
    INPUTPASSWORD.type = 'text';
  } else{
    INPUTPASSWORD.type = 'password';
  }
}

