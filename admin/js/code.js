$(document).ready(function() {
    var $regions = $('#regions');
    var $departements = $('#departements');
     
    // chargement des régions
    $.ajax({
        url: 'france.php',
        data: 'go', // on envoie $_GET['go']
        dataType: 'json', // on veut un retour JSON
        success: function(json) {
            $.each(json, function(index, value) { // pour chaque noeud JSON
                // on ajoute l option dans la liste
                $regions.append('<option value="'+ index +'">'+ value +'</option>');
            });
        }
    });
 
    // à la sélection d une région dans la liste
    $regions.on('change', function() {
        var val = $(this).val(); // on récupère la valeur de la région
 
        if(val != '') {
            $departements.empty(); // on vide la liste des départements
             
            $.ajax({
                url: 'france.php',
                data: 'id_region='+ val, // on envoie $_GET['id_region']
                dataType: 'json',
                success: function(json) {
                    $.each(json, function(index, value) {
                        $departements.append('<option value="'+ index +'">'+ value +'</option>');
                    });
                }
            });
        }
    });
});