$(document).ready(function () {

    GenerateCalendar()

});

function GenerateCalendar() {
    var date = new Date();
    var start = new Date();
    var end = new Date();
    start.setDate(date.getDate());
    end.setDate(date.getDate() + 13);
	
		var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];	
		var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];	
		
	    $('#selected_month').text(months[start.getMonth()]);
	
    var htmls = '';	
    for (var d = start ; d <= end; d.setDate(d.getDate() + 1)) {
		
        var first_week = '<div class ="days item-month"><span data-value="'+formatDateYYMMdd(new Date(d))+'">' + formatDatedd(new Date(d)) +'<br>'+days[formatDateDay(new Date(d))]+ '</span></div>';		
        htmls += first_week;
    }

    $('#append-month').html(htmls);	
}

function formatDatedd(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (day.length < 2) day = '0' + day;

    return [day];
}

function formatDateDay(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDay(),
        year = d.getFullYear();

    return [day];
}

function formatDateYYMMdd(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
		
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
	
    return [year, month, day].join('-');
}