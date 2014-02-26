<?php
/**
 * Resize js file.
 *
 *
 * @author		Jamie Pistone
 * @module		Youtube Embed Module
 *
 *	JavaScript smooth embed resize code modified from the work of John Hann, Chris Coyier, and Mathias Byens for use with youtube embed plugin, Ushahidi.
 */
 
	$embed_height = 360;
	$embed_width = 540;
	$aspect_ratio = $embed_height / $embed_width;
	
	// Surrounding elements differ on different pages
	if (Router::$method == 'view') {
		$container_element = '$allVideos.parent().parent("div")';
	} 
	
	elseif(Router::$method == 'index') 
	{
		$container_element = '$(".big-block")';
	}
?>


<script type="text/javascript">
var aspectRatio = <?php echo $aspect_ratio; ?>;

(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
	  var timeout;

	  return function debounced () {
		  var obj = this, args = arguments;
		  function delayed () {
			  if (!execAsap)
				  func.apply(obj, args);
			  timeout = null;
		  };

		  if (timeout)
			  clearTimeout(timeout);
		  else if (execAsap)
			  func.apply(obj, args);

		  timeout = setTimeout(delayed, threshold || 100);
	  };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

// By Chris Coyier & tweaked by Mathias Bynens
$(function() {

	// Find all YouTube videos
	var $allVideos = $("embed[src^='//www.youtube.com']"),

			// The element that is fluid width
			$fluidEl = <?php echo $container_element; ?>;
		
	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {
		
		$(this)
			// Can't add data elements to <object>s or <embed>s
			// .data('aspectRatio', aspectRatio)
			
			// and remove the hard coded width/height
			.removeAttr('height')
			.removeAttr('width');
			
		$(this).parent("object")
			// Can't add data elements to <object>s or <embed>s
			// .data('aspectRatio', aspectRatio)
			
			// and remove the hard coded width/height
			.removeAttr('height')
			.removeAttr('width');

	});

	// When the window is resized
	// (You'll probably want to debounce this)
	$(window).smartresize(function() {

		var newWidth = $fluidEl.width();
		
		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {

			var $el = $(this);
			$el
				.width(newWidth)
				.height(newWidth * aspectRatio);
			$el.parent("object")
				.width(newWidth)
				.height(newWidth * aspectRatio);
		});

	// Kick off one resize to fix all videos on page load
	}).resize();

});
</script>

