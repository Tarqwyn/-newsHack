<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xml:lang="en-GB">
<head>
  <base href="<?php echo $this->config->item('base_url') ?>www/" />
  <link rel="stylesheet" href="http://localhost:8888/newshack/www/css/main.css" type="text/css" media="screen" />
  <script type="text/javascript" src="http://localhost:8888/newshack/www/js/vendor/require.js"></script>
  <script type="text/javascript">
  require({
    paths: {
      "jquery-1":"http://localhost:8888/newshack/www/js/vendor/jquery-1.7.2"
    }
  });
  var bbc = {};
  window.ENV = 'dev';
</script>
</head>
<body id="newshack" class="news">
  <h1 class="masthead"></h1>
	<div id="main-wrapper">
		<div id="user-cta">
			<?php 
      $attributes = array('class' => 'form_input');
			echo form_open('Welcome/tags', $attributes);
			echo form_input('username', 'your Twitter ID:');
			echo (': ');
			echo form_submit('submit', 'Go');
			echo form_close();
			?>
		</div>

	</div>

  <section id="content">


    <?php
    if(isset($_POST['news'])) {

      echo '<div id="container" class="photos clearfix">';

      $news = json_decode($_POST['news'], true);

      for($i = 0; $i < 3; $i++) {

        foreach($news as $story) {
          echo '<div class="photo">';
            echo '<a href="' . $story['url'] . '" title="' . $story['headline'] . '"><img src="' . $story['img'] . '" alt="' . $story['headline'] . '" />';
              echo '<div class="wrapper">';
                echo '<span class="headline">' . $story['headline'] . '</span>';
                foreach($story['tweets'] as $tweetID) {
                  echo '<span class="tweet">' . $tweetID . '</span>';
                }
          echo '</div></a></div>';
        }
      }

      echo '</div>';
    }
    ?>

<div id="container" class="photos clearfix">
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039951/" title="Stanley by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4113/5013039951_3a47ccd509.jpg" alt="Stanley" />
        <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039885/" title="Officer by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4131/5013039885_0d16ac87bc.jpg" alt="Officer" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039583/" title="Tony by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4086/5013039583_26717f6e89.jpg" alt="Tony" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
        
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039541/" title="Giraffe by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4144/5013039541_17f2579e33.jpg" alt="Giraffe" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039741/" title="Gavin by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4153/5013039741_d860fb640b.jpg" alt="Gavin" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039697/" title="Anita by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4113/5013039697_a15e41fcd8.jpg" alt="Anita" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013646314/" title="Take My Portrait by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4124/5013646314_c7eaf84918.jpg"   alt="Take My Portrait" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013040075/" title="Wonder by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4089/5013040075_bac12ff74e.jpg" alt="Wonder" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
            <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039951/" title="Stanley by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4113/5013039951_3a47ccd509.jpg" alt="Stanley" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039885/" title="Officer by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4131/5013039885_0d16ac87bc.jpg" alt="Officer" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039583/" title="Tony by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4086/5013039583_26717f6e89.jpg" alt="Tony" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013646070/" title="Kendra by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4146/5013646070_f1f44b1939.jpg" alt="Kendra" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039541/" title="Giraffe by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4144/5013039541_17f2579e33.jpg" alt="Giraffe" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039741/" title="Gavin by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4153/5013039741_d860fb640b.jpg" alt="Gavin" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039697/" title="Anita by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4113/5013039697_a15e41fcd8.jpg" alt="Anita" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013646314/" title="Take My Portrait by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4124/5013646314_c7eaf84918.jpg"   alt="Take My Portrait" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013040075/" title="Wonder by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4089/5013040075_bac12ff74e.jpg" alt="Wonder" /><div class="wrapper" >            <span class="headline">Headline</span>
            <span class="tweet">tweet</span>
            <span class="tweet">tweet</span></div></a>
      </div>
    
          <div class="photo">
        <a href="http://www.flickr.com/photos/nemoorange/5013039951/" title="Stanley by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4113/5013039951_3a47ccd509.jpg" alt="Stanley" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
    
      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039885/" title="Officer by Dave DeSandro, on Flickr"><img src="http://farm5.static.flickr.com/4131/5013039885_0d16ac87bc.jpg" alt="Officer" />        
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>

      <div class="photo half">
        <a href="http://www.flickr.com/photos/nemoorange/5013039583/" title="Tony by Dave DeSandro, on Flickr">
          <img src="http://farm5.static.flickr.com/4086/5013039583_26717f6e89.jpg" alt="Tony" />
          <div class="wrapper" >            
          <span class="headline">Headline</span>
            <span class="tweets">
              <p class="tweet">Tweet</p>
              <p class="tweet">Tweet</p>
            </span>
          </div>
        </a>
      </div>
  
  </div> 
    
<script type="text/javascript" src="http://localhost:8888/newshack/www/js/main.js"></script>
</section> <!-- #content -->
  

</body>
</html>