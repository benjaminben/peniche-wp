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

  var animSlide = function(slide) {
    slide.css({
      zIndex: 2,
      width: "0%",
      display: "block"
    })

    var imgCont = slide.find(".img-cont")

    imgCont.css({
      width: "100vw",
      left: "-50vw"
    })

    TweenMax.to(imgCont, 0.8, {
      left: "0vw",
      ease: Power3.easeInOut,
      onComplete: function() {
        // imgCont.css({width: "100%", left})
      }
    })

    TweenMax.to(slide, 0.8, {
      x: 0, width: "100%",
      ease: Power3.easeInOut,
      onComplete: function() {
        console.log("dun")
        $home.find(".slide.active").removeClass("active")
        slide.addClass("active").attr("style", "")
      }
    })
  }

  var updateSlide = function() {
    slide_number = (slide_number < home_bg_slides.length - 1)
                 ? slide_number + 1
                 : 0;
    animSlide($(home_bg_slides[slide_number]))
  }

  updateSlide()
  window.setInterval(function() {
    updateSlide()
  }, 3000)

  // VIDEO CTA
  $("#Home .watch-cta").on("click", function(e) {
    $home.addClass("video-active")
    ytPlayer.playVideo();
  })
})
