
var apiCalls = {
	search: 'api/search.php'
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
	//format the options to give custom date
	moment.lang('en', {
	    calendar : {
	        lastDay : '[Yesterday]',
	        sameDay : '[Today]',
	        nextDay : '[Tomorrow]',
	        lastWeek : '[last] dddd',
	        nextWeek : 'ddd Do MMMM',
	        sameElse : 'ddd Do MMMM'
	    }
	});

	Handlebars.registerHelper("formatDate", function(timestamp) {
		return moment(timestamp*1000).calendar();
	});
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
	//searchTerm needs to be accessed through basic javascript otherwise it wont work with googles auto complete
	var input = document.getElementById('searchTerm');
	var autocomplete = new google.maps.places.Autocomplete(input);
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



