function aceitarCookie(respostaCookie)
{
  mostrarCookie = respostaCookie;
  document.getElementById('cookie').style.visibility = "hidden";
  document.getElementById('cookie').hidden=false;
  localStorage.setItem("mostrarCookie",true);
  // console.log("mostrarCookie agora é: " + mostrarCookie);
}

function mostrarCookie()
{
  mostrarCookie = localStorage.getItem("mostrarCookie");
  // console.log("mostrarCookie inicial é: " + mostrarCookie);
  // true = nao mostrar
  // false/null = mostrar
  if(mostrarCookie)
  {
    document.getElementById('cookie').hidden=true;
  }else
  {
    document.getElementById('cookie').hidden=false;
  }
}