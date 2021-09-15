let iconMenu = document.getElementById('iconMenu');
let sideBar = document.getElementById('sideBar');
let mainContent = document.getElementById('mainContent');
let w = window.innerWidth;
window.addEventListener("resize", () => {
   w = window.innerWidth;
} )

function responsiveSideBar(){
   if (w <= 750){
    

       if(sideBar.style.display == 'none'){
        sideBar.style.display = 'block';
        mainContent.style.width = '100%';
        iconMenu.style.color = 'rgb(106, 105, 109)';
        
        
       }else{
        sideBar.style.display = 'none';
        iconMenu.style.color = 'rgb(106, 105, 109)';
        iconMenu.style.marginLeft = '4px'
        mainContent.style.width = '100%';
       }
      
   }else{
    if(sideBar.style.display == 'none'){
        sideBar.style.display = 'block';
        mainContent.style.width = '100%';
    }else{
        sideBar.style.display = 'none';
        mainContent.style.width = '100%';
        sideBar.style.transition = '0.5s';
      
    }
   }
}