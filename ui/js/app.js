var App = (function(){

	state = {
        base: baseurl,
        api: `${baseurl}with/`,
        debug: true,
        session: false,
        userExpired: false,
        me: null,
    }

	function setState(key, val){
        state[key] = val;
    }

    function me(){
        if(ume){ setState("me", ume) }
        return state.me;
    }

	function joinNow(){
        var em = $(".signup ._username").val(),
        passw = $(".signup ._passw").val(),
        repassw = $(".signup ._repassw").val();
        if(em == "" || !isValidEmail(em)){
            Toast.show({ html: `Enter valid email address`, time: 5 });
            $(".signup ._username").focus();
        }else if(passw == ""){
            Toast.show({ html: `Enter your password`, time: 5 });
            $(".signup ._passw").focus();
        }else if(repassw == "" || repassw != passw){
            Toast.show({ html: `Repeat password not matched.`, time: 5 });
            $(".signup ._repassw").focus();
        }else if($(".captcha-box").length > 0 && window.grecaptcha && window.grecaptcha.getResponse().length == 0){
            Toast.show({ html: `Verify you are not a robot.`, time: 5 });
        }else if($(".app-checkbox").attr("data-value") == "0"){
            Toast.show({ html: `You must agree to Terms of Use.`, time: 5 });
        }else{
            $(".cover").fadeIn(200);
            scrollTo("body");
            grab(
                `${App.api}u/signup`,
                {
                    em: em,
                    psw: repassw,
                    robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
                },
                resp => {
                    if("kind" in resp){
                        const _usi = usi.split(`,`)
                        const _isu = _usi[_usi.length-1]
                        _usi.map(_ => {
                            if(_ != _isu && resp[_]){
                                setCookie(`${_isu}${_}`, resp[_]);        
                            }
                        })
                        setTimeout(function(){ window.location = resp.redirect }, 1000);
                    }else{
                        Toast.show({ html: resp.message || `Request was not processed.`, time: 5 });
                        $(".cover").fadeOut(200);
                        if(window.grecaptcha){ window.grecaptcha.reset(); }
                    }
                },
                err => {
                    Toast.show({ html: `Signup Request failed.`, time: 5 });
                    $(".cover").fadeOut(200);
                    if(window.grecaptcha){ window.grecaptcha.reset(); }
                }
            );
        }
    }

    function signinNow(){
        var em = $(".signin ._username").val(),
        passw = $(".signin ._passw").val(),
        fmi = $(this).hasClass("fmin");
        if(em == "" || !isValidEmail(em)){
            Toast.show({ html: `Enter valid email address`, time: 5 });
            $(".signin ._username").focus();
        }else if(passw == ""){
            Toast.show({ html: `Enter your password`, time: 5 });
            $(".signin ._passw").focus();
        }else if($(".captcha-box").length > 0 && window.grecaptcha && window.grecaptcha.getResponse().length == 0){
            Toast.show({ html: `Verify you are not a robot.`, time: 5 });
        }else{
            $(".cover").fadeIn(200).css("display", "flex");
            scrollTo("body");
            grab(
                `${App.api}u/signin`,
                {
                    em: em,
                    psw: passw,
                    ami: $(`.pg-admin`).length,
                    robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
                },
                resp => {
                    if("kind" in resp){
                        const _usi = usi.split(`,`)
                        const _isu = _usi[_usi.length-1]
                        _usi.map(_ => {
                            if(_ != _isu && resp[_]){
                                setCookie(`${_isu}${_}`, resp[_]);        
                            }
                        })
                        setTimeout(function(){
                            window.location = fmi ? `${App.base}cp/dashboard?_svx=${new Date().getTime()}` : `${App.base}profile?_svx=${new Date().getTime()}`;
                        }, 1000);
                    }else{
                        Toast.show({ html: resp.message || `Request was not processed.`, time: 5 });
                        $(".cover").fadeOut(200);
                        if(window.grecaptcha){ window.grecaptcha.reset(); }
                    }
                },
                err => {
                    Toast.show({ html: `Signin Request failed.`, time: 5 });
                    $(".cover").fadeOut(200);
                    if(window.grecaptcha){ window.grecaptcha.reset(); }
                }
            );
        }
    }

    function initRecover(){
        var em = $("._username").val();
        if(em == "" || !isValidEmail(em)){
            Toast.show({ html: `Enter valid email address`, time: 5 });
            $("._username").focus();
        }else if($(".captcha-box").length > 0 && window.grecaptcha && window.grecaptcha.getResponse().length == 0){
            Toast.show({ html: `Verify you are not a robot.`, time: 5 });
        }else{
            $(".cover").fadeIn(200);
            scrollTo("body");
            grab(
                `${App.api}u/recover`,
                {
                    em: em,
                    robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
                },
                resp => {
                    if("kind" in resp){
                        $(`.account`).html(`<div class="appbox flex col aic jc rel">
                            <a href="/" class="tdn anim"><div class="logo flex aic">
                                <img alt="${siteName} Logo" src="/ui/images/app-icon.svg?v=1.3" height="100">
                            </div></a>            
                            <h2 class="slogan s24 bold tc flex aic jc col">That was easy :)</h2>            
                            <h2 class="slogan s18 tc flex aic jc col">An email with recovery code has been sent to<br /><span class="bold">${em}</span><br /><br />Go Check</h2>            
                        </div>`)
                    }else{
                        Toast.show({ html: resp.message || `Request was not processed.`, time: 5 });
                        $(".cover").fadeOut(200);
                        if(window.grecaptcha){ window.grecaptcha.reset(); }
                    }
                },
                err => {
                    Toast.show({ html: `Recovery Request failed.`, time: 5 });
                    $(".cover").fadeOut(200);
                    if(window.grecaptcha){ window.grecaptcha.reset(); }
                }
            );
        }
    }

    function updatePassw(){
        var passw = $("._passw").val(),
        repassw = $("._repassw").val();
        if(passw == ""){
            Toast.show({ html: `Enter new password`, time: 5 });
            $("._passw").focus();
        }else if(repassw == "" || repassw != passw){
            Toast.show({ html: `Repeat password not matched.`, time: 5 });
            $("._repassw").focus();
        }else{
            $(".cover").fadeIn(200);
            grab(
                `${App.api}u/update_passw`,
                {
                    psw: repassw,
                    token: getUriParams().token
                },
                resp => {
                    if("kind" in resp){
                        $(`.account`).html(`<div class="appbox flex col aic jc rel">
                            <a href="/" class="tdn anim"><div class="logo flex aic">
                                <img alt="${siteName} Logo" src="/ui/images/app-icon.svg?v=1.3" height="100">
                            </div></a>            
                            <h2 class="slogan s24 bold tc flex aic jc col">Good Job!</h2>            
                            <h2 class="slogan s18 tc flex aic jc col">Password updated successfully.</h2>            
                        </div>`)
                    }else{
                        Toast.show({ html: resp.message || `Request was not processed.`, time: 5 });
                        $(".cover").fadeOut(200);
                    }
                },
                err => {
                    Toast.show({ html: `Recovery Request failed.`, time: 5 });
                    $(".cover").fadeOut(200);
                }
            );
        }
    }

    function submitFeedback(){
        var name = $(".uform ._fullname").val(),
        email = $(".uform ._email").val(),
        subject = $(".uform ._subject").val(),
        message = $(".uform ._message").val();
        if(name == ""){
            Toast.show({ html: `Enter your name`, time: 5 });
            $(".uform ._fullname").focus();
        }else if(email == "" || !isValidEmail(email)){
            Toast.show({ html: `Enter valid email`, time: 5 });
            $(".uform ._email").focus();
        }else if(subject == ""){
            Toast.show({ html: `Enter your subject`, time: 5 });
            $(".uform ._subject").focus();
        }else if(message == ""){
            Toast.show({ html: `Enter your message`, time: 5 });
            $(".uform ._message").focus();
        }else if($(".captcha-box").length > 0 && window.grecaptcha && window.grecaptcha.getResponse().length == 0){
            Toast.show({ html: `Verify you are not a robot.`, time: 5 });
        }else{
            $(".cover").fadeIn(200).css(`display`, `flex`);
            grab(
                `${App.api}sense/submit_feedback`,
                {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message,
                    robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
                },
                resp => {
                    if("kind" in resp){
                        $("._subject, ._message").val("");
                        Toast.show({ html: resp.message || `Feedback submit successfully.`, time: 5 });
                    }else{
                        Toast.show({ html: resp.message || `Request was not processed.`, time: 5 });
                    }
                    $(".cover").fadeOut(200);
                },
                err => {
                    Toast.show({ html: `Feedback was not submitted.`, time: 5 });
                    $(".cover").fadeOut(200);
                }
            );
        }
    }

    $(document).on("click tap touchstart", ".app-checkbox", function(){
        $(this).toggleClass("on");
        $(this).attr("data-value", $(this).attr("data-value") == "1" ? 0 : 1);
    });

    $(document).on("click tap touchstart", ".sin-meup", joinNow);
    $(document).on("click tap touchstart", ".sin-mein", signinNow);
    $(document).on("click tap touchstart", ".recv-mein", initRecover);
    $(document).on("click tap touchstart", ".recv-meup", updatePassw);
    $(document).on("click", ".submit-feedback", submitFeedback);
    $(document).on("click tap touchstart", ".sin-meout", function(e){
        e.preventDefault();
        e.stopPropagation();
        $("body")
            .addClass(`blur`)
            .html(`<div class="cover fixed fill flex aic jc">
                <div class="loading abs abc flex aic jc"></div>
            </div>`);
        const _usi = usi.split(`,`)
        const _isu = _usi[_usi.length-1]
        grab(
            `${App.api}u/remove_session`,
            {
                ID: getCookie(`${_isu}${_usi[3]}`),
                robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
            },
            resp => {
                _usi.map(_ => {
                    if(_ != _isu){
                        removeCookie(`${_isu}${_}`);        
                    }
                })
                window.location = `${App.base}?utm=${new Date().getTime()}`;
            },
            err => {
                removeCookie(`__uid`);
                removeCookie(`__ut`);       
                removeCookie(`__ud`);  
                removeCookie(`__si`);  
                window.location = `${App.base}?utm=${new Date().getTime()}`;
            }
        );    
    });
    $(document).idleTimer({ timeout: sessout * 60 * 1000 });
    $(document).on( "idle.idleTimer", function(event, elem, obj){
        if(event.type == `idle`){
            if("uploading" in App){
                if(App.uploader.uploading === false){
                    sessionExpired(true);    
                }
            }else if(window.dlManager){
                if(window.dlManager.downloading === false){
                    sessionExpired(true);
                }
            }else{
                sessionExpired(true);
            }
        }
    });

    return {
        ...state,
        setState,
        me
    }


})();

(function () {


	function loadCartIcon(){
		var cart = getCookie('__cart');
		if(cart == null || cart == '[]'){ cart = []; }else{ cart = JSON.parse(cart); }
		if( cart.length > 0 ){
			$(`.header .mycart`).addClass(`active`)
		}
	}

	function setCartCounter(){
		var cart = getCookie('__cart');
		if(cart == null || cart == '[]'){ cart = []; }else{ cart = JSON.parse(cart); }
		if(cart.length <= 0){
			$(".header .mycart").removeClass("active")
		}else{
			$(".header .mycart").addClass("active")
		}
	}

	function addItemToCart(){
		var item = { id: $(this).attr("data-id") };
		var cart = getCookie('__cart');
		if(cart == null || cart == '[]'){ cart = []; }else{ cart = JSON.parse(cart); }
		if(cart.findIndex(x => x.id == item.id) > -1){
			Toast.show({ html: `Item is already in cart` });
		}else{
			cart.push(item)
			Toast.show({ html: `Item added to cart` });
		}
		setCookie('__cart', JSON.stringify(cart))
		setCartCounter();
	}

	function removeItemFromCart(){
		var id = $(this).attr("data-id");
		if(confirm(`Are you sure you want to remove this Item from cart?`)){
			var cart = JSON.parse(getCookie('__cart'));
			cart = cart.filter(x => x.id != id);
			setCookie('__cart', JSON.stringify(cart))
			setCartCounter();
			$(`.cart-item-${id}`).remove()
			if(cart.length <= 0){
				$(".app-cart").html(`<div class="error-404 flex aic jc">
					<h2 class="s40 font b tc icon-shopping-bag4"></h2>
					<div class="line"></div>
					<h2 class="s18 font" style="text-align: left;">Your cart is empty.<br />Why not start <a href="${App.base}?frm=_cart" class="noul noulh color font">browsing awesome apps</a>.</h2>
				</div>`);
			}
		}
	}

	function initApp() {
        $(document).on(`click`, `.profile .chng-passw`, function(e){
            $(`.profile .section.mt`).hide()
            $(`.profile .ch-form`).show().css("display", "flex");
        });

        $(document).on(`click`, `.profile .ch-passw`, function(e){
            const el = $(`.profile .ch-form [name]`);
            const current = el[0].value.trim();
            const newpass = el[1].value.trim();
            if(!current) return Toast.show({ html: `Current password is required.`, time: 5 });
            if(!newpass) return Toast.show({ html: `New password is required.`, time: 5 });
            grab(
                `${App.api}u/update_password`,
                { cpsw:current, psw:newpass },
                resp => {
                    if("kind" in resp){
                        const _usi = usi.split(`,`)
                        const _isu = _usi[_usi.length-1]
                        _usi.map(_ => {
                            if(_ != _isu && resp[_]){
                                setCookie(`${_isu}${_}`, resp[_]);        
                            }
                        });
                        $(`.profile .section.mt`).show().css("display", "flex");
                        $(`.profile .ch-form`).hide();
                    }                 
                },
                err => {
                    $(".app-cart .cover").fadeOut(200);          
                    Toast.show({ html: err.message || `Request was not processed`, time: 5 });
                    
                }
            );
        });

		$(document).on('mousemove', `.mask`, function (e) {
			const x = e.clientX - $(this).offset().left - $(this).width() / 2;
			const y = e.clientY - $(this).offset().top - $(this).height() / 2;

			const id = $(this).attr(`data-mask-id`)
			document.body.style.setProperty(`--x`, x + 'px');
			document.body.style.setProperty(`--y`, y + 'px');
		});
        $(`html, body`).on(`click`, function(){
            $(`.umenu`).hide()
        })
		$(document).on(`mouseenter`, `.mask`, function () { $(this).addClass(`hover`) })
		$(document).on(`mouseleave`, `.mask`, function () { $(this).removeClass(`hover`) })
		$(document).on(`click`, `.header .you`, function (e) {
            if( $(`.umenu`).length > 0 ){
                e.preventDefault()
                e.stopPropagation()
                $(`.umenu`).show().css("display", "flex")
            }
        })
		$(document).on(`click`, `.sh-menu`, function () {
			$(`.sidebar`).toggleClass(`open`)
		})

		//Index
		if ($(`body`).attr(`data-pg`) == `index`) {

			/**
			 * OnScroll Change Slide Colors
			 */
			var controller = new ScrollMagic.Controller();
			$(`section.sector`).each(function () {
				const sector = $(this)
				const scene = new ScrollMagic.Scene({
					triggerElement: this,
					triggerHook: 0.5,
					offset: 0,
					reverse: true
				})
					.addTo(controller);
				scene.on("enter leave", function (e) {
					$(`.bgs`).css(`opacity`, 0)
					switch (e.type) {
						case "enter":
							$(`.` + sector.attr(`data-scene`)).css("opacity", 1)
							break;
						case "leave":
							$(`.` + sector.prevAll(`section.sector:first`).attr(`data-scene`)).css("opacity", 1)
							break;
					}
				});
			})

			/**
			 * Set Phone Time
			 */
			function setPhoneTime() {
				const dt = new Date()
				const hrs = dt.getHours() > 12 ? dt.getHours() - 12 : dt.getHours()
				$(`.phone-time`).text(`${hrs < 10 ? `0` : ``}${hrs}:${dt.getMinutes() < 10 ? `0` : ``}${dt.getMinutes()}`)
				setTimeout(setPhoneTime, 1000 * 10)
			}

			setPhoneTime()

			/**
			 * Toggle Mobile / Laptop
			 */
			function animationMobileLaptop() {
				$(`.phone, .land`).toggleClass(`laptop`)
				setTimeout(animationMobileLaptop, 1000 * 10)
			}

			setTimeout(animationMobileLaptop, 1000 * 5)

            if ( `our-team` in getUriParams() ){
                setTimeout(() => scrollTo(`.sec-d`), 2000)
            }

		}

		if ($(`body`).attr(`data-pg`) == `account`) {
            if($(`.account`).attr(`section`) == `create` && $(`.account`).attr(`dun`) == 1){
                $(`.account`).html(`<div class="appbox flex col aic jc rel">
                    <a href="/" class="tdn anim"><div class="logo flex aic">
                        <img alt="${siteName} Logo" src="/ui/images/app-icon.svg?v=1.3" height="100">
                    </div></a>            
                    <h2 class="slogan s24 bold tc flex aic jc col">That was easy :)</h2>            
                    <h2 class="slogan s18 tc flex aic jc col">An email with verification code has been sent to your email.<br />Go Check</h2>            
                </div>`)
            }
        }

		if ($(`body`).attr(`data-pg`) == `cart`) {
            $(".cart .methods .item").on("click", function(){
                $(".cart .methods .item").removeClass("on");
                $(this).addClass("on");
                $(".cart .total .pay-ndl").removeAttr("disabled");
            });
            $(".cart .total .pay-ndl").on("click", function(){
                if($(".cart .methods .item.on").length > 0){
                    $(".app-cart .cover").fadeIn(200);
                    var cart = getCookie('__cart');
                    if(cart == null || cart == '[]'){ cart = []; }else{ cart = JSON.parse(cart); }
                    var ids = [];
                    cart.map(x => ids.push(x.id))
                    grab(
                        `${App.api}app/sense/checkout`,
                        {
                            ids: ids.join(),
                            pmt: $(".cart .methods .item.on").attr("data-pmt")
                        },
                        resp => {
                            if($(".cart .methods .item.on").attr("data-pmt") == 'pp'){
                                $("body").append(resp.next);
                                $("#go_with_paypal").submit();
                            }else if($(".cart .methods .item.on").attr("data-pmt") == 'cc'){
                                window.location.href= resp.next;
                            }
                        },
                        err => {
                            $(".app-cart .cover").fadeOut(200);
                            if("oauth" in err.reason){
                                sessionExpired();
                            }else{                        
                                Toast.show({ html: err.message || `Request was not processed`, time: 5 });
                            }
                        }
                    );
                }
            });
            if($(".cart-processed").length > 0){
                removeCookie('__cart');
                setCartCounter();
            }
        }

		if ($(`body`).attr(`data-pg`) == `apps`) {
			const swiper = new Swiper('.swiper', {
				direction: 'horizontal',
				// loop: true,
				slidesPerView: 2,
				spaceBetween: 10,
				navigation: {
					nextEl: '.next-slide',
					prevEl: '.prev-slide',
				},
				breakpoints: {
					// when window width is >= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 20
					},
					// when window width is >= 480px
					480: {
						slidesPerView: 1,
						spaceBetween: 30
					},
					// when window width is >= 640px
					640: {
						slidesPerView: 2,
						spaceBetween: 20
					}
				}
			})
		}

		if($(`.app-detail`).length > 0){
			document.title = $(`.app-detail .head ._l .name`).text()
		}
		$(".addtocart").on("click", addItemToCart);
		$(".rm-fcart").on('click', removeItemFromCart);
		
		loadCartIcon()

	}

	$(document).ready(initApp)


})()