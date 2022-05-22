let Pages = document.getElementById("Pages");
let Contact = document.getElementById("Contact");
let ButtonPages = document.getElementById("buttonPages");
let ButtonContact = document.getElementById("buttonContact");

function switchToContact() {

    Pages.style.display = 'none';
    Contact.style.display = 'grid';
}

function switchToPages() {
    Pages.style.display = 'grid';
    Contact.style.display = 'none';
}

ButtonPages.onclick = switchToPages;
ButtonContact.onclick = switchToContact;