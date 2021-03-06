function displayMort(){
    var inputToChange = document.getElementById("input_mort");
    if(document.getElementById("check_mort").checked){
        inputToChange.innerHTML = "<p>Date du décès<input type=\"text\" name=\"deces\"/></p>";
    }
    else{
        inputToChange.innerHTML = "";
    }
}
function displayMortReal(){
    var inputToChange = document.getElementById("input_mort");
    if(document.getElementById("check_mortReal").checked){
        inputToChange.innerHTML = "";
    }
    else{
        inputToChange.innerHTML = "";
    }
}


$(document).ready(function(){
    $("#hideDeathReal").hide();
    $("#check_mortReal").change(function(){
        if($(this).is(":checked")){
            $("#hideDeathReal").show();
        }
        else{
            $("#hideDeathReal").hide();
        }

    });
    $("#hideDeath").hide();
    $("#check_mort").change(function(){
        if($(this).is(":checked")){
            $("#hideDeath").show();
        }
        else{
            $("#hideDeath").hide();
        }

    });
    // Show and hide upload image
    var counter = 2;
    $('#del_file').hide();
    $('img#add_file').click(function(){
        $('#file_tools').before('<div class="url_img" id="f'+counter+'">Url d\'une image : <input name="url[]" type="text"/></div>');
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
	
	var counter2 = 2;
    $('#del_file2').hide();
    $('img#add_file2').click(function(){
        $('#file_tools2').before('<div class="url_img2" id="fb'+counter2+'">Url d\'une image : <input name="url[]" type="text"/></div>');
        $('#del_file2').fadeIn(250);
        counter2++;
    });
    $('img#del_file2').click(function(){
        if(counter2==3){
            $('#del_file2').hide(250);
        }
        counter2--;
        $('#fb'+counter2).remove();
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
            $(this).css({ opacity: 0.3 });
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
    $('#delFilm').click(function(){
        return confirm("Voulez vraiment supprimer ce film ?");
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
                    $("#add_err").html("<div class=\"alert\">Mauvais login ou mot de passe !</div>");
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

    /* popup inscription */
    var pop = $('#form_inscr');
    pop.hide();
    $("#inscriptionF").click(function(){
        pop.bPopup({
            speed:800,
            transition:'slideIn'
        });
    });

    /* inscription */
    $("#submit_ins").click(function(){
        var name=$("#nom_ins").val();
        var surname=$("#prenom_ins").val();
        var password=$("#pass_ins").val();
        $.ajax({
            type: "POST",
            url: "index.php?controller=Users&action=signup",
            data: "name="+name+"&surname="+surname+"&pass="+password,
            success: function(html){
                if(html=='true')    {
                    //$("#add_err").html("right username or password");
                    window.location="index.php?controller=Accueil";
                }
            }
        });
        return false;
    });

    $("#add_real").hide();
    $("#type_star").change(function(){
        var value = $("#type_star").val();
        var form_actor = $("#add_acteur");
        var form_real = $("#add_real");
        if(value == "real"){
            form_actor.hide();
            form_real.show();
        }
        else if(value == "actor"){
            form_actor.show();
            form_real.hide();
        }
    });

    // Note Films_View
    $("#rating input:radio").attr("checked", false);
    $('#rating input').click(function () {
        $("#rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
        console.log();

    $('#rating input:radio').change(
    function(){
        var id = $("#rating").attr("film");

        $.ajax({
            type: "POST",
            url: "index.php?controller=Films&action=rate&id=" + id,
            data: "rating=" + this.value + "&comment=" + $("#comment").val(),
            success: function(html) {
                window.location="index.php?controller=Films&action=show&id=" + id;
            }
        });
    });

});

function validateFormStar(){
    var ruleRegex = /^(.+?)\[(.+)\]$/,
    numericRegex = /^[0-9]+$/,
    integerRegex = /^\-?[0-9]+$/,
    decimalRegex = /^\-?[0-9]*\.?[0-9]+$/,
    emailRegex = /^[a-zA-Z0-9.!#$%&amp;'*+\-\/=?\^_`{|}~\-]+@[a-zA-Z0-9\-]+(?:\.[a-zA-Z0-9\-]+)*$/,
    alphaRegex = /^[a-z]+$/i,
    alphaNumericRegex = /^[a-z0-9]+$/i,
    alphaDashRegex = /^[a-z0-9_\-]+$/i,
    naturalRegex = /^[0-9]+$/i,
    naturalNoZeroRegex = /^[1-9][0-9]*$/i,
    ipRegex = /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i,
    base64Regex = /[^a-zA-Z0-9\/\+=]/i,
    numericDashRegex = /^[\d\-\s]+$/,
    urlRegex = /^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/;
    var doc = document.forms["form_star"];
    var myRegex = new RegExp(ruleRegex,'i');
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
