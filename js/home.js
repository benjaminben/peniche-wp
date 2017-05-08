window.$ = window.jQuery

var ytPlayer
function onYouTubeIframeAPIReady() {
  var ytCont = document.getElementById("home_player")
  console.log("blurg", ytCont);
  ytPlayer = new YT.Player("home_player", {
    height: "390",
    width: "640",
    videoId: ytCont.getAttribute("data-yt-id"),
    playerVars: {"showinfo": 0, "modestbranding": 1},
    events: {
      "onReady": function(){console.log("yt player ready")},
      "onStateChange": function(e) {
        console.log(e.data)
        if (e.data === 2) {
          $("#Home").removeClass("video-active")
        }
        if (e.data === 0) {
          ytPlayer.pauseVideo();
          ytPlayer.seekTo(0);
        }
      }
    }
  })
}

$(document).ready(function() {
  var $home = $("#Home")
  var home_bg_slides = $home.find(".slideshow .slide")
  var slide_number = -1
  var update_slide = function() {
    slide_number = (slide_number < home_bg_slides.length - 1)
                 ? slide_number + 1
                 : 0;
    $home.find(".slide.active").removeClass("active")
    $(home_bg_slides[slide_number]).addClass("active")
  }
  update_slide()
  window.setInterval(function() {
    update_slide()
  }, 3000)

  $("#Home .watch-cta").on("click", function(e) {
    $home.addClass("video-active")
    ytPlayer.playVideo();
  })
})
