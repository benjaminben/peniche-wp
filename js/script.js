// console.log(TweenMax)

// ;(function() {

//   var root = null;
//   // var useHash = false;
//   // var hash = '#!';
//   var router = new Navigo(root);

//   var anchors = Array.from(document.getElementsByTagName("a"))
//   console.log(anchors)
//   anchors.forEach(function(an, i) {
//     var href = an.getAttribute("href")
//     router.on(href, function() {
//       console.log("routing", href)
//     }).resolve()

//     an.addEventListener("click", function(e) {
//       e.preventDefault()
//       router.navigate(href)
//     })
//   })

//   router
//     .on('/peniche/lodge', function() {
//       console.log("fudge")
//     })
//     .resolve();

// })();
window.$ = window.jQuery
$(document).ready(function() {
  var $home = $("#Home")
  if ($home) {
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
    // var home_bg_urls = home_bg.getAttribute("data-urls").split(",")
    // home_bg.style.backgroundImage = "url("+home_bg_urls[0]+")"
  }

})
