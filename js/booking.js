$(document).ready(function() {
  $src = $("#booking_src")
  $form = $("#Booking .wpcf7-form")

  $dates = $form.find("input[type='date']")
  $arrival = $form.find("input.arrival")
  $departure = $form.find("input.departure")
  today = new Date()

  $select_room = $form.find(".select-room")
  $room_ops = $select_room.find(".wpcf7-list-item")

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

  $.each($room_ops, function(index, room) {
    $(room).css("background-image", "url(" + $src.find(
      ".room[data-title='"+$(room).find("input").attr("value")+"']"
    ).attr("data-image") + ")")
  })

  var clearGuestOps = function() {
    $.each($room_ops, function(index, op) {
      var $op = $(op)
      var $input = $op.find("input")

      $op.removeClass("checked")
      $input.attr("checked", "")
    })
  }

  $.each($room_ops, function(index, op) {
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
