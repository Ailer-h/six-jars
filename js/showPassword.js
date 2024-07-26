function showPassword(passwordId){
    
    var password = document.getElementById(passwordId);

    if(password.type == "password"){
        password.type = "text";
        document.getElementById('shown').style.display = "block";
        document.getElementById('hidden').style.display = "none";
        return;
    }

    password.type = "password";
    document.getElementById('shown').style.display = "none";
    document.getElementById('hidden').style.display = "block";

}