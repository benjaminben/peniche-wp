$(document).ready(function() {
  $form = $("#Booking .wpcf7-form")
  $dates = $form.find("input[type='date']")
  $arrival = $form.find("input.arrival")
  $departure = $form.find("input.departure")
  today = new Date()

  $.each($dates, function(index, date) {
    var $date = $(date)
    $date.on("change", function(e) {
      if (today.getTime() > new Date(e.target.value).getTime()) {
        e.target.value = ""
      }
      else if ($date.hasClass("arrival")) {
        $departure.attr("min", e.target.value)
      }
    })
  })
})
