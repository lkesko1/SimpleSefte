function pretrazivanje(unos) {
  if (unos.length==0) { 
    document.getElementById("lista").innerHTML="";
    document.getElementById("lista").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) 
    xmlhttp=new XMLHttpRequest();
 	else 
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("lista").innerHTML=this.responseText;
      document.getElementById("lista").style.border="1px";
    }
  }
  xmlhttp.open("GET","search.php?q="+unos,true);
  xmlhttp.send();
}