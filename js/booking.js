$(document).ready(function() {
  var $src = $("#booking_src")
  var $form = $("#Booking .wpcf7-form")

  var $roomDeets = $form.find(".room-details")
  var $surfDeets = $form.find(".surf-details")
  var $dates = $form.find("input[type='date']")
  var $arrival = $form.find("input.arrival")
  var $departure = $form.find("input.departure")
  var today = new Date()

  var $select_room = $form.find(".select-room")
  var $room_ops = $select_room.find(".wpcf7-list-item")

  var $select_surf = $form.find(".select-surf")
  var $surf_ops = $select_surf.find(".wpcf7-list-item")

  $.each($dates, function(index, date) {
    var $date = $(date)
    $date.on("blur", function(e) {
      if (today.getTime() > new Date(e.target.value).getTime()) {
        e.target.value = ""
      }
      else if ($date.hasClass("arrival")) {
        $departure.attr("min", e.target.value)
      }
      else {
        displaySeason($arrival.attr("value"), $departure.attr("value"))
      }
    })
  })

  $.each($room_ops, function(index, room) {
    $(room).css("background-image", "url(" + $src.find(
      ".room[data-title='"+$(room).find("input").attr("value")+"']"
    ).attr("data-image") + ")")
  })

  $.each($surf_ops, function(index, op) {
    $sop = $src.find(".surf-option[data-title='"+$(op).find("input").attr("value")+"']")
    $(op).css("background-image", "url(" + $sop.attr("data-image") + ")")
  })

  var clearRooms = function() {
    $roomDeets.html('')
    $.each($room_ops, function(index, op) {
      var $op = $(op)
      var $input = $op.find("input")

      $op.removeClass("checked")
      $input.attr("checked", "")
    })
  }

  var clearSurf = function() {
    $surfDeets.html('')
    $.each($surf_ops, function(index, op) {
      var $op = $(op)
      var $input = $op.find("input")

      $op.removeClass("checked")
      $input.attr("checked", "")
    })
  }

  var displaySeasons = function(key) {
    var seasons = $src.find(".seasons .season[data-rate='"+key+"']")
    var cont = document.createElement("span")
    cont.className = "seasons"

    $.each(seasons, function(index, season) {
      var p = document.createElement("p")
      // span.className = "season " + $(season).attr("data-rate")
      p.innerHTML = "<em>" +
                      $(season).attr("data-start-date") + " &mdash; " +
                      $(season).attr("data-end-date")
                  + "</em>";
      cont.appendChild(p)
    })

    return cont.outerHTML
  }

  var displayRoomDetails = function(title) {
    var $room = $src.find(".room[data-title='"+title+"']")
    $roomDeets.html(
      "<div class='deets'>" +
        "<span class='deet low inline-block'>" +
          "<h3>Low Season</h3>" +
          "<p><em>"+$room.attr("data-low-rate")+"€</em></p>" +
          displaySeasons("low") +
        "</span>" +
        "<span class='deet mid inline-block'>" +
          "<h3>Middle Season</h3>" +
          "<p><em>"+$room.attr("data-mid-rate")+"€</em></p>" +
          displaySeasons("mid") +
        "</span>" +
        "<span class='deet high inline-block'>" +
          "<h3>High Season</h3>" +
          "<p><em>"+$room.attr("data-high-rate")+"€</em></p>" +
          displaySeasons("high") +
        "</span>" +
        "<span class='deet peak inline-block'>" +
          "<h3>Peak Season</h3>" +
          "<p><em>"+$room.attr("data-peak-rate")+"€</em></p>" +
          displaySeasons("peak") +
        "</span>" +
      "</div>" +
      "<p class='note text-center uppercase'>*Rates Per Room</p>"
    )
  }

  var displaySurfDetails = function(title) {
    var $surf = $src.find(".surf-option[data-title='"+title+"']")
    var rate = parseFloat($surf.attr("data-rate"))
    var extras = $surf.attr("data-extras")
    var rateHTML = rate ? "<p class='rate'><em>"+rate+"€</em></p>" : ""
    var extrasHTML = extras ? "<div class='extras'>"+$surf.attr("data-extras")+"</div>" : ""
    $surfDeets.html("<div class='deets'>" + rateHTML + extrasHTML + "</div>")
  }

  $.each($room_ops, function(index, op) {
    var $op = $(op)
    var $input = $op.find("input")

    if ($input.attr("checked")) {
      $op.addClass("checked")
    }

    $op.on("click", function(e) {
      if ($op.hasClass("checked")) {
        return clearRooms()
      }
      clearRooms()
      $input.attr("checked", "checked")
      $op.addClass("checked")
      displayRoomDetails($input.attr("value"))
    })
  })

  $.each($surf_ops, function(index, op) {
    var $op = $(op)
    var $input = $op.find("input")

    if ($input.attr("checked")) {
      $op.addClass("checked")
    }

    $op.on("click", function(e) {
      if ($op.hasClass("checked")) {
        return clearSurf()
      }
      clearSurf()
      $input.attr("checked", "checked")
      $op.addClass("checked")
      displaySurfDetails($input.attr("value"))
    })
  })
})
