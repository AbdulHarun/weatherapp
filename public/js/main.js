
function requireTemplate(name, data) {
    return $.get('js/templates/'+name+'.hbs').then(function(src) {
       return Handlebars.compile(src)(data);
    });
}


$(document).ready(function(){
	requireTemplate('searchForm',{}).done(init);
});

function init(template){
	loadContent(template);
	
}

function loadContent(template){
	$('#searchForm').html(template);
}




