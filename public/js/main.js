
var apiCalls = {
	search: '../api/search.php'
}

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
	binds();
	
}

function loadContent(template){
	$('#searchForm').html(template);
}

function binds(){
	$('#searchType').change(function(){
		var searchTerm = $('#searchTerm');
		if(this.value == 'ip'){
			searchTerm.hide();
		} else {
			searchTerm.show();
		}
	});

	$('#searchSubmit').click(doSearch);
}

function doSearch(e){
	var searchType 	= $('#searchType').val();
	var searchDays 	= $('#searchDays').val();	
	var searchTerm 	= (searchType == 'ip') ? '' : $('#searchTerm').val().trim();
	var url 		= apiCalls.search;
	url 			+= "?searchBy="+searchType+"&searchTerm="+searchTerm+"&searchDays="+searchDays;
	//should add a loading spinner at this point
	$.get(url).done(function(data){
		if(data.cod == 200) successCallback(data)
	});
}

function successCallback(data){

	requireTemplate('results',data)
		.done(function(template){
			$('#searchResults').html(template);
		});
}



