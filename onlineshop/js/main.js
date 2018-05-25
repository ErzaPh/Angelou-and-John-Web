function _onblur(){
    var pass        = document.getElementById("password").value;
    var conpass     = document.getElementById("conpass").value;
    
    var pass1       = document.getElementById("password1").value;
    var conpass1    = document.getElementById("conpass1").value;
    
    var pass2       = document.getElementById("password2").value;
    var conpass2    = document.getElementById("conpass2").value;
    
    if(pass != conpass){document.getElementById("conpass").value = "";}
    if(pass1 != conpass1){document.getElementById("conpass1").value = "";}
    if(pass2 != conpass2){document.getElementById("conpass2").value = "";}
    
}

function _delete(id, name) {
    bootbox.confirm("Are you sure you want to delete <strong>" +name +"</strong>? ", function(result) {

        if (result === true) {
            window.location.href = site_url + 'admin/delete/' + id;
        }

    });
}

function _multiple_delete(val){ 
    if ($('.entry:checked').length > 0) {

        bootbox.confirm("Deleting <strong>" +$('.entry:checked').length +" " +val +"</strong> . Are you sure?", function(result) {
            if (result === true) {

                var valueDeleted = "";

                $('.entry:checked').each(function() {
                    valueDeleted += $(this).val() + "_";
                });

                window.location.href =  site_url +"admin/delete/?selected=" + valueDeleted;
                
            }
        });
    }
}


$(document).ready(function() {
    $('#_select').click(function(){
        var check = document.getElementById('_select').checked;
        $('.entry').prop('checked', check);
    });   
});