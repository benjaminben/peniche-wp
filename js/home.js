window.$ = window.jQuery

$(document).ready(function() {
  var $home = $("#Home")
  var home_bg_slides = $home.find(".slideshow .slide")

  var animSlide = function(slide, back) {
    // console.log(slide)
    slide.css({
      zIndex: 2,
      width: "0%",
      display: "block",
      right: back ? "" : "0",
      left: back ? "0" : "initial"
    })

    var imgCont = slide.find(".img-cont")

    imgCont.css({
      width: "100vw",
      left: back ? "-50vw" : "50vw"
    })

    TweenMax.to(imgCont, 0.8, {
      left: "0vw",
      ease: Power3.easeInOut
    })

    TweenMax.to(slide, 0.8, {
      width: "100%",
      // clearProps: "transform",
      ease: Power3.easeInOut,
      onComplete: function() {
        console.log("dun")
        $home.find(".slide.active").removeClass("active")
        slide.addClass("active").attr("style", "")
      }
    })
  }

  var this_slide_index = -1

  var updateSlide = function() {
    var last_slide_index = this_slide_index

    this_slide_index = (this_slide_index < home_bg_slides.length - 1)
                   ? this_slide_index + 1
                   : 0;

    // var last_slide = $(".slideshow .active") || $(".slideshow:first-child")

    console.log(last_slide_index, this_slide_index)
    var back = (this_slide_index === home_bg_slides.length - 1) ? true : false
    animSlide(
      $(home_bg_slides[this_slide_index]),
      back
    )
    // if (last_slide_index > -1) {
    //   var last_slide_bg = $(home_bg_slides[last_slide_index]).find(".img-cont")
    //   TweenMax.to(last_slide_bg, 1.2, {
    //     x: (back) ? "10%" : "-10%",
    //     ease: Power3.easeInOut,
    //     clearProps: "transform",
    //     // onComplete: function() {
    //     //   // last_slide_bg.css("transform", "")
    //     // }
    //   })
    // }
  }

  updateSlide()
  var SLPHomeSlideInt = window.setInterval(function() {
    updateSlide()
  }, 3000)


  // VIDEO
  var ytPlayer
  window.onYouTubeIframeAPIReady = function() {
    var ytCont = document.getElementById("home_player")
    ytPlayer = new YT.Player("home_player", {
      height: "390",
      width: "640",
      videoId: ytCont.getAttribute("data-yt-id"),
      playerVars: {"showinfo": 0, "modestbranding": 1},
      events: {
        "onReady": function(){console.log("yt player ready")},
        "onStateChange": function(e) {
          if (e.data === 1) {
            window.clearInterval(SLPHomeSlideInt)
          }
          if (e.data === 2) {
            $("#Home").removeClass("video-active")
            SLPHomeSlideInt = window.setInterval(function() {
              updateSlide()
            }, 3000)
          }
          if (e.data === 0) {
            ytPlayer.pauseVideo();
            ytPlayer.seekTo(0);
          }
        }
      }
    })
  }

  $("#Home .watch-cta").on("click", function(e) {
    $home.addClass("video-active")
    ytPlayer.playVideo();
  })
})
