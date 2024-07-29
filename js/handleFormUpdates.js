//Function that checks all input fields and return if any of them are invalid
function allValuesCorrect(){

    let inputs = Array.from(document.getElementsByTagName('input')).concat(Array.from(document.getElementsByTagName('select')));

    for (let i = 0; i < inputs.length; i++) {
        let input = inputs[i];

        console.log(input)
        if(!input.id.includes("-expected")){
            if(input.value != document.getElementById(input.id + "-expected").value){
                return false;
            }
        }
    }

    return true;
}

//Adds event listeners to all input fields (Using the onInput event)
Array.from(document.getElementsByTagName('input')).forEach(input => {
    input.addEventListener('input', function(){
        if(input.value != document.getElementById(input.id + "-expected").value){
            document.getElementById('save-form').style.display = 'flex';
        }else if(allValuesCorrect()){
            document.getElementById('save-form').style.display = 'none';
        }

    });
});

//Adds event listeners to all select tags (Using the onChange event)
Array.from(document.getElementsByTagName('select')).forEach(input => {
    input.addEventListener('change', function(){
        if(input.value != document.getElementById(input.id + "-expected").value){
            document.getElementById('save-form').style.display = 'flex';
        }else if(allValuesCorrect()){
            document.getElementById('save-form').style.display = 'none';
        }
    });
});

//Adds a event listener to the cancel button which reloads the page
document.getElementById('cancel').addEventListener("click", function(){
    
    Array.from(document.getElementsByTagName('input')).forEach(input => {
        if(!input.id.includes('-expected')){
            input.value = document.getElementById(input.id + "-expected").value;
        }
    });

    Array.from(document.getElementsByTagName('select')).forEach(input => {
        if(!input.id.includes('-expected')){
            input.value = document.getElementById(input.id + "-expected").value;
        }
    });

    document.getElementById('save-form').style.display = "none";

});