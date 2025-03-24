const hamburgerButton = document.getElementById('hamburger-button');  
const hamburgerMenu = document.getElementById('hamburger-menu');  
const closeHamburger = document.getElementById('close-hamburger');  

$(document).ready(function() {  
    $('a[data-toggle="tab"]').on('click', function() {  
        $('.tab-pane').removeClass('show active');  
        var target = $(this).attr('href');  
        $(target).addClass('show active');  
    });  
});


hamburgerButton.addEventListener('click', function() {  
    hamburgerMenu.style.display = 'block';  
    hamburgerButton.classList.add('open');  
});  

closeHamburger.addEventListener('click', function() {  
    hamburgerMenu.style.display = 'none';  
    hamburgerButton.classList.remove('open'); 
});  

hamburgerMenu.style.display = 'none';    


