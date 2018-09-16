$(window).on('scroll', function(){
	if ($(window).scrollTop()){
		$('nav').addClass('black');
	}
	else
	{
		$('nav').removeClass('black');
	}
})

$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".navbar", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $("#myNavbar a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});


// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".navbar", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $("#myNavbar a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});
    $(function() {
    	$('#images > div').each(function() {
    		var $cfs = $(this);
    		$cfs.carouFredSel({
    			direction: 'up',
    			circular: false,
    			infinite: false,
    			auto: false,
    			scroll: {
    				queue: 'last'
    			},
    			items: {
    				visible: 1,
    				width: 275,
    				height: 200
    			}
    		});
    		$cfs.hover(
    			function() {
    				$cfs.trigger('next');
    			},
    			function() {
    				$cfs.trigger('prev');
    			}
    		);
    	});
    });


    $(document).ready(function(){
  $('.flip').click(function(){
    $('.cont-flip').toggleClass('flipped');
    return false;
  });
});


