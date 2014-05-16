$(document).ready(function(){
    $("#menu").sticky({topSpacing:0});
});

function displayMort(){
    var inputToChange = document.getElementById("input_mort");
    if(document.getElementById("check_mort").checked){
        inputToChange.innerHTML = "<p>Date du décès<input type=\"text\" name=\"mort\"/></p>";
    }
    else{
        inputToChange.innerHTML = "";
    }
}

$(document).ready(function(){
    var counter = 2;
    $('#del_file').hide();
    $('img#add_file').click(function(){
        $('#file_tools').before('<div class="file_upload" id="f'+counter+'"><input name="file[]" type="file">'+counter+'</div>');
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