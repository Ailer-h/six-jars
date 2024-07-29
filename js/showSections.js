function showSection(section_id, tab_clicked){

    let sections = document.getElementsByTagName("section");
    let tabs = document.getElementsByTagName('li');

    Array.from(sections).forEach(sec => {
        sec.style.display = "none";
    });

    document.getElementById(section_id).style.display = 'block';

    Array.from(tabs).forEach(tab => {
        tab.classList.remove('selected');
    })

    tab_clicked.classList.add('selected')

}

Array.from(document.getElementsByTagName("section"))[0].style.display = 'block';
Array.from(document.getElementsByTagName('li'))[0].classList.add('selected');