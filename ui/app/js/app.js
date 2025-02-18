(function () {

    let App = {
        base: __.baseurl,
        api: `${__.baseurl}with/`,
    }

    function makeBiscuits() {
        let s = __.sess.split(`,`)
        return s
            .filter(x => x != s[s.length - 1])
            .reduce((p, v) => {
                p.push(`${s[s.length - 1]}${v}`)
                return p
            }, [])
    }

    function _trySignup() {
        var nm = $("._fullname").val(),
            em = $("._username").val(),
            passw = $("._password").val(),
            repassw = $("._repassword").val();
        if (nm == "") {
            Toast.show(`Enter your fullname`, 4, `error`);
            $("._fullname").focus();
        } else if (em == "" || !isValidEmail(em)) {
            Toast.show(`Enter valid email address`, 4, `error`);
            $("._username").focus();
        } else if (passw == "") {
            Toast.show(`Enter your password`, 5, `error`);
            $("._password").focus();
        } else if (repassw == "" || repassw != passw) {
            Toast.show(`Repeat password not matched.`, 5, `error`);
            $("._repassword").focus();
        } else if ($(".captcha-box").length > 0 && window.grecaptcha && window.grecaptcha.getResponse().length == 0) {
            Toast.show(`Verify you are not a robot.`, 5, `error`);
        } else if (!$('.checkbox input').is(':checked')) {
            Toast.show(`You must agree to Terms of Use.`, 5, `error`);
        } else {
            $(".cover").fadeIn(200);
            withRest(
                `u/signup`,
                {
                    nm: nm,
                    em: em,
                    psw: repassw,
                    robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
                }
            )
                .then(resp => {
                    if(resp.kind == `accountCreated`){
                        $(`.account`).html(`<div class="done rel flex aic jc col" style="margin: 100px auto;width: auto !important;">
                            <div class="ico icon-check-circle color s50"></div>
                            <h2 class="ttl s20 font b">Nice and easy</h2>
                            <h2 class="msg s16 font">${resp.message}</h2>
                        </div>`)
                    }else{
                        let s = __.sess.split(`,`)
                        s.map(m => {
                            if (`${s[s.length - 1]}${m}` in resp) {
                                setCookie(`${s[s.length - 1]}${m}`, resp[`${s[s.length - 1]}${m}`]);
                            }
                        })
                        Toast.show(resp.message || `Redirecting...`, 5, `success`);
                        setTimeout(function () {
                            window.location = `${__.base}cp/onboarding?_svx=${new Date().getTime()}`;
                        }, 1000);
                    }
                })
                .catch(err => {
                    console.log(err)
                    Toast.show(err.message || `Signup Request failed.`, 5, `error`);
                    $(".cover").fadeOut(200);
                    if (window.grecaptcha) { window.grecaptcha.reset(); }
                });
        }
    }

    function _trySignin() {
        var em = $("._username").val(),
            passw = $("._password").val();
        if (em == "" || !isValidEmail(em)) {
            Toast.show(`Enter valid email address`, 5, `error`);
            $("._username").focus();
        } else if (passw == "") {
            Toast.show(`Enter your password`, 5, `error`);
            $("._password").focus();
        } else if ($(".captcha-box").length > 0 && window.grecaptcha && window.grecaptcha.getResponse().length == 0) {
            Toast.show(`Verify you are not a robot.`, 5, `error`);
        } else {
            $(".cover").fadeIn(200);
            withRest(
                `u/signin`,
                {
                    em: em,
                    psw: passw,
                    at: __.at,
                    robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
                }
            )
                .then(resp => {
                    let s = __.sess.split(`,`)
                    s.map(m => {
                        if (`${s[s.length - 1]}${m}` in resp) {
                            setCookie(`${s[s.length - 1]}${m}`, resp[`${s[s.length - 1]}${m}`]);
                        }
                    })
                    Toast.show(resp.message || `Redirecting...`, 5, `success`);
                    setTimeout(function () {
                        window.location = 'next' in queryParams() ? decodeURIComponent(queryParams().next) : `${__.base}${__.at == 'admin' ? 'am/dashboard' : 'cp'}?_svx=${new Date().getTime()}`;
                    }, 1000);
                })
                .catch(err => {
                    Toast.show(err.message || `Signin Request failed.`, 5, `error`);
                    $(".cover").fadeOut(200);
                    if (window.grecaptcha) { window.grecaptcha.reset(); }
                });
        }
    }

    function _tryRecover() {
        var em = $("._username").val();
        if (em == "" || !isValidEmail(em)) {
            Toast.show(`Enter valid email address`, 5, `error`);
            $("._username").focus();
        } else if ($(".captcha-box").length > 0 && window.grecaptcha && window.grecaptcha.getResponse().length == 0) {
            Toast.show(`Verify you are not a robot.`, 5, `error`);
        } else {
            $(".cover").fadeIn(200);
            withRest(
                `u/recover_account`,
                {
                    em: em,
                    robo: $(".captcha-box").length > 0 && window.grecaptcha ? window.grecaptcha.getResponse() : `__`
                }
            )
                .then(resp => {
                    $(".account").html(`<div class="done rel flex aic jc col" style="width: auto !important;">
                <div class="ico icon-check-circle color s50"></div>
                <h2 class="ttl s20 font b">That was easy :)</h2>
                <h2 class="msg s16 font">An email with recovery code has been sent to<br /><span class="b">${em}</span>.<br /><br />Go Check</h2>
            </div>`);
                })
                .catch(err => {
                    Toast.show(err.message || `Recovery Request failed.`, 5, `error`);
                    $(".cover").fadeOut(200);
                    if (window.grecaptcha) { window.grecaptcha.reset(); }
                });
        }
    }

    function _tryRecap() {
        var passw = $("._passw").val(),
            repassw = $("._repassw").val();
        if (passw == "") {
            Toast.show({ html: `Enter new password`, time: 5 });
            $("._passw").focus();
        } else if (repassw == "" || repassw != passw) {
            Toast.show({ html: `Repeat password not matched.`, time: 5 });
            $("._repassw").focus();
        } else {
            $(".cover").fadeIn(200);
            scrollTo("body");
            grab(
                `${App.api}u/update_passw`,
                {
                    passw: repassw,
                    token: getUriParams().token
                },
                resp => {
                    if ("kind" in resp) {
                        $(".account").html(`<div class="done rel flex aic jc col" style="width: auto !important;">
                        <div class="ico icon-tick-circle color s50"></div>
                        <h2 class="ttl s20 font b">Good Job!</h2>
                        <h2 class="msg s16 font">Password updated successfully.</h2>
                    </div>`);
                    } else {
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

    function _tryExit(e) {
        e.preventDefault();
        e.stopPropagation();
        $(".app")
            .append(`<div class="abs cover exit-cover fill" style="z-index: 999999;background: rgba(34, 34, 46, 0.8);backdrop-filter: blur(10px);">
            <div class="loader abs abc"><div class="bar"></div></div>
        </div>`);
        $(".app .exit-cover").css("display", "block")
        withRest(`u/signout`, {})
            .then(resp => {
                makeBiscuits().map(c => removeCookie(c))
                window.location = `${__.base}?utm=${new Date().getTime()}`;
            })
            .catch(err => {
                makeBiscuits().map(c => removeCookie(c))
                window.location = `${__.base}?utm=${new Date().getTime()}`;
            });
    }

    function _onContact() {

        let data = {}
        $(`.sec.b`).find('input').each((__, _) => {
            if ($(_).attr('name')) data[$(_).attr('name')] = $(_).val().trim();
        })
        data.desc = $(`.sec.b textarea`)[0].value.trim()

        function selFocus(n) {
            $(`.sec.b [name=${n}]`).focus();
        }

        let { name, email, company, desc } = data;

        if (!name) {
            Toast.show(`Enter a valid Name`, 4, `error`);
            selFocus('name');
        } else if (!email || !isValidEmail(email)) {
            Toast.show(`Enter a valid Email`, 4, `error`);
            selFocus('email');
        } else if (!company) {
            Toast.show(`Enter your company or website name`, 4, `error`);
            selFocus('company');
        } else if (!desc) {
            Toast.show(`Enter your Question or Message`, 4, `error`);
            selFocus('desc');
        } else {
            $(".contact .sec .cover").fadeIn(200)
            withRest(
                `app/send_feedback`,
                data
            )
                .then(resp => {
                    Toast.show(resp.message || `We have heared you and will get back to you soon...`, 15, `success`);
                    $('.header-tall textarea').val('');
                    $(".cover").fadeOut(200);
                })
                .catch(err => {
                    Toast.show(err.message || `Message was not sent.`, 5, `error`);
                    $(".cover").fadeOut(200);
                });
        }

    }
    
    function _onRefund() {

        let data = {}
        $(`.sec.b`).find('.input').each((__, _) => {
            if ($(_).attr('name')) data[$(_).attr('name')] = $(_).val().trim();
        })

        function selFocus(n) {
            $(`.sec.b [name=${n}]`).focus();
        }

        let { email, product_name, refund_reason } = data;

        if (!email || !isValidEmail(email)) {
            Toast.show(`Enter a valid Email`, 4, `error`);
            selFocus('email');
        } else if (product_name == "") {
            Toast.show(`Choose Product / Plan`, 4, `error`);
            selFocus('product_name');
        } else if (refund_reason == "") {
            Toast.show(`Choose refund reason`, 4, `error`);
            selFocus('refund_reason');
        } else {
            $(".contact .sec .cover").fadeIn(200)
            withRest(
                `app/send_refund`,
                data
            )
                .then(resp => {
                    Toast.show(resp.message || `We have heared you and will get back to you soon...`, 15, `success`);
                    $('.header-tall textarea').val('');
                    $(".cover").fadeOut(200);
                })
                .catch(err => {
                    Toast.show(err.message || `Message was not sent.`, 5, `error`);
                    $(".cover").fadeOut(200);
                });
        }

    }

    function loadChart() {
        if ($(`.gchart`).length > 0) {
            google.charts.load('current', { packages: ['corechart'] });
            google.charts.setOnLoadCallback(function () {
                console.log('renderingCharts')
                $(`.gchart`).each(function () {
                    var id = $(this).attr("data-id");
                    var type = $(this).attr("data-type");
                    var title = $(this).attr("data-title");
                    var colors = $(this).attr("data-colors")
                    var chart;
                    switch (type) {
                        case "donut":
                            var data = google.visualization.arrayToDataTable(window[`gchart_${id}_${type}`])
                            var options = {
                                title: title,
                                pieHole: 0.6,
                                legend: 'none',
                                colors: colors.split(","),
                                chartArea: {
                                    left: 20,
                                    top: 50,
                                    right: 20,
                                    width: 450
                                },
                            };
                            chart = new google.visualization.PieChart(document.getElementById(`gchart_${id}`));
                            chart.draw(data, options);
                            break;
                        case "line":
                            var data = google.visualization.arrayToDataTable(window[`gchart_${id}_${type}`])
                            chart = new google.visualization.AreaChart(document.getElementById(`gchart_${id}`));
                            chart.draw(
                                data,
                                window[`gchart_${id}_${type}_options`],
                                window[`gchart_${id}_${type}_state`]
                            );
                            break;
                    }
                    // var data = new google.visualization.DataTable();
                    // data.addColumn('string', 'Element');
                    // data.addColumn('number', 'Percentage');
                    // data.addRows([
                    //     ['Nitrogen', 0.78],
                    //     ['Oxygen', 0.21],
                    //     ['Other', 0.01]
                    // ]);
                    // var chart = new google.visualization.PieChart(document.getElementById(`gchart-${id}-${type}`));

                });

            });
        }
    }

    function testWebUri(){
        let url = $(".tst .test-uri").val()
        if (!/(http(s?)):\/\//i.test(url)) {
            url = 'https://' + url;
        }
        if(isValidUrl(url)){
            var host = new URL(url).hostname
            $(".tst .test-uri, .tst .test-web-now").hide();
            $(".test-web-url").html(host)
            $(".test-load-speed, .test-locs").html("--")
            $(".test-results").show();
            $(".tst .testing-tmp-uri").html(`testing ${host}...`).show();
            withRest(
                `app/test_url`,
                { ur: url }
            )
            .then(resp => {
                $(".test-load-speed").html(resp.speed)
                $(".test-locs").html(resp.locs)
                $(".tst .testing-tmp-uri").hide();
                $(".tst .test-uri, .tst .test-web-now").show();    
                $('html, body').animate({ scrollTop: $(".test-results").offset().top - 200 }, 400);            
            })
            .catch(err => {
                Toast.show(err.message || `Website test failed. Try again.`, 5, `error`);
                $(".tst .testing-tmp-uri").hide();
                $(".tst .test-uri, .tst .test-web-now").show();
            });
        }else{
            $(".tst .test-uri").focus();
            Toast.show(`Enter valid web url`, 5, `error`);
        }
    }

    function _handleStripe(resp){

        const stripe = Stripe($(".kform").attr("data-spk"));
        const elements = stripe.elements({ clientSecret: resp.next });
        // const linkAuthenticationElement = elements.create("linkAuthentication");
        // linkAuthenticationElement.mount("#link-authentication-element");
        const paymentElementOptions = {
            layout: "tabs",
        };                    
        const paymentElement = elements.create("payment", paymentElementOptions);
        paymentElement.mount("#payment-element");
    
        
        // _checkStatus(stripe, resp.next)
    
        async function handleSubmit(e) {
            e.preventDefault();
            e.stopPropagation();
            $(".premium .cover, .kform .cover").fadeIn(200);      
            const { error } = await stripe.confirmPayment({
              elements,
              confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: window.location.pathname.indexOf("pro/plans") > -1 ? `${__.base}pro/plans?cc=1&pmt=1` : `${__.base}pricing/offer?ccd=1&pmt=1&utc_reff=${new Date().getTime()}`,
                receipt_email: resp.em || __.me.em,
              },
            });
          
            if (error.type === "card_error" || error.type === "validation_error") {
              Toast.show(error.message , 8, 'error');
            } else {
                // console.log(error)
                // Toast.show(`An unexpected error occured. Try Again!` , 8, 'error');
            }
          
            $(".premium .cover, .kform .cover").fadeOut(200);   
        }
    
        $(document).on("submit", "#payment-form", handleSubmit);
        $(".kparts, .choose-pmt, .strp-hide").slideUp(200)
        $(".kform").slideDown(200)
        $(".premium .cover, .processing-pro .cover, .kform .cover").fadeOut(200);
    }

    function _buyNow(){
        var id = $(this).attr("id"),
        pid = $(this).attr("data-id"),
        em = $(this).attr("data-em"),
        pad = $(this).attr("data-pad"),
        pmt = $(".choose-pmts button").length > 0 ? $(".choose-pmts button").attr("data-id") : $(".choose-pmts").attr("data-pmt")
        if(id == 'rpay'){
            if($("#agree").is(":checked") == false){
                Toast.show(`You must confirm your age.`, 5, `error`);
            }else{
                $(".premium .cover").css("background", "rgba(255, 248, 239, 0.95)").show();
                window.location = atob(__nxt);
            }
        }
        else if(id == 'kpay'){
            if($("#agree").is(":checked") == false){
                Toast.show(`You must confirm your age.`, 5, `error`);
            }else{
                $(".premium .cover").fadeIn(200);
                withRest(
                    `app/buy_plan_with_kustom_pay`,
                    {
                        id: pid,
                        mod: 'mo', //$("#price-mod").is(":checked") ? 'mo' : 'yr',
                        pmt: pmt,
                        and: {
                            wx: $(".kpay .buy-now").attr('data-wx'),
                            kpay: $(".kpay .buy-now").attr('data-kpay'),
                            vu: $(".kpay .buy-now").attr('data-vu'),
                            ru: $(".kpay .buy-now").attr('data-ru')
                        }
                    }
                )
                .then(resp => {
                    if (pmt == `ppl`) {
                        $("body").append(resp.next);
                        $("#go_with_paypal").submit();
                    } else if(pmt == `pdl`){
                        if("Paddle" in window){
                            Paddle.Checkout.open({
                                product: pad,
                                email: em,
                                passthrough: resp.next,
                                customData: { 
                                    wx: $(".kpay .buy-now").attr('data-wx'),
                                    kpay: $(".kpay .buy-now").attr('data-kpay'),
                                    vu: $(".kpay .buy-now").attr('data-vu'),
                                    ru: $(".kpay .buy-now").attr('data-ru'),
                                }
                            }); 
                        }
                    }else{
                        _handleStripe(resp)
                        // window.location = resp.next
                    }
                })
                .catch(err => {
                    Toast.show(err.message || `Signup Request failed.`, 5, `error`);
                    $(".cover").fadeOut(200);
                });
            }
        }else if(__.me.ID != -1){
            var id = $(this).attr("data-id")
            var plan = __.plans.find(x => x.id == id)
            var mod = true; //$("#price-mod").is(":checked")
            var pmts = [
                { id: "cc", label: "Credit Card", icon: "cards.svg" },
                { id: "ppl", label: "PayPal", icon: "paypal.svg" },
            ]
            $(`.pre-pricing`).hide();
            $(`.processing-pro`)
                .html(`<div class="abs cover fill strp-hide" style="background: rgba(255,255,255,0.9);"><div class="loader abs abc"><div class="bar"></div></div></div><h1 class="s20 b900 t-c strp-hide">Which payment method do you prefer?</h1>
            <h1 class="s20 t1 t-c strp-hide" style="margin: 5px 0px 30px 0px;">Please choose a payment method</h1>
            <h1 class="s16 bold t2 t-c">Selected Plan: ${plan.name} @ $${plan.price[mod ? 'mo' : 'yr'] * (mod ? 1 : 12)}/${mod ? 'mo' : 'yr'}<span class="strp-hide"> (<a href="javascript:;" class="color bold change-plan tdnh">Change</a>)</span></h1>
            <div class="pform strp-hide rel"><div class="pmts flex col">${pmts.map(p => `<button class="flex aic choose-pmt" data-id="${p.id}"><div class="ico flex aic jcc"><img src="${__.base}ui/app/images/${p.icon}" /></div><h2 class="s18 bold">${p.label}</h2></button>`)}</div>
            <button class="s18 font cfff button bold buy-plan-now" data-id="${id}">Continue</button></div>`)
                .show();
        }else{
            window.location = `${__.base}u/signin?t=${new Date().getTime()}`
        }
    }
    

    function initApp() {
        $(function () {
            var dateFormat = "MM d,yy",
                from = $("#from")
                    .datepicker({
                        defaultDate: "+1w",
                        changeMonth: true,
                        numberOfMonths: 2,
                        dateFormat: dateFormat
                    })
                    .on("change", function () {
                        to.datepicker("option", "minDate", getDate(this));
                    }),
                to = $("#to")
                    .datepicker({
                        defaultDate: "+1w",
                        changeMonth: true,
                        numberOfMonths: 2,
                        dateFormat: dateFormat
                    })
                    .on("change", function () {
                        from.datepicker("option", "maxDate", getDate(this));
                    });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }
                return date;
            }
        });
        $(`.choosen`).chooser()
        // $(document).on("click tap touchstart", ".app-checkbox", function(){
        //     $(this).toggleClass("on");
        //     $(this).attr("data-value", $(this).attr("data-value") == "1" ? 0 : 1);
        // });

        // $(document).on("click tap touchstart", "._try_recover", _tryRecover);
        // $(document).on("click tap touchstart", "._try_recap", _tryRecap);
        $(document).on("click tap touchstart", "._try_sin", _trySignin);
        $(document).on("click tap touchstart", "._try_sup", _trySignup);
        $(document).on("click tap touchstart", "._try_recover", _tryRecover);
        $(document).on("click tap touchstart", "._try_recap", _tryRecap);
        $(document).on("click tap touchstart", ".primary-nav-user-menu a.logout", _tryExit);
        $(document).on("click tap touchstart", ".primary-nav a.user", function (){
            $(`.primary-nav-user-menu`).toggleClass('on');
        });

        //DataTableCheck
        // $(document).on("change", ".data-table .dt-head input:checkbox", function(){
        //     let c = $(this).is(":checked")
        //     $(this).closest('.data-table').find('input:checkbox').prop('checked', c)
        // });
        $(document).on("change", ".data-table .dt-row input:checkbox", function () {
            let p = $(this).closest(`.data-table`)
            let c = $(this).is(":checked")
            if ($(this).closest('.dt-row').hasClass('dt-head')) {
                p.find('input:checkbox').prop('checked', c)
            } else {
                let total = p.find('input[type=checkbox]').filter(function () {
                    return !$(this).closest('.dt-row').hasClass('dt-head')
                }).length;
                let checked = p.find('input[type=checkbox]:checked').filter(function () {
                    return !$(this).closest('.dt-row').hasClass('dt-head')
                }).length;
                p.find('.dt-head input:checkbox').prop("checked", checked == total)
            }
        });
        $(document).on("change", `.pricing #price-mod`, function () {
            let isMo = $(this).is(":checked")
            $(`.premium-price`).each(function () {
                $(this).find(`.prc`).html(`$` + $(this).attr(`data-${isMo ? 'mo' : 'yr'}`))
            })
            $(`.o1`).removeClass(`on`)
            $(`.o1-${isMo ? 'mo' : 'yr'}`).addClass(`on`)
        })

        $(document).on('click', '.send-rr', _onRefund)
        $(document).on('click', '.send-cu', _onContact)
        $(document).on('click', '.presentation .li-hed', function () {
            $(this).next().slideToggle(200)
            $(this).find(`[class^='icon-']`).toggleClass('tru')
        })

        loadChart()
        window.switchMonitoringUptimeApp = function (e) {
            const [lbl, id] = e.split("@@")
            window.location = `${__.base}monitoring/uptime/${id}?t=${new Date().getTime()}`
        }

        $(document).on('click', '.change-plan', function () {
            $(".pre-pricing").show();
            $(".processing-pro").hide();
        })
        $(document).on('click', '.processing-pro .pmts button.choose-pmt', function () {
            $('.processing-pro .pmts button.choose-pmt').removeClass("active")
            $(this).addClass("active")
        })
        $(document).on('click', '.processing-pro .buy-plan-now', function () {
            var id = $(this).attr("data-id")
            if ($('.processing-pro .pmts button.active').length == 0) {
                Toast.show(`Choose payment method`, 4, `error`);
            } else {
                $(".cover").fadeIn(200);
                const pmt = $('.processing-pro .pmts button.active').attr("data-id")
                withRest(
                    `app/buy_plan`,
                    {
                        id: id,
                        mod: 'mo', //$("#price-mod").is(":checked") ? 'mo' : 'yr',
                        pmt: pmt
                    }
                )
                    .then(resp => {
                        if (pmt == `ppl`) {
                            $("body").append(resp.next);
                            $("#go_with_paypal").submit();
                        } else {
                            if(resp.kind == "redirect"){
                                window.location = resp.next
                            }else{
                                _handleStripe(resp)
                            }
                        }
                    })
                    .catch(err => {
                        console.log(err)
                        Toast.show(err.message || `Signup Request failed.`, 5, `error`);
                        $(".cover").fadeOut(200);
                    });
            }
        })
        $('html,body').on('click',function(){
            $('.primary-nav-user-menu').removeClass('on');
        });
        $(document).on('click', '.kpay .buy-now, .price-table .buy-now', _buyNow);
        $(document).on('click', '.test-web-now', testWebUri)
        $(document).on('click', '.mob-menu', function(){
            if($(".mob-nav").length > 0){
                $(`.mob-nav`).toggleClass("open")
            }else{
                $(`.page .page-content`).toggleClass("open")
            }
        })

    }

    $(document).ready(function () {
        initApp()
    })

})();