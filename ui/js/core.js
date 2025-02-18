$.fn.parallax = function(resistance, mouse) {
    $el = $(this);
    TweenLite.to($el, 0.2, {
        x: -((mouse.clientX - window.innerWidth / 2) / resistance),
        y: -((mouse.clientY - window.innerHeight / 2) / resistance)
    });
};

var isMobile = (function(a){return /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

Object.size = function(obj) {
	var size = 0,
	  key;
	for (key in obj) {
	  if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};  

Date.prototype.getFormated = function(){
    var mm = this.getMonth() + 1,
    dd = this.getDate(),
    months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    hours = this.getHours(),
    minutes = this.getMinutes(),
    ampm = hours >= 12 ? "pm" : "am";
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? "0"+minutes : minutes;
    return {
        day: dd < 10 ? "0"+dd : dd,
        month: mm < 10 ? "0"+mm : mm,
        monthName: months[this.getMonth()],
        year: this.getFullYear(),
        hours: hours,
        minutes: minutes,
        ampm: ampm,
        format: (dd < 10 ? "0" + dd : dd) + ' ' + months[this.getMonth()] + ' ' + this.getFullYear()
    }
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

var randit = function(len){	
	var text = ""; var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";	
	for (var i = 0; i < len; i++){ 
		text += possible.charAt(Math.floor(Math.random() * possible.length)); 
	}
	return text;    
}

var grab = async (uri, data, onSuccess, onError) => {
    var ha = await getCookie("__ha");
	var ut = await getCookie(`__ut`);
    var ud = await getCookie(`__ud`);
	var Bearer = ha || randit(12);
	if(App.Debug){
		uri += uri.indexOf("?") > -1 ? "&__debug=true" : "?__debug=true";
	}
	uri += uri.indexOf(`?`) > -1 ? `&_tm=${new Date().getTime()}` : `?_tm=${new Date().getTime()}`;
    axios.post(
		uri,
		{
			...data,
			at: ut,
			ut: ud,
			___uctmp: new Date().getTime()
		},
		{
			headers: {
				'Content-Type': 'application/json'
			}
		}
	)
	.then(function(resp){ onSuccess(resp.data); })
	.catch(function(err){
		// console.log(err)
		if(!err || !err.response || (err.response.status != 200 && err.response.status != 404) ){
			$(".cover").fadeOut(200);
			sessionExpired(true);
		}else{
			onError(err);
		}
	});
}

var generateID = function(len, k){	
	function s(k){
		var text = ""; var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";	
		for (var i = 0; i < k; i++){ text += possible.charAt(Math.floor(Math.random() * possible.length)); }
		return text;
	}
    var id = s(k); if(len > 1){ for(var n = 1; n < len; n++){ id += '-' + s(k); } } 
    return id;
}

var isValidEmail = function(e){
	let reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
	return reg.test(e);
}

var __Toast = function(){
	var self = this;
	self._container = null;
	
	const _defaults = {
		message: 'Aw snap! Your request was not successfull',
		timeLeft: 4
	}

	const _Toast = (options) => {

		const {html, labelOK, type, time} = options;
		var tout = null,
		ID = 'toast-' + generateID(5, 4),
		toast = document.createElement('div'),
		toastBG = document.createElement('div'),
		btn = document.createElement('button');

		toast.id = ID;
		toast.classList = 'toast fixed toast-' + (type || 'error');
		toastBG.id = "bg-" + ID;
		toastBG.classList = "rel flex bg font s14";
		toastBG.innerHTML = html == null ? _defaults.message : html;
		toast.appendChild(toastBG);

		btn.className = 'font b s14';
		btn.textContent = labelOK || "OK";
		btn.addEventListener("click", ()=>{ _dismiss(); });

		toastBG.appendChild(btn);
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
			top = 100, i = toasts.length;
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

	self.show = (options) => {
		self._container === null && self.createContainer();
		_Toast(options);
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

var HideDialog = function(ID, onClose){
	var box = document.getElementById(ID),
	els = document.querySelectorAll(".blurify");
	document.querySelector(".dialogbox-" + ID).classList.remove("visible");
	document.getElementById("msgbox-" + ID).classList.remove("visible");
	$(".blurify").removeClass('blur');
	setTimeout(()=>{
		box.parentNode.removeChild(box);
		try{
		var __ = document.querySelectorAll(".dialogbox:last-child")[0];
		__ && __.classList.remove('dialogbox-blur');
		}catch(e){}          
	}, 200);
	onClose && onClose();
}

var Loader = function(){
	return `<?xml version="1.0" encoding="utf-8"?>
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
		<circle cx="30" cy="50" fill="#2f2f2f" r="20">
		<animate attributeName="cx" repeatCount="indefinite" dur="0.8s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.4s"></animate>
		</circle>
		<circle cx="70" cy="50" fill="#646464" r="20">
		<animate attributeName="cx" repeatCount="indefinite" dur="0.8s" keyTimes="0;0.5;1" values="30;70;30" begin="0s"></animate>
		</circle>
		<circle cx="30" cy="50" fill="#2f2f2f" r="20">
		<animate attributeName="cx" repeatCount="indefinite" dur="0.8s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.4s"></animate>
		<animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1" dur="0.8s" repeatCount="indefinite"></animate>
		</circle>
	</svg>`;
}

var Cover = function(ID){
	return `<div class="cover cover-${ID} abs fill" id="${ID || "__cover__"}">
		<div id="_coverextra_" class="abs abc">${Loader()}</div>
	</div>`;
}

var shakeout;
var Shake = function(el, sec){
	$(el).addClass("shake");
	shakeout && clearTimeout(shakeout);
	shakeout = setTimeout(()=>{
	  $(el).removeClass("shake");
	}, (sec || 0.25) * 1000);        
}

var DialogBox = function(props){
	const { 
		ID,
		title,
		content,
		action,
		close,
		extra
	} = props;
	const { onClose } = close;
	var mbox = `<div class="dialogbox dialogbox-${ID} fixed fill anim">
            <div class="msgbox abs anim" id="msgbox-${ID}">
				${Cover(ID)}
                <div class="msgbox-blur">
					<div class="msgbox-head rel">
						<button class="abs cross font" onClick="HideDialog('${ID}', ${onClose})"></button>
						<h2 class="label tc s18 bold nous wordwrap">${title || "Alert"}</h2>						
					</div>
					<div class="msgbox-content flex col s16 rel">
						<div class="msgbox-inner">
							${content || '<span class="fontn s15">Unable to process request!</span>'}
						</div>
						<div class="msgbox-footer rel flex aic je">`;
						mbox += null == extra ? '' : `<div class="msgbox-footer-extra">${extra}</div>`;
						mbox += `<div class="msgbox-footer-btns">`;
								mbox += action == null ? '<div class="no-button" />' : '';
								mbox += `<button class="anim button msgbox-close s16 nous ${null == action ? "msgbox-action" : ""} msgbtn-cancel-${ID}" onClick="HideDialog('${ID}', ${onClose})">${close.label || "Close"}</button>`;
								mbox += action == null ? '' : `<button class="nous button anim msgbox-action s16 msgbtn-action-${ID} cfff">${action.label || "OK"}</button>`;
							`</div>
						</div>
					</div>
                </div>
			</div>
	</div>`;
	
	return mbox;
	
}

var Dialog = function(title, content, close, action, extra){
	var ID = generateID(4, 6);
	var div = document.createElement('div');
	div.id = ID;
	document.body.appendChild(div);
	try{
	  var els = document.getElementsByClassName("dialogbox");
	  if(els.length > 0){
		for(var i = 0; i < els.length; i++){
		  els[i].classList.add('dialogbox-blur');
		}
	  }
	}catch(e){}
	if(!window.__modals){ window.__modals = []; }
	document.getElementById(ID).innerHTML = DialogBox({
		ID: ID,
		title: title,
		content: content,
		action: action,
		extra: extra,
		close: close
	});
	$(".blurify").addClass('blur');
    setTimeout(()=>{
        document.querySelector(".dialogbox-" + ID).classList.add("visible");
        document.getElementById("msgbox-" + ID).classList.add("visible");
    }, 50);
	return ID;
}

var sessionExpired = function(same, options){
	if("___sessExp" in window){
		return true;
	}else{
		window.___sessExp = same || false;
		const { title, msg, lbl, callback } = options || {};
		Dialog(
			title || "Session Expired",
			`<h2>${msg || `Your Session is expired. Reload your page!`}</h2>`,
			{
				label: lbl || "Reload",
				onClose: callback ? callback : ()=>{
					window.location = window.___sessExp == true ? `${window.location.href}${window.location.href.indexOf(`?`) > -1 ? `&${new Date().getTime()}` : `?${new Date().getTime()}`}` : App.base + 'user/login';
				}
			}
		);
	}
}

var getUriParams = function(){
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

function Empty(code, msg){
	return `<div class="error-404 jc flex aic rel">
		<h2 class="s16 font b">${code || `404`}</h2>
		<div class="line"></div>
		<h2 class="s16 font">${msg || `That page does not exist!`}</h2>
	</div>`;
}

function scrollTo(el, t, p){
	$(p || 'html, body').animate({
		scrollTop: $(el).offset().top
	}, t || 1000);
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