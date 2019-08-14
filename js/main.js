var Pages = new Array();
var Page = {
  action: "php/1.php",
  title: ""
};
Pages.push(Page);
function AjaxGetData(evt){
	evt.preventDefault();
	evt.stopImmediatePropagation();
	var nexttitle = evt.currentTarget.attributes.nexttitle.nodeValue;
	var action = evt.currentTarget.attributes.action.nodeValue;
	if((Pages[Pages.length-1].action==action)){
		Pages.pop();
		action = Pages[Pages.length-1].action;
		nexttitle = Pages[Pages.length-1].title;
	}
	$.ajax({
		type: "GET",
		url: action,
		data: "html",
		success: function(result){
			$('#result').html(result);
			document.getElementById("title").innerHTML = nexttitle;
			var titlecont = document.getElementById("titlecont");
			if(titlecont.style.visibility == "hidden"){
				titlecont.style.visibility = "visible";
				titlecont.style.position = "static";				
			}else if(Pages.length==1){
				titlecont.style.visibility = "hidden";
				titlecont.style.position = "absolute";
			}
			titlecont.attributes.action.nodeValue = action;
			if(Pages[Pages.length-1].action!=action){
				var Page = {
				  action: action,
				  title: nexttitle
				};
				Pages.push(Page);
			}
			document.getElementById("title").innerHTML = nexttitle;
		}
	});
}