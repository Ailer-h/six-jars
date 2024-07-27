function toggle_darkmode(){

    document.body.classList.toggle('dark-theme')

    if(document.body.classList.contains('dark-theme')){
        document.getElementById('dark').style.display = "block";
        document.getElementById('light').style.display = "none";
        return;
    }

    document.getElementById('dark').style.display = "none";
    document.getElementById('light').style.display = "block";
    
}