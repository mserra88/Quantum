/*
window.addEventListener('load', function(event) {
	  var fadeTarget = document.getElementById("overlay");
		var fadeEffect = setInterval(function () {
			if (!fadeTarget.style.opacity) {
				fadeTarget.style.opacity = 1;
			}
			if (fadeTarget.style.opacity > 0) {
				fadeTarget.style.opacity -= 0.1;
			} else {
				clearInterval(fadeEffect);
				fadeTarget.setAttribute('class', 'd-none');
			}
			
		}, 5);
	
		//document.getElementById("spinner").setAttribute('class', 'd-none');
		//document.getElementById("overlay").setAttribute('class', 'd-none');
		document.body.className = document.body.className.replace('noscroll','');
});
*/

	
//FUNCTIONS
/*
    var GetSearch = document.getElementById('search');
         GetSearch.addEventListener("keyup", function(){
             //InfoData = {slug:GetSearch.value}
             $.ajax({
                type: "GET",
                url: 'http://192.168.1.99/ganardinero/wp-json/wp/v2/posts?search=' + GetSearch.value ,
                data: '',
                datatype: "html",
                success: function(result) {
                    console.log(result);
                }
            });
         });

*/
/*
const arrayColumn = (arr, n) => arr.map(x => x[n]);

var contador = 0;

var array_id_contador = new Array();

function ocultaresto(id, count, type){

if(type=='+'){
	contador = contador+1;
}else if(type=='-'){
	contador = contador-1;
}

array_id_contador.push(new Array(id, contador));
var arrcol1 = arrayColumn(array_id_contador, 1);

var arrcol0_index = arrayColumn(array_id_contador, 0).indexOf(id);

if (arrcol0_index !== -1) {
	arrcol1[arrcol0_index] = contador;
}

arrayColumn(array_id_contador, 1)

alert('oka');


}*/

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
})

function click(id) { document.getElementById(id).click(); }

function copy(event, id) { 
	/* Get the text field */
	var copyText = document.getElementById("myInput"+id);

	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */
	/* Copy the text inside the text field */
	document.execCommand("copy");
	//notify("Copied the text: " + event.target.getAttribute('value')); 
	
	event.preventDefault();
}

function deleteNew(name) {
	var cookie = 'cookie';
    var matched = document.cookie.match(RegExp(cookie + "=.[^;]*"));
    if(matched){ name = new Array(matched[0].split('=')[1], name); }
	
	/*
	var days = 1;
	if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
    }
		
	document.cookie = cookie + '=' + name + expires + ";path=/";
	*/
	//document.cookie = cookie + '=' + name +"; expires = Thu, 01 Jan 1970 00:00:00 GMT"

	document.cookie = cookie + '=' + name + ";path=/";
	
}

function getData(event) { return event.relatedTarget.getAttribute('data-bs-whatever'); }

function notify(message) { alert(message); event.preventDefault(); }

function resetUrl(parameter) {



	var windowLocation = window.location;
	var url = 'http://'+windowLocation.hostname+windowLocation.pathname;	



	if(parameter){ 
		url = url + parameter;
	} /*else{
		const urlParams = new URLSearchParams(windowLocation.search);

		if(urlParams){
			url = url + '?' + urlParams + '&closemodal=true';
		}
	}*/
	
	
	windowLocation.replace(url);
}

var closeModalManually = true;
function resetModalTimer() {  
//Ocultamos la categoria con todas las noticias vistas.(podriamos ocultar todos los glows, y evitar el refresco...)
//da problemas
//document.querySelector("#quantum-navbar .fid-"+new URLSearchParams(window.location.search).get('news')).setAttribute('class', 'd-none');

	
	setTimeout(function () { 
		closeModalManually = false;
		bootstrap.Modal.getInstance(document.getElementById('exampleModal-2')).hide();	
		
		//var next = document.getElementById('quantum-navbar').getAttribute('stories').split(',')[0];
		var news = 'news';

		var newparam = new URLSearchParams(window.location.search).get(news)
		var next = null;
		if(newparam){
			var navbar = document.getElementById('quantum-navbar');
			
			if(navbar){
				next = navbar.getAttribute('story');
				if(!next){
					next = document.querySelector("#quantum-navbar .fid-"+newparam).getAttribute('story');
				}
				
				if(next){ next = '?'+news+'='+next; } //?view&as&news=
			}
		}
		
		resetUrl(next);
	}, 15000); 
	
	
}



//METHODS
function documentReady(modalid, del) {
	//if(modaldetail) {  window.scrollTo( 0, leercookie('alturaqvamos')[0].split('=')[1] ); }

    if(!leercookie('ocultardiv')){ toggledivcookies(); }

	if(del){ deleteNew(del); }
	
	if(modalid){ (new bootstrap.Modal(document.getElementById('exampleModal-'+modalid))).show(); }
	
/*
	if(document.getElementById("settings-filter")) {
		if(feat) { 
		
			if(feat == 1){ click('nav-featured-tab'); }
			click('tab-nav-' + as + '-' + feat);
			
		}
	}
*/
	
	//if(showCollapse){ (new bootstrap.Collapse(document.getElementById('collapseZero'))).show(); }	
	
	
}

/*var anchor = document.querySelectorAll('.alturareader');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {
				document.cookie = 'alturaqvamos' + '=' + window.scrollY + ";path=/";

		});
	});	
}*/	

//EVENTS
function leercookie(cookie) {
return document.cookie.match(RegExp(cookie + "=.[^;]*"));
}

function toggledivcookies() {
document.getElementById("divcookies").classList.toggle('d-none');
}

function ocultardivcookies(persitent=true) {
	if(persitent){
	document.cookie = 'ocultardiv' + '=' + 'true' + ";path=/";
	}
	toggledivcookies();
}



var anchor = document.getElementById("botoncerrarcookies");
if(anchor) { 

anchor.addEventListener('click', function (event) { 
event.preventDefault();

ocultardivcookies(false);
});


 }

var anchor = document.getElementById("botonaceptarcookies");
if(anchor) { 

anchor.addEventListener('click', function (event) { 
event.preventDefault();

ocultardivcookies();
});


 }


var anchor = document.getElementById("botonrechazarcookies");
if(anchor) { 

anchor.addEventListener('click', function (event) { 
event.preventDefault();
ocultardivcookies();

});


 }


var anchor = document.getElementById("botoninfocookies");
if(anchor) { 

anchor.addEventListener('click', function (event) { 
event.preventDefault();
(new bootstrap.Modal(document.getElementById('exampleModal-4'))).show();
});


 }



var anchor = document.querySelectorAll('.hider');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {
			
			var id = 'showme'+item.getAttribute('rid');
			var abierto = document.getElementById(id).getAttribute('aria-expanded');	
			
if(abierto == 'false'){
	click(id);	
}else{
	//alert('focusear');
}
event.preventDefault();

		});
	});
}
/*
var anchor = document.querySelector('#comment.principal');
if(anchor) {
	anchor.addEventListener('click', function (event) { 
		
		document.querySelector('#author.principal').classList.toggle('d-none');
		document.querySelector('#submit.principal').classList.toggle('d-none');
		document.querySelector('.cancelador').classList.toggle('d-none');

	
	
	});
}

var anchor = document.querySelector(".cancelador");
if(anchor) {
	anchor.addEventListener('click', function (event) { 
		document.querySelector('#author.principal').classList.toggle('d-none');
		document.querySelector('#submit.principal').classList.toggle('d-none');
		document.querySelector('.cancelador').classList.toggle('d-none');
		event.preventDefault();
	});
}
*/

/*
var anchor = document.querySelectorAll('.hider');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {
			item.classList.toggle('d-none');	
		});
	});
}

var anchor = document.querySelectorAll('.shower');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {
			var id = 'hideme'+item.getAttribute('rid');
			document.getElementById(id).classList.toggle('d-none');
		});
	});
}
*/


/*
var anchor = document.getElementById("cancel-comment");
if(anchor) { anchor.addEventListener('click', function (event) { 

	click('ocultareste');

 }); }

var anchor = document.getElementById("ocultareste");
if(anchor) { anchor.addEventListener('click', function (event) { event.target.classList.toggle('d-none'); }); }

var anchor = document.querySelectorAll('#comment');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {
			[].forEach.call(anchor, function(textarea) { textarea.innerHTML = ''; });
			var value = item.getAttribute('replyat');
			var length = value.length;
			item.innerHTML = value;
			item.setSelectionRange(length, length);
		});
	});
}
*/
var anchor = document.getElementById("estedetalle");
if(anchor) { anchor.addEventListener('click', function (event) { 
	var button = event.target;
	var text = "OCULTAR DETALLE";
	if (button.innerHTML === "OCULTAR DETALLE") { text = "VER DETALLE"; } 
	button.innerHTML = text;
	
 }); }






var accordion = document.getElementById("accordionExample");
if(accordion) { accordion.addEventListener('show.bs.collapse', function (event) {

	var id = 'excp-'+event.target.getAttribute('jselem');



	var div = document.getElementById(id);
	if(div){ alert(id); div.classList.toggle('d-none'); }
	
}); }
/*
var myCollapsible = document.getElementById('collapseZero')
myCollapsible.addEventListener('show.bs.collapse', function () {

	var id = 'excp-'+event.target.getAttribute('jselem');

	var div = document.getElementById(id);
	if(div){ alert(id); div.classList.toggle('d-none'); }

})


function collapseaccordion(event) {
  alert(event.target.getAttribute('class'));
 alert(event.target.target.getAttribute('class'));
//(new bootstrap.Collapse(document.getElementById('collapseZero'))).show();


 }
 */
 
	 
 var anchor = document.querySelectorAll('.loadmore');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {	
		
			str = event.currentTarget.getAttribute('href');	 
			id = str.substring(str.indexOf("-")+1, str.length);
		
			var div = document.getElementById('excp-'+id);
		
		if(div){ div.classList.toggle('d-none'); }
		});
	});	
}		

var anchor = document.getElementById("copyme3");
if(anchor) { anchor.addEventListener('click', function (event) { copy(event, 3); }); }

var anchor = document.getElementById("copyme1");
if(anchor) { anchor.addEventListener('click', function (event) { copy(event, 1); }); }	

var anchor = document.getElementById("copyos");
if(anchor) { anchor.addEventListener('click', function () { notify('copyos'); }); }

var anchor = document.querySelectorAll('.tooltip-link');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {	
			var go = true;			
			if ('ontouchstart' in window) { go = false; }
			
			if(!go){				
				var catg = 'click-again-to-go';	
				item.classList.toggle(catg);
				setTimeout(function () { item.classList.toggle(catg); }, 800);							
				if(item.getAttribute('class').includes(catg)){ go = true; }			
			}
			
			if(go){ window.open(item.getAttribute('url'), '_blank'); }			
		});
	});	
}		
/*
var anchor = document.querySelectorAll('#settings-filter .nav-item');
if(anchor) {
	anchor.forEach(item => {
		item.addEventListener('click', event => {
			var id = item.getAttribute('id');
			
			if(id == 'nav-products-tab') { id = 'products'; } 
			else if(id == 'nav-featured-tab') { id = 'featured'; } 
	
update_link(id, 'view');
			
			

		});
	});
}
*/

var anchor = document.querySelectorAll('#myTab .nav-item');
if(anchor) {
	
	anchor.forEach(item => {
		item.addEventListener('click', event => {
			
			
			var id = item.getAttribute('tab-id');
			
			if(id == 0) { id = 'grid'; } 
			else if(id == 1) { id = 'list'; } 
			else if(id == 2) { id = 'carousel'; }
			
//update_link(id, 'as');						
			

			click('tab-nav-'+id+'-0');
			click('tab-nav-'+id+'-1');


			
		});
		
		
		
	});
}



/*
function update_link(id, type) {
	document.querySelectorAll('.update-url-here').forEach(item => {
		
		
		var url = item.getAttribute('href');
		url = url.substring(1)
		var res = url.split("&");


		
		//var resparam0 = res[0].split("="); //resparam0[0] ES -> VIEW
		//var resparam1 = res[1].split("=");//resparam1[0] ES -> AS

		if(type=='view'){
			var rr = type + '=' + id + '&' + res[1];
		} else if(type=='as'){
			var rr = res[0] + '&' + type + '=' + id;
		}
		
		var newurl = '?' + rr + '&' + res[2];
		//document.getElementById("tester").innerHTML = newurl;
		
		item.setAttribute('href', newurl);
	});	
}
*/


var carousel = document.getElementById("quantum-modal");
if(carousel) {
	carousel.addEventListener('slid.bs.carousel', function (event) {
		var eventRelatedTarget = event.relatedTarget;
		deleteNew(eventRelatedTarget.getAttribute('current-slide'));
		

		if(eventRelatedTarget.getAttribute('last-slide')){ resetModalTimer(); }
	});	
}

var modal = document.getElementById("exampleModal-1");
if(modal) { 
	modal.addEventListener('show.bs.modal', function (event) { 
		var value = getData(event);	
		
		
		document.getElementById('copyme1').setAttribute('value', value);
		document.getElementById('myInput1').setAttribute('value', value);		
		
		var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal-3'));
		if(modal){ modal.hide(); }
	}); 
}

var modal = document.getElementById("exampleModal-2");
if(modal) {
	//document.querySelector(".carousel-inner.mcar").childElementCount == 1
	


	modal.addEventListener('show.bs.modal', function () {

var r1 = document.getElementById("quantum-modal").getAttribute('single-slide');
var r2 = document.querySelector('#quantum-modal .carousel-item.active');

		if(r1 || r2 ){ resetModalTimer(); } 
		
		});
	modal.addEventListener('hidden.bs.modal', function () { if(closeModalManually){ resetUrl(); } });
}

var modal = document.getElementById("exampleModal-3");
if(modal) {	
	modal.addEventListener('show.bs.modal', function (event) {
		var value = getData(event);	

		document.getElementById('menuid').setAttribute('data-bs-whatever', value);		
		document.getElementById('pubid').setAttribute('href', value);
		document.getElementById('myInput3').setAttribute('value', value);
		document.getElementById('copyme3').setAttribute('value', value);
		
		
		
	});
}