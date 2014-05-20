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