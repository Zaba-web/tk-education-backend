const minWindowHeight = 568;
let isMobile = false;
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    isMobile = true;
  } else {
    isMobile = false;
}

document.addEventListener('touchstart', handleTouchStart, false);        
document.addEventListener('touchmove', handleTouchMove, false);

var xDown = null;                                                        
var yDown = null;

function getTouches(evt) {
  return evt.touches ||             
         evt.originalEvent.touches; 
}                                                     

function handleTouchStart(evt) {
    const firstTouch = getTouches(evt)[0];                                      
    xDown = firstTouch.clientX;                                      
    yDown = firstTouch.clientY;                                      
};                                                

function handleTouchMove(evt) {
    if ( ! xDown || ! yDown ) {
        return;
    }

    var xUp = evt.touches[0].clientX;                                    
    var yUp = evt.touches[0].clientY;

    var xDiff = xDown - xUp;
    var yDiff = yDown - yUp;

    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
        if ( xDiff > 0 ) {
            let menuTrigger = document.querySelector(".menu-expand");
            menuTrigger.click();
        } else {
            /* right swipe */
        }  
    } else {
        if ( yDiff > 0 ) {
            if(window.innerHeight>minWindowHeight){
                screenManager.scrollDown();
            }
        } else { 
            if(window.innerHeight>minWindowHeight){
                screenManager.scrollUp();
            }
        }                                                                 
    }

    xDown = null;
    yDown = null;                                             
};

/********/

let screenManager = {
    activeScreen: 0,
    screenCount:4,
    animationPlay:[false,true,true,true],
    animation:[null,aboutUsAnimation,loginAnimation,footerAnimation],
    canScroll: true,
    adjustScreen: function(){
        for(let i = this.activeScreen; i >= 1; i--){
            let screen = document.getElementById(`screen-${i}`);
            anime({
                targets:screen,
                translateY:-screen.offsetTop
            })
        }
    },
    scrollDown: function(){
        if(this.activeScreen < this.screenCount-1){
            this.activeScreen++;
            let screen = document.getElementById(`screen-${this.activeScreen}`);
            setTimeout(()=>{
                if(this.animationPlay[this.activeScreen]){
                    this.animation[this.activeScreen]();
                    this.animationPlay[this.activeScreen] = false;
                }
            },800);
            anime({
                targets:screen,
                easing: 'easeOutCubic',
                borderRadius:0,
                translateY:-(screen.offsetTop),
                scale:[0,1]
            })
        }
        
    },
    scrollUp:function(){
        if(this.activeScreen > 0){
            let screen = document.getElementById(`screen-${this.activeScreen}`);
            anime({
                targets:screen,
                easing: 'easeInOutQuad',
                borderRadius:500,
                translateY:-screen.offsetTop,
                scale:[1,0]
            })
            this.activeScreen--;
            
        }
    }
}

const scrollTop = window.pageYOffset || document.documentElement.scrollTop; 
const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;


function headerAnimation(){
    let preloader = document.querySelector(".preloader-container");
    anime({
        targets: preloader,
        opacity: 0,
        duraction:  500,
        easing: 'easeInOutQuad',
        complete: ()=>{
            preloader.remove();
            showLogo();
            showMenu();
            showHeaderText();
            showHeaderBackground();
        }
    });
}


function showLogo(){
    let logotype = document.querySelector(".logo-container");
    anime({
        targets:logotype,
        translateY:[-120,0],
    });
}

function showMenu(){
    let mainMenu = document.querySelector(".menu-container");
    anime({
        targets:mainMenu,
        easing: 'easeInOutQuad',
        opacity:1,
        complete:()=>{
            let menuLines = document.querySelectorAll(".menu-line");
            anime({
                targets:menuLines,
                scaleX:1
            });
        }
    });
}

function showHeaderText(){
    anime({
        targets:".header-text-anim",
        opacity:1,
        delay: anime.stagger(300),
        easing: 'easeInCubic',
        complete:()=>{
            showHeaderThemeIcons();
            showHeaderThemeDecorations();
        }
    });
}

function showHeaderThemeIcons(){
    anime({
        targets:".header-theme-icon",
        scale: [0,1],
        duration:700,
        delay: anime.stagger(300),
        easing: 'easeInCubic',
        complete:()=>{
            showHeaderButton();
            showScrollHint();
        }
    });
}

function showHeaderThemeDecorations(){
    anime({
        targets:".theme-decoration-line-container",
        scaleX:[0,1],
        easing: 'linear'
    })
}

function showHeaderButton(){
    anime({
        targets:".header-themes-button-container",
        scaleX:[0,1],
        easing: 'easeInCubic',
    })
}

function showScrollHint(){
    anime({
        targets:".scroll-hint",
        translateY:[300,0],
        rotate:"90deg",
        easing: 'easeOutCubic',
        delay:500,
        complete:()=>{
            anime({
                targets:".scroll-hint",
                keyframes:[
                    {translateY:8},
                    {translateY:0}
                ],
                duraction:200,
                easing: 'easeInOutElastic',
                delay:2000,
                loop:true
            });
        }
    })
}
function showHeaderBackground(){
    anime({
        targets:".header-backround-color",
        backgroundPosition:["-1000px 10%","0px 20%"],
        duration:1500,
        easing: 'easeOutCubic',
        delay:500
    });
}

/************/

function aboutUsAnimation(){
    anime({
        targets: ".main-theme-card",
        rotateX: [20,0],
        rotateY: [30,0],
        opacity: 1,
        duraction:1500,
        easing: 'easeOutCubic',
        delay: anime.stagger(300),
    });
    anime({
        targets:".main-themes-wrapper-decoration",
        scaleX:[0,1],
        duraction:1500,
        easing:"linear"
    });
    anime({
        targets:".about-us .title-line",
        scaleX:[0,1],
        easing:"linear"
    });
    anime({
        targets:".about-us .text-align-center, .about-us button",
        opacity:[0,1],
        duraction:1500,
        delay: anime.stagger(300)
    });
    anime({
        targets:".about-us",
        backgroundPosition:["-500px","0px top"],
        easing: 'easeOutCubic',
        delay:800
    })
}

function loginAnimation(){
    anime({
        targets:".auth-reg-container-left",
        translateX:["-100%",0],
        easing: 'easeOutQuad'
    });
    anime({
        targets:".auth-text h3, .reg-text h3",
        opacity:[0,1],
        easing: 'easeOutCubic',
        delay: anime.stagger(300),
    });
    anime({
        targets:".auth-text p, .reg-text p",
        opacity:[0,1],
        easing: 'easeOutCubic',
        delay: anime.stagger(300),
        complete:()=>{
            anime({
                targets:".auth-form h4, .auth-form input, .auth-reg-submit, .auth-form label, .reg-form label, .reg-form h4, .reg-form input, .reg-form select",
                easing: 'easeOutCubic',
                opacity:[0,1]
            });
        }
    });
    anime({
        targets:".auth-lines-black",
        translateX:[-35,0],
        easing: 'easeOutCubic',
        delay:1500
    });
    anime({
        targets:".reg-lines-white",
        translateX:[35,0],
        easing: 'easeOutCubic',
        delay:1500
    });
    anime({
        targets:".auth-decoration-line, .reg-decoration-line",
        scale:[0,1],
        easing: 'easeOutCubic',
        delay:2300
    });
    anime({
        targets:".auth-reg-container-left",
        easing: 'easeOutCubic',
        backgroundPosition:["-500px","1px bottom"],
        delay:1800
    });
}

function footerAnimation(){
    anime({
        targets:".footer-logo",
        easing: 'easeOutCubic',
        opacity:[0,1],
        duraction:1500,
        complete:()=>{
            anime({
                targets:".footer-content",
                easing: 'easeOutCubic',
                rotateX:["90deg",0],
                delay:anime.stagger(300)
            });
            anime({
                targets:".copyright-container",
                easing: 'easeOutCubic',
                scaleX:[0,1]
            })
        }
    });
    anime({
        targets:"footer",
        easing: 'easeOutCubic',
        backgroundSize:"380px",
        delay:2000
    })
}

/**********/


function showFullscreenWindow(multiplayer, targetElement, closeDomElement){
    let position = 100*multiplayer;
    anime({
        targets: targetElement,
        translateX:[position+"%",0],
        borderRadius:0,
        easing:"easeInQuad",
        complete: ()=>{

            anime({
                targets: closeDomElement,
                translateX:[position+"px",0],
                easing:"easeOutExpo",
                duraction:500,
            })
        }
    })
}

function hideFullScreenWindow(multiplayer, targetElement, closeDomElement){
    let position = 100*multiplayer;
    anime({
        targets: closeDomElement,
        translateX:position+"px",
        easing:"easeOutExpo",
        duraction:500,
    });
    anime({
        targets: targetElement,
        translateX:[0,position+"%"],
        borderRadius:"0 100px 100px 0",
        easing:"easeInExpo",
        delay:300
    });
}

/**********/


window.onload = ()=>{
    headerAnimation();
    let scrollHint = document.getElementById("scroll-down");
    scrollHint.onclick = ()=>{
        screenManager.scrollDown();   
    }

    let menuTrigger = document.querySelector(".menu-expand");
    let closeMenuTrigger = document.querySelector(".close-full-menu");

    menuTrigger.onclick = ()=>{
        anime({
            targets: ".full-menu-container",
            translateX:["100%",0],
            borderRadius:0,
            easing:"easeOutExpo"
        })
    }

    closeMenuTrigger.onclick = ()=>{
        anime({
            targets: ".full-menu-container",
            translateX:[0,"100%"],
            borderRadius:"100px 0 0 100px",
            easing:"easeOutExpo"
        })
    }

    let additionalAuthFormOptnTrigger = document.querySelectorAll(".auth-trigger");
    additionalAuthFormOptnTrigger.forEach(element=>{
        element.onclick = ()=>{
            showFullscreenWindow(-1, ".login-second-form-container", ".close-login-second-form");
        }
    });

    let additionalAuthFormCloseTrigger = document.querySelector(".close-login-second-form");
    additionalAuthFormCloseTrigger.onclick = ()=>{
        hideFullScreenWindow(-1, ".login-second-form-container", ".close-login-second-form");
    }

    let additionalRegFormOptnTrigger = document.querySelectorAll(".reg-trigger");
    additionalRegFormOptnTrigger.forEach(element => {
        element.onclick = ()=>{
            showFullscreenWindow(1, ".register-second-form-container", ".close-register-second-form");
        }
    })

    let additionalRegFormCloseTrigger = document.querySelector(".close-register-second-form");
    additionalRegFormCloseTrigger.onclick = ()=>{
        hideFullScreenWindow(1, ".register-second-form-container", ".close-register-second-form");
    }

    let mobileToRegTrigger = document.querySelector("#to-reg");
    mobileToRegTrigger.onclick = ()=>{
        anime({
            targets:".auth-reg-container",
            translateY: -(window.innerHeight),
            easing:"easeOutExpo"
        });
    }

    let mobileToAuthTrigger = document.querySelector("#to-auth");
    mobileToAuthTrigger.onclick = ()=>{
        anime({
            targets:".auth-reg-container",
            translateY:[-(window.innerHeight), 0],
            easing:"easeOutExpo"
        });
    }

    window.onresize = ()=>{
        screenManager.adjustScreen();
    }

    let regError = document.querySelector(".reg-error");
    if(regError != undefined){
        setTimeout(()=>{
            regError.remove();
        },3800);
    }

    /************/

    var messageBox = {
        element: document.querySelector(".alert-container"),
        text: document.querySelector(".alert-text"),
        show: function(text){
            this.text.innerHTML = text;
            anime({
                targets:this.element,
                top:["100vh", 0],
                easing:"easeOutExpo"
            })
        },
        close: function(){
            anime({
                targets:this.element,
                top:[0, "100vh"],
                easing:"easeOutExpo"
            })
        }
    }

    document.querySelector(".close-alert").onclick = ()=>{
        messageBox.close();
    }

    function validate(e){
        let element = e.target;

        let minLength = element.dataset.from;
        let maxLength = element.dataset.to;

        let value = element.value;



        function disable(target = element, msg = null){
            target.classList.add('invalid');
            target.dataset.validate = false;

            if(document.querySelector(`[data-parent='${target.dataset.field}']`) == null){

                let errorMessage = document.createElement("div");
                errorMessage.classList.add("form-error-container");
                errorMessage.dataset.parent = target.dataset.field;

                let messageText = "";

                if(msg == null){
                    messageText = `Довжина поля ${target.dataset.field} повинна бути від ${minLength} до ${maxLength}`;
                }else{
                    messageText = msg;
                }

                errorMessage.innerHTML=`<small class='form-error-msg'>${messageText}</small>`;

                target.nextSibling.nextSibling.after(errorMessage);

            }
        }

        function enable(target = element){
            target.classList.remove('invalid');
            target.dataset.validate = true;

            if(document.querySelector(`[data-parent='${target.dataset.field}']`) != null)
                document.querySelector(`[data-parent='${target.dataset.field}']`).remove();
        }

        if(value.length < minLength || value.length > maxLength){
            disable();
        }else{
            enable();
        }

        if(element.dataset.link != undefined){
            let confirmationInput = document.querySelector(`.${element.dataset.link}`);
            if(confirmationInput.value != value){
                disable(confirmationInput, "Паролі повинні співпадати");
            }else{
                enable(confirmationInput);
            }
        }

    }

    function validateForm(e){
        e.preventDefault();
        let form = e.target;
        let formInputs = form.querySelectorAll(`input`);
        let isFormValid = true;

        formInputs.forEach(element => {
            if(element.dataset.validate != undefined){
                let inputValidate = element.dataset.validate;

                if(inputValidate == 'false'){
                    isFormValid = false;
                }

            }
        });

         if(isFormValid){
            form.submit();
         }else{
            messageBox.show("Для того, щоб зареєструватись, заповніть всі поля форми коректною інформацією.");
        }
    }

    let inputFields = document.querySelectorAll(".validate");
    
    inputFields.forEach(element => {
        element.addEventListener('blur', validate);
    });

    let forms = document.querySelectorAll("form");
    forms.forEach(element => {
        element.addEventListener('submit', validateForm);
    });

}


window.addEventListener('wheel', function(event)
{   
    if(window.innerHeight>minWindowHeight){
        window.scrollTo(scrollLeft, scrollTop); 
        if(screenManager.canScroll){
            if (event.deltaY < 0){
                screenManager.scrollUp();
            }
            else if (event.deltaY > 0){
                screenManager.scrollDown();
            }
            screenManager.canScroll = false;
            setTimeout(()=>{
                screenManager.canScroll = true;
            },150);
        }
    }
});