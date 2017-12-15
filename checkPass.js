function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('psw');
    var pass2 = document.getElementById('cpsw');
    
    //Store the Confimation Message Object ...
    var message = document.getElementById('chek_password');
    //Set the colors we will be using ...
    var goodColor = "#00AF00";
    var badColor = "#FF0000";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords ok"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords non coincidono!"
    }
}  

function checkForm(){
    var email = document.forms["form_iscrizione"]["email"].value;
    var pass1 = document.forms["form_iscrizione"]["password"].value;
    var pass2 = document.forms["form_iscrizione"]["conf_password"].value;
    var nome = document.forms["form_iscrizione"]["nome"].value;
    var cognome = document.forms["form_iscrizione"]["cognome"].value;
    var nick = document.forms["form_iscrizione"]["nickname"].value;
    if( (email == "") || (pass1 == "") || (pass2 == "") || (nome == "") || (cognome == "") (nick == "") ){
        alert('Devi compilare tutti i campi!');
        return false;
    }
    if(pass1 != pass2){
        alert('Le passwords non coincidono!');
        return false;
    }
}