/*
               ______________________________
              |==============================|
              |           COMPONENT          |
              |==============================|
              |$                            $|
              |$       HORIZONTALE NAV      $|
              |$                            $|
              |==============================|
              |          FILES-INFO          |
              |==============================|
              |    author : Julien Lachaux   |
              |      date : 22-05-2017       |
              |      type : Javascript       |
              |==============================|
              |           CONTACT            |
              |==============================|
              |   lachauxWebDev@gmail.com    |
              |______________________________|
*/

/* OPEN */
var ouverture = document.querySelector('.mainNavIn');

ouverture.addEventListener('click', function() {
  var topMenu = document.querySelector('.mainNav');  
  topMenu.classList.toggle('visible-top');  
});

/* CLOSE */
var fermeture = document.querySelector('.mainNavOut');

fermeture.addEventListener('click', function() {
  var topMenu = document.querySelector('.mainNav');  
  topMenu.classList.toggle('visible-top');  
});