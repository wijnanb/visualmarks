<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
    <script type="text/javascript">
			var lastDrag = 0;
			var dragleave_timeout;

      $(document).ready(function()
			{
				$('#text').html("Drag image file(s) in this box.");

        init_event_handlers();
			});

			function init_event_handlers()
			{
        $(document).bind('dragenter', on_drag_enter);
  			$(document).bind('dragover', on_drag_over);
      	$(document).bind('dragleave', on_drag_leave );
				$(document).bind('drop', on_drop );
			}
			



      function on_drag_enter(e)
			{
			  e.stopPropagation();
			  e.preventDefault();
			}

			function on_drag_over(e)
			{
        lastDrag = +new Date;
			  e.stopPropagation();
			  e.preventDefault();

        $('#text').html("Don't be shy, drop the file(s) in here.");
			}

			function on_drop(e)
			{
        console.log("drop");
				e.stopPropagation();
			  e.preventDefault();

				// disable on_drag_leave
        clearTimeout(dragleave_timeout);

        $('#text').html("Got it!");

        var files = e.originalEvent.dataTransfer.files;
				console.log(files);
			  for (var i = 0, f; f = files[i]; i++) {
          var reader = new FileReader();
					reader.onload = (function(theFile) {
			        return function(e) {
                console.log( "filename: " + theFile.name );
			          console.log( e.target.result );
			        };
			      })(f);
					reader.readAsDataURL(f);
			  }
			}

			function on_drag_leave(e)
			{
        console.log("drag leave");

			  var lastBodyLeave = +new Date;
			  dragleave_timeout = setTimeout(function(){
			    if(lastDrag < lastBodyLeave){
			      
            console.log("drag leave  " + lastDrag + " " + lastBodyLeave);
            $('#text').html("Drag an image file in this box.");
			    }
			  },50);
			}

		</script>

  </head>
  <body>
    <div id="dropbox">
			<div class="image left">
				<img src="images/dropbox.png" />
			</div>
			<div class="text left" id="text"></div>
			<div class="clear"></div>
		</div>


    
  </body>
</html>