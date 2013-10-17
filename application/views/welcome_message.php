<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My News View</title>

	<base href="<?php echo $this->config->item('base_url') ?>www/" />
	<link rel="stylesheet" href="http://localhost:8888/www/css/newshack.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://localhost:8888/www/css/style.css" type="text/css" media="screen" />

</head>
<body class="demos ">
	<div id="outer">
		<h1>My News View</h1>

		<div id="body">
			<p>Please Enter your Twitter ID:</p>

			<?php 

			echo form_open('Welcome/news');
			echo form_input('username', 'Username');
			echo (': ');
			echo form_submit('submit', 'Go');
			echo form_close();
			?>

		</div>

	</div>
  
  
  <section id="content">
    
      <h1>Images</h1>

  <div id="container" class="photos clearfix">
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039951/" title="Stanley by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4113/5013039951_3a47ccd509.jpg" alt="Stanley" /></a>
      </div>
    
      <div class="photo small">
        <a href="http://www.flickr.com/photos/nemoorange/5013039885/" title="Officer by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4131/5013039885_0d16ac87bc.jpg" alt="Officer" /></a>
      </div>
    
      <div class="photo small">
        <a href="http://www.flickr.com/photos/nemoorange/5013039583/" title="Tony by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4086/5013039583_26717f6e89.jpg" alt="Tony" /></a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013646070/" title="Kendra by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4146/5013646070_f1f44b1939.jpg" alt="Kendra" /></a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039541/" title="Giraffe by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4144/5013039541_17f2579e33.jpg" alt="Giraffe" /></a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039741/" title="Gavin by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4153/5013039741_d860fb640b.jpg" alt="Gavin" /></a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039697/" title="Anita by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4113/5013039697_a15e41fcd8.jpg" alt="Anita" /></a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013646314/" title="Take My Portrait by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4124/5013646314_c7eaf84918.jpg"   alt="Take My Portrait" /></a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013040075/" title="Wonder by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4089/5013040075_bac12ff74e.jpg" alt="Wonder" /></a>
      </div>
    
  </div> <!-- #container -->
  
  <script src="http://localhost:8888/www/js/jquery-1.7.1.min.js"></script>
  <script src="http://localhost:8888/www/js/jquery.isotope.min.js"></script>
  <script>
    $(function(){

      var $container = $('#container');
    
      $container.imagesLoaded( function(){
        $container.isotope({
          itemSelector : '.photo'
        });
      });
    
    
    });
  </script>
    
    
  </section> <!-- #content -->
  

</body>
</html>