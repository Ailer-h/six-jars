//Adds event listeners to all input fields (Using the onInput event)
Array.from(document.getElementsByTagName('input')).forEach(input => {
    input.addEventListener('input', function(){
        document.getElementById('save-form').style.display = 'flex';
    });
});

//Adds event listeners to all select tags (Using the onChange event)
Array.from(document.getElementsByTagName('select')).forEach(input => {
    input.addEventListener('change', function(){
        document.getElementById('save-form').style.display = 'flex';
    });
});

//Adds a event listener to the cancel button which reloads the page
document.getElementById('cancel').addEventListener("click", function(){
    location.reload();
});