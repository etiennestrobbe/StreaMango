$(document).ready(function(){
    $("#menu").sticky({topSpacing:0});
});

function displayMort(){
    var inputToChange = document.getElementById("input_mort");
    if(document.getElementById("check_mort").checked){
        inputToChange.innerHTML = "<p>Date du décès<input type=\"text\" name=\"deces\"/></p>";
    }
    else{
        inputToChange.innerHTML = "";
    }
}

$(document).ready(function(){
    var counter = 2;
    $('#del_file').hide();
    $('img#add_file').click(function(){
        $('#file_tools').before('<div class="url_img" id="f'+counter+'">Url d\'une image<input name="url[]" type="text">'+counter+'</div>');
        $('#del_file').fadeIn(0);
        counter++;
    });
    $('img#del_file').click(function(){
        if(counter==3){
            $('#del_file').hide();
        }
        counter--;
        $('#f'+counter).remove();
    });
});

function validateFormStar(){
    var doc = document.forms["form_star"];
    var myRegex = new RegExp('^[A-Z][a-z]{2,20}','i');
    //check name
    if(!(myRegex.test(doc["nom"].value))){
        alert("Nom incorrect (max 20 caractères)");
        return false;
    }
    if(!(myRegex.test(doc["prenom"].value))){
        alert("Prénom incorrect (max 20 caractères)");
        return false;
    }
    myRegex = new RegExp('^[0-9]{4}','i');
    if(!(myRegex.test(doc["naissance"].value))){
        alert("Année de naissance incorrect (format YYYY)");
        return false;
    }
    if(typeof doc["deces"] != 'undefined'){
        if(!(myRegex.test(doc["deces"].value))){
            alert("Année de naissance incorrect (format YYYY)");
            return false;
        }
        var age = parseInt(doc["deces"].value)-parseInt(doc["naissance"].value) ;
        if(age > 130 || age < 0){
            alert("Année de naissance ou de décès incorrect (age \'"+age+" ans\' incohérent)");
            return false;
        }
    }

}