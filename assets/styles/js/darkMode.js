import $ from 'jquery';

//DarkMode
$(function(){
    $('.dark-mode').on('click', function(){
        $('html').toggleClass('dark');

        const element = document.querySelector('.mode');  

        if(element.classList.contains("lightmode")){
            $('.mode').removeClass('lightmode').addClass('darkmode');
            $('.faMod').removeClass('fa-sun text-indigo-600').addClass('fa-moon text-white');
            $('.mode-text').text('Mode sombre');

            localStorage.removeItem("theme");
            localStorage.setItem("theme", "dark");
            console.log('darkmode active');
        } else if (element.classList.contains("darkmode")){
            $('.mode').removeClass('darkmode').addClass('lightmode');
            $('.faMod').removeClass('fa-moon text-white').addClass('fa-sun text-indigo-600');
            $('.mode-text').text('Mode clair');
            
            localStorage.removeItem("theme");
            localStorage.setItem("theme", "light");
            console.log('lightmode active');
        }
    });

  // Get the sessionStorage item and the value mode
    if (localStorage.getItem('theme') === 'dark') {
        $('html').addClass('dark');

        $('.mode').removeClass('lightmode').addClass('darkmode');
        $('.faMod').removeClass('fa-sun text-indigo-600').addClass('fa-moon text-white');
        $('.mode-text').text('Mode sombre');

    } else if (localStorage.getItem('theme') === 'light') {
        $('html').removeClass('dark');

        $('.mode').removeClass('darkmode').addClass('lightmode');
        $('.faMod').removeClass('fa-moon text-white').addClass('fa-sun text-indigo-600');
        $('.mode-text').text('Mode clair');
    }
})