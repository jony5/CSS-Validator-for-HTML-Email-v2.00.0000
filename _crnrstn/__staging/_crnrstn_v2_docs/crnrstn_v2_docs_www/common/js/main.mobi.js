/* 
// J5
// Code is Poetry */

//
// lowly JavaScript Document
function loadPage(uri){

	window.location = uri;

}

function generate_cachebust(){
	//https://gist.github.com/6174/6062387
	//http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript
	$('#cache_bust').html(Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15));
}
