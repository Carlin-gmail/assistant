import 'bootstrap';
import './leftovers';
// Js for the main menu toggle
const toggleBtn = document.querySelector('#menuToggle');
const mobileMenu = document.querySelector('#mobileMenu');

// Check if the elements exist before adding event listeners
if (toggleBtn && mobileMenu) {
    toggleBtn.addEventListener('click', () => {
    toggleBtn.classList.toggle('open');
    mobileMenu.classList.toggle('open');
    });
}
// Close the mobile menu when a link is clicked
const mobileLinks = mobileMenu.querySelectorAll('a');


mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
    });
});



//-------------------------------------------
//-------------------------------------------
    function openImageModal(id) {
        const modal = document.querySelector(id).addEventListener("click", function(){
            alert("clicked");
        });
    }


// alert("script loaded");
