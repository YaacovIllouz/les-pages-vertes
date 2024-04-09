//Fonction d'Instance
function objet_XMLHttpRequest()
{
    var xhr = null;
 
    if (window.XMLHttpRequest || window.ActiveXObject){
        if(window.ActiveXObject){
            try{
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch(e){
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        else{
            xhr = new XMLHttpRequest();
        }
    }
    else{
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }
    return xhr;
}


//Fonction permettant d'envoyer les données
function Departements(id)
{
    //On déclare un objet
    var objet1 = objet_XMLHttpRequest();
 
    //On défini ce qu'on va faire quand on aura la réponse
    objet1.onreadystatechange = function(){
        //On ne fait quelque chose que si on a tout reçu et que le serveur est ok
        if(objet1.readyState == 4 && objet1.status == 200){
            //On envoie la réponse dans le div "blocDepartements"
            document.getElementById('blocDepartements').innerHTML = objet1.responseText;
        }
        //côté ajax ça merde
        else{
            //on contrôle le statut. Si 404, le fichier ouvert par "open" n'existe pas
            if(objet1.status == 404){
                alert('Erreur ' +objet1.status + '! Le fichier php semble être absent...');
            }
        }
    }
    //Ouverture : méthode, fichier, mode (true=asynchrone | false=synchrone)
    objet1.open("POST", "traitement.php" , true);
    objet1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //envoie
    objet1.send("region=" + id);
}