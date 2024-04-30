//Reactualisation automatique de la page service
let chargement = document.getElementById("chargement")
 setInterval(function(){
    let xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function(){
	    if (xhr.readyState == 4 && xhr.status == 200){
		    chargement.innerHTML = this.responseText
	    }
    }
    xhr.open("GET","message.php",true) // Récupération de la page
    xhr.send()
},500) //Actualiser la page tous les 500 millisecondes