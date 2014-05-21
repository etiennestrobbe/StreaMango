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
    // Show and hide upload image
    var counter = 2;
    $('#del_file').hide();
    $('img#add_file').click(function(){
        $('#file_tools').before('<div class="url_img" id="f'+counter+'"><input name="url[]" type="text"/>Url d\'une image :</div>');
        $('#del_file').fadeIn(250);
        counter++;
    });
    $('img#del_file').click(function(){
        if(counter==3){
            $('#del_file').hide(250);
        }
        counter--;
        $('#f'+counter).remove();
    });
    // Show and hide roles
    $('[id^=hiddenRole]').hide();
    $('[id^=imageRole]').click(function(){
        var val = $(this).attr("id").substr(9);
        var nam = "hiddenRole" + val;
        var check = "checkboxFilm" + val;
        if($('#'+nam).is(':visible')){
            $(this).css({ opacity: 1 });
            $('#'+check).prop('checked',false);
            $('#'+nam).hide(400);
        }
        else{
            $('#'+check).prop('checked',true);
            $('#'+nam).show(400);
            $(this).css({ opacity: 0.5 });
        }
    });
    // Show and hide searchBarre
    var search = $('#barre-recherche');
    search.hide();
    $('#hide_show_button').click(function(){
        if(search.is(':visible')){
            $(this).attr('src','./img/plus.png');
            search.hide(300);
        }
        else{
            search.show(300);
            $(this).attr('src','./img/moins.png');
        }

    });
    $('#delStar').click(function(){
        return confirm("Voulez vraiment supprimer cette star ?");
    })

    /* connexion */
    $("#add_err").css('display', 'none', 'important');
    $("#submit_log").click(function(){
        var username=$("#login").val();
        var password=$("#pass").val();
        $.ajax({
            type: "POST",
            url: "index.php?controller=Users&action=connect",
            data: "login="+username+"&pass="+password,
            success: function(html){
                if(html=='true')    {
                    //$("#add_err").html("right username or password");
                    window.location="index.php?controller=Accueil";
                }
                else    {
                    $("#add_err").css('display', 'inline', 'important');
                    $("#add_err").html("<img src='images/alert.png' />Wrong username or password");
                }
            }
        });
        return false;
    });

    /* deconnexion */
    $('#logout').click(function(){
        $.ajax({
            url:'index.php?controller=Users&action=deconnect',
            success:function(html){
                window.location="index.php?controller=Accueil";
            }
        })
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
