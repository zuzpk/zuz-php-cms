(function( $ ) {

$.fn.chooser = function(config){

    this.each(function(){

        var id = $(this).attr('data-id'),
        fontSize = $(this).attr(`data-font-size`) || 14,
        defaultValue = $(this).attr('data-default-value'),
        options = $(this).attr('data-options').split(",");
        
        if(!$(this).attr(`data-value`)){
            $(this).attr(`data-value`, options[0])
        }
        $(this).html(`<button class="s15 flex aic">
            <h1 class="lbl s${fontSize} bold">` + (defaultValue && defaultValue != '' ? defaultValue : options[0]) + `</h1>
            <div class="icon-chevron-down"></div>
        </button>
        <ul class="choosen-list abs" data-id="` + id + `">` + (options.map(opt => `<li data-value="` + opt + `">` + (opt.indexOf("@@") > -1 ? opt.split("@@")[0] : opt) + `</li>`).join('')) + `</ul>`);


    });

    $(document).on("click", ".choosen button", function(e){
        e.preventDefault(); e.stopPropagation();
        $(".choosen ul").hide();
        $(this).parent().find("ul").show();
    });
    $(document).on("click", ".choosen ul li", function(e){
        e.preventDefault(); e.stopPropagation();
        let txt = $(this).html()
        let p = $(this).parent().parent();
        let val = $(this).attr("data-value")
        p.attr("data-value", val)
        if(p.attr("data-change") == "1"){
            p.find("button").find(".lbl").html(txt);
        }
        if(p.attr("data-onchange") in window) window[p.attr("data-onchange")](val);
        $(this).parent().hide();
    })

    $('html, body').on('click', function(e){
        $(".choosen ul").hide();
    })

}


$.fn.tokenizer = function(config){
	var fontSize,dataDefault,dataValue,options;
	this.each(function(){
		dataDefault = $(this).attr('data-default-value');
		dataValue = $(this).attr('data-value');
		options = $(this).attr('data-options').split(',');
		fontSize = $(this).attr('data-font-size') || 14;
	
		$(this).html(`<div class="case flex aic">${dataDefault}</div>
			<ul class="token-list abs">${options.map(q => `<li class="tl s${fontSize}" data-value="${q}">${q}</li>`).join('')}</ul>`);
		
	});
	
	let o = 0;
	$(document).on('click', '.tokenizer .token-list .tl', function(e){
		!o ?  (o++,$(this).closest('.tokenizer').find('.case').html("")) : null;
		let txt = $(this).attr('data-value');
		$(this).closest('.tokenizer').find('.case').append(
			`<div class="token flex aic">
				<div class="lbl s${fontSize}">${txt}</div>
				<div class="clc b900">&times;</div>
		</div>`)
		$(this).remove();
	});
	$(document).on('click', '.tokenizer .case .token', function(e){e.stopPropagation();});
	$(document).on('click', '.tokenizer .case .token .clc', function(){
		let txt = $(this).parent().find('.lbl').text();
		
		$(this).closest('.tokenizer')
		.find('.token-list')
		.append(`<li class="tl s${fontSize}" data-value="${txt}">${txt}</li>`);
		
		$(this).parent().hide();

		let d = 0
		$(this).closest('.case').children()
		.each((i,e)=> {
			if(!$(e).attr('style')) d++;
		})

		if(d < 1){
			$(this).closest('.case').html(dataDefault)
			o = 0;
		}
		$(this).parent().remove();
	});

	$(document).on('click', '.tokenizer .case', function(e){
		e.stopPropagation();
		if($(this).parent().find('.token-list .tl').length > 0)
			$(this).parent().find('.token-list').show()
	});
	
	$(`html, body`).on('click', function(){
		$(`.tokenizer .token-list`).hide()
	});
}


}(jQuery))


let KEY = {
    ESCAPE: 27,
    ENTER: 13,
    SPACE: 32,
    LEFT: 37,
    RIGHT: 39,
    UP: 38,
    T: 84
}

var randit = function(len){	
	var text = ""; var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";	
	for (var i = 0; i < len; i++){ 
		text += possible.charAt(Math.floor(Math.random() * possible.length)); 
	}
	return text;    
}

var __Toast = function(){
	var self = this;
	self._container = null;
	
	const _defaults = {
		message: 'Aw snap! Your request was not successfull',
		timeLeft: 4
	}

	const _Toast = (options) => {

		const {html, time, type} = options;
		var tout = null,
		ID = 'toast-' + uuid(),
		toast = document.createElement('div'),
		toastBG = document.createElement('div')
		// btn = document.createElement('button');

		toast.id = ID;
		toast.classList = `toast fixed ${type}`;
		toastBG.id = "bg-" + ID;
		toastBG.classList = "rel flex bg font s14";
		toastBG.innerHTML = html == null ? _defaults.message : html;
		toast.appendChild(toastBG);

		self._container.appendChild(toast);
		
		self.arrangeToasts()
		.then(()=>{
			setTimeout(()=>{
				let tost = document.querySelector("#"+ID);
				tost.classList.add("visible");
				tout = setTimeout(()=>{ _dismiss(); }, (time || _defaults.timeLeft) * 1000);
				setTimeout(()=>{
					let tost = document.querySelector("#bg-"+ID);
					tost.classList.add("bgv");					
				}, 200);
			}, 10);
		});

		const _dismiss = () => {
			tout && clearTimeout(tout);

			let tostbg = document.querySelector("#bg-"+ID);
			tostbg && tostbg.classList.remove("bgv");
			setTimeout(()=>{
				let tost = document.querySelector("#"+ID);
				tost && tost.classList.add("hidden");			
				setTimeout(()=>{
					try{
						document.getElementById(ID).parentNode.removeChild(document.getElementById(ID));
					}catch(e){}
					self.arrangeToasts();
				}, 200);
			}, 200);
		}
	}

	self.arrangeToasts = () => {
		return new Promise((resolve, reject) => {
			var toasts = document.querySelectorAll(".toast"),
			top = 10, i = toasts.length;
			while(i--){
				toasts[i].style.top = top + "px";
				top += parseInt(getComputedStyle(toasts[i]).height.replace('px', '')) + 6;
			}
			resolve();
		});
	}

	self.createContainer = () => {
		var container = document.createElement('div');
		container.id = 'toast-container';
		document.body.appendChild(container);
        self._container = container;
	}

	self.show = (msg, timeout, type) => {
		self._container === null && self.createContainer();
		_Toast({
            html: msg,
            type: type || 'warn',
            time: timeout
        });
	};

	self.dismisAll = () => {
		var toasts = document.getElementsByClassName('toast'),
		i = toasts.length;
		while(i--){
			toasts[i].parentNode.removeChild(toasts[i]);
			self.arrangeToasts();
		}	
	}
}

var Toast = new __Toast();

function uuid() { // Public Domain/MIT
    var d = new Date().getTime();//Timestamp
    var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now()*1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16;//random number between 0 and 16
        if(d > 0){//Use timestamp until depleted
            r = (d + r)%16 | 0;
            d = Math.floor(d/16);
        } else {//Use microseconds since page-load if supported
            r = (d2 + r)%16 | 0;
            d2 = Math.floor(d2/16);
        }
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
}

var setCookie = function(key, value, expiry){
	return Cookies.set(key, value, { expires: expiry || 7 });
}

var getCookie = function(key){
	return Cookies.get(key) || null;
}

var removeCookie = function(key){
	return Cookies.remove(key);
}

var isValidEmail = function(e){
	let reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
	return reg.test(e);
}

var isValidUrl = function(s){
	let url
	try{
		url = new URL(s)
	}catch(e){
		return false
	}
	return url.protocol === "http:" || url.protocol === "https:";
}

var queryParams = function(){
	var search = location.search.substring(1);
	if(search=='') return JSON.parse('{}');	
	var xny = {};
	if("URLSearchParams" in window){
		var items = new URLSearchParams(search);
		for(const [k, v] of items){
			xny[k] = v || ``;
		}
	}else{	
		try{
			xny = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
		}catch(e){
			xny = {};
		}
	}
	return xny;
}

var withRest = async (uri, data, timeout) => {
	return new Promise(async (resolve, reject) => {
		const [u, t, d, i, f] = __.sess.split(",")
		var ut = await getCookie(`${f}${t}`);
		var ud = await getCookie(`${f}${d}`);
		var si = await getCookie(`${f}${i}`);
		var ui = await getCookie(`${f}${u}`);
		var Bearer = randit(12);
		if(`debug` in __){
			uri += uri.indexOf("?") > -1 ? `&${f}de=1` : `?${f}de=1`;
		}
		uri += uri.indexOf(`?`) > -1 ? `&_tm=${new Date().getTime()}` : `?_tm=${new Date().getTime()}`;
		window.__grabToken = axios.CancelToken.source();
		axios.post(
			`${__.base}${__.with}/${uri}`,
			{
				...data,
				[`${f}${t}`]: ut,
				[`${f}${d}`]: ud,
				[`${f}${i}`]: si,
				[`${f}${u}`]: ui,
				[`${f}stmp`]: new Date().getTime()
			},
			{
				timeout: 1000 * (timeout || 60),
				headers: {
					'Content-Type': 'application/json',
					'Authorization': `Bearer ${Bearer}`
				},
				cancelToken: window.__grabToken.token
			}
		)
		.then(function(resp){ 
			if("kind" in resp.data){
				resolve(resp.data); 
			}else{
				reject(resp.data)
			}
		})
		.catch(function(err){
			`debug` in __ && console.log(err);
			if(!err || !err.response || err.response.status != 200 ){
				reject({ 'message' : 'Request Not Processed' });
			}else{
				reject(err.response);
			}
		});
	})
}

function Empty(code, msg){
	return `<div class="error-404 jc flex aic rel">
		<h2 class="s16 font b">${code || `404`}</h2>
		<div class="line"></div>
		<h2 class="s16 font">${msg || `That page does not exist!`}</h2>
	</div>`;
}

function Pagination(list, pageToken, callback){
	var pages = "";

	if("pages" in list && list.pages.length > 1){
		if("prev" in list){
			pages += `<button class="anim icon-chevron-left s16 c333 __paginate" data-pg="${list.prev}"></button>`;
		}
		for(let p = 0; p < list.pages.length; p++){
			pages += `<button class="__paginate anim s16 font b c333"${(pageToken == list.pages[p].id) || ((pageToken == "pg" || pageToken == "__none__") && p == 0) ? " disabled" : ""} data-pg="${list.pages[p].id}">${list.pages[p].lbl}</button>`;
		}
		if(
			list.pages.length > 1
			&& (list.pages.findIndex(x => x.id == pageToken) + 1) < list.pages[list.pages.length-1].lbl
		){
			pages += `<button class="anim icon-chevron-right s16 c333 __paginate" data-pg="${list.next}"></button>`;
		}
		$(".__pagination").html(`<div class="pagination rel flex">${pages}</div>`);
		var _pgt = list.pages.filter(x => x.id == pageToken);
		$(`.__pagin`).html(`Page ${
			_pgt.length > 0 ? _pgt[0].lbl : 1
		} of ${list.total}`);
	}else{
		$(".__pagination").html(``);
		$(`.__pagin`).html(``);
	}

	$(document).on("click", ".__paginate", function(){
		if(callback) callback($(this).attr("data-pg"));
	});
}