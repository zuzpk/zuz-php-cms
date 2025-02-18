(function(){


function onBoarding(){
    switch($(this).attr("data-step")){
        case "back":
            $(`.steps .stp .sp-1`).removeClass(`onn`)
            $(`.steps .stp .sp-2`).removeClass(`on`)
            $(`.steps .spl-2`).removeClass(`on`)
            $(`.step-2`).hide();
            $(`.step-1`).show();
            break;
        case "url":
            var url = $(`.step-1 .web-url`).val()
            if(!isValidUrl(url)){
                $(`.step-1 .web-url`).focus()
                Toast.show(`Enter valid web url`, 4, 'error')                
            }else{
                $(`.steps .stp .sp-1`).addClass(`onn`)
                $(`.steps .stp .sp-2`).addClass(`on`)
                $(`.steps .spl-2`).addClass(`on`)
                $(`.step-1`).hide();
                $(`.step-2`).show();
            }
            break;
        case "email":
            var url = $(`.step-1 .web-url`).val(),
            em = $(`.step-2 .ur-mail`).val()
            if(!isValidUrl(url)){
                Toast.show(`Enter valid web address`, 4, 'error')
                $(`.step-1 .web-url`).focus()
            }else if(!isValidEmail(em)){
                Toast.show(`Enter valid email address`, 4, 'error')
                $(`.step-2 .ur-mail`).focus()
            }else{
                $(`.step-2 .cover`).fadeIn(200)
                let webUrl = new URL(url)
                withRest(
                    `app/add`,
                    { 
                        is: `web`, 
                        em: em, 
                        host: webUrl.host,
                        protocol: webUrl.protocol,
                    }   
                )
                .then(resp => {
                    $(`.steps .stp .sp-2, .steps .stp .sp-3`).addClass(`onn`)
                    $(`.steps .stp .sp-3`).addClass(`on`)
                    $(`.steps .spl-3`).addClass(`on`)
                    $(`.step-2`).hide();
                    $(`.step-3`).show().css("display", "flex");
                    $(`.skip`).remove()
                })
                .catch(err => {
                    Toast.show(err.message || `Website was not saved`, 4, 'error')
                    $(`.step-2 .cover`).fadeOut(200)                        
                })
            }
            break;
    }
}

function init(){
    $(document).on(`click`, `.steps .next-step`, onBoarding)
    $(document).on(`click`, `.steps .go-back`, onBoarding)
}

$(document).ready(function(){
    init()
})

})()