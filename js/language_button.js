function mostrarLang()
{

  document.getElementById('box-lang').style.visibility = "visible";
  window.langElement = document.getElementById('box-lang').style.visibility;

}

function mostrarLang2()
{
  if(window.langElement == "visible")
  {
  document.getElementById('box-lang').style.visibility = "hidden";
  window.langElement = document.getElementById('box-lang').style.visibility;
  
  }else
  {
    mostrarLang()
  }
}
function clickOutLang()
{
  console.log("click out");
  if(window.langElement == "visible")
  {
    document.getElementById('box-lang').style.visibility = "hidden";
    window.langElement = document.getElementById('box-lang').style.visibility;
    console.log("click out confirmed");

  }
}
