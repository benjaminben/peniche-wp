$(document).ready(function() {
  $form = $("#Booking .wpcf7-form")

  $dates = $form.find("input[type='date']")
  $arrival = $form.find("input.arrival")
  $departure = $form.find("input.departure")
  today = new Date()

  $num_guests = $form.find(".number-guests")
  $guest_ops = $num_guests.find(".wpcf7-list-item")

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

  var clearGuestOps = function() {
    $.each($guest_ops, function(index, op) {
      var $op = $(op)
      var $input = $op.find("input")

      $op.removeClass("checked")
      $input.attr("checked", "")
    })
  }

  $.each($guest_ops, function(index, op) {
    var $op = $(op)
    var $input = $op.find("input")

    if ($input.attr("checked")) {
      $op.addClass("checked")
    }

    $op.on("click", function(e) {
      clearGuestOps()
      $input.attr("checked", "checked")
      $op.addClass("checked")
    })
  })
})
