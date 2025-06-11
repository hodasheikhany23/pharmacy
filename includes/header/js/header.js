const menu = document.querySelector('.menu');
const mainMenu = document.querySelector('.main-menu');
const goBack = menu.querySelector('.go-back');
const trigger = document.querySelector('.mobile-nav-trigger');
const closeMenu = document.querySelector('.mobile-menu-close');
const search= document.querySelector('.search-box');
const searchbtn=document.querySelector('.search-icon');
const searchoverlay=document.querySelector('.search-overlay');
const userside=document.querySelector('.header-sidebar')
const usericon=document.querySelector('.user-icon');
const headerSideExit=document.querySelector('.header-side-exit');

let subMenu;
mainMenu.addEventListener('click', (e) => {
    if(e.target.closest('.menu-item-has-children')){
        const hasChildren = e.target.closest('.menu-item-has-children');
        showSubMenu(hasChildren)
    }
})

goBack.addEventListener('click', function(){
    hideSubMenu()
})


trigger.addEventListener('click',function(){
    toggleMenu();
})
closeMenu.addEventListener('click',function(){
    toggleMenu();
})

document.querySelector('.overlay').addEventListener('click', function(){
    toggleMenu();
})

function toggleMenu(){
    menu.classList.toggle('active');
    document.querySelector('.overlay').classList.toggle('active')
}

function showSubMenu(hasChildren){
    subMenu = hasChildren.querySelector('.sub-menu');
    subMenu.classList.add('active');
    subMenu.style.animation = 'slideLeft .5s ease forwards'
    const menuTitle = hasChildren.querySelector(".list-title").textContent
    menu.querySelector('.current-menu-title').innerHTML = menuTitle;
    menu.querySelector('.mobile-menu-head').classList.add('active')
}

function hideSubMenu(){
    subMenu.style.animation = 'slideRight .5s ease forwards'
    setTimeout(()=>{
        subMenu.classList.remove('active');
    },300)
    menu.querySelector('.current-menu-title').innerHTML = "";
    menu.querySelector('.mobile-menu-head').classList.remove('active')
}
searchbtn.addEventListener('click',function(){
    search.classList.add('active-search')
    searchoverlay.classList.add('active-search')
})
searchoverlay.addEventListener('click', function(){
    search.classList.remove('active-search')
    searchoverlay.classList.remove('active-search');
})
usericon.addEventListener('click',function(){
    userside.classList.add('active-sidebar');
})
headerSideExit.addEventListener('click',function(){
    userside.classList.remove('active-sidebar');
})