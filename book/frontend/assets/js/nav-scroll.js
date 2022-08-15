
//Month Scroll Start
function checkScrollMonth() {
  // Get current scroll position
  var scrollLeftPosition = $('.inner-box-month').scrollLeft();
  // Calculate max scroll position
  var maximumScroll = $('.inner-box-month').prop('scrollWidth') - 
                      $('.inner-box-month')[0].offsetWidth;
  // Make sure they show unless the if statement passes below
  $('#btn-nav-month-previous, #btn-nav-month-next').show();
  if ( ( scrollLeftPosition === 0 ) || 
       ( scrollLeftPosition === maximumScroll ) ) { 
    $(this).hide();
  }
}
$('#btn-nav-month-previous').hide() // initial state
  .click(function() {
      $(".inner-box-month").animate(
      {scrollLeft: "-=200px"}, 
      "fast", 
      checkScrollMonth.bind(this)
    );
});

$('#btn-nav-month-next').click(function() {
    $(".inner-box-month").animate(
      {scrollLeft: "+=200px"}, 
      "fast", 
      checkScrollMonth.bind(this)
  );
});
//Month Scroll End

//Time Scroll Start
function checkScrollTime() {
  // Get current scroll position
  var scrollLeftPosition = $('.inner-box-time').scrollLeft();
  // Calculate max scroll position
  var maximumScroll = $('.inner-box-time').prop('scrollWidth') - 
                      $('.inner-box-time')[0].offsetWidth;
  // Make sure they show unless the if statement passes below
  $('#btn-nav-time-previous, #btn-nav-time-next').show();
  if ( ( scrollLeftPosition === 0 ) || 
       ( scrollLeftPosition === maximumScroll ) ) { 
    $(this).hide();
  }
}
$('#btn-nav-time-previous').hide() // initial state
  .click(function() {
      $(".inner-box-time").animate(
      {scrollLeft: "-=200px"}, 
      "fast", 
      checkScrollTime.bind(this)
    );
});

$('#btn-nav-time-next').click(function() {
    $(".inner-box-time").animate(
      {scrollLeft: "+=200px"}, 
      "fast", 
      checkScrollTime.bind(this)
  );
});
//Time Scroll End