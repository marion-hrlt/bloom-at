import $ from 'jquery';
import Swup from 'swup';

if(window.location.href !== window.location.origin + '/inscription' && window.location.href !== window.location.origin + '/'){
    const swup = new Swup();
}

//CurrentPage
$(function(){
    document.addEventListener('swup:contentReplaced', (event) => {

        $('.menu a').each(function(){
            let current = location.pathname;

            $(this).addClass('text-gray-400').removeClass('text-gradient font-semibold bg-gradient-to-r from-blue-400 to-pink-400 dark:from-white dark:to-white');
            // if the current path is like this link, make it active
            if($(this).attr('href').indexOf(current) !== -1){
                $(this).removeClass('text-gray-400').addClass('text-gradient bg-gradient-to-r font-semibold from-blue-400 to-pink-400 dark:from-white dark:to-white');
            }
        })
    });
})



