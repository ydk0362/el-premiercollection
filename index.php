<?php // Premier Collection : Author Access (elseiverauthors.com)
date_default_timezone_set('America/Chicago');
$querystr_pos = strpos($_SERVER['REQUEST_URI'], "?");
$uri = is_numeric($querystr_pos) ? substr($_SERVER['REQUEST_URI'], 0, $querystr_pos) : $_SERVER['REQUEST_URI'];

$dir = "./assets/images/";
$srch = filter_input(INPUT_POST, 'search-str', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW );
$matches = array();

// open an exisiting directory
if ( is_dir ( $dir ) && !empty ( $srch ) )
{
  if ( $handle = opendir ( $dir ) )
  {
    while ( false !== ( $file = readdir ( $handle ) ) )
    {
      // ignore directories
      if ( !is_dir ( $file ) )
      {
        // match the file case-insensitively while ignoring system files that 
        // start with a dot (.) such as .htaccess and .DS_Store
        if ( stristr ( $file, $srch ) !== false && strpos ( $file, '.' ) !== 0 )
        {
          $matches[] = $file;
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8" />
  <!--[if IE]><![endif]-->
  
  <title>Premier Collection : Author Access</title>
  
  <meta name="keywords" content="Elsevier, Premier Collection, Author Access, Download, Promotion, Personal Resource" />
  <meta name="description" content="Your personal resource for promoting you &amp; your titles for maximum exposure &amp; circulation." />
  
  <meta name="author" content="Elsevier Inc." />
  <meta name="copyright" content="&copy; 2011 Elsevier Inc. All rights reserved." />

  <meta name="DC.title" content="Premier Collection : Author Access" />
  <meta name="DC.subject" content="Your personal resource for promoting you &amp; your titles for maximum exposure &amp; circulation." />
  <meta name="DC.creator" content="Elsevier Inc." />
  
  <link rel="shortcut icon" href="<?=$uri ?>assets/images/favicon.ico" />
  
  <link rel="stylesheet" href="<?=$uri ?>assets/css/main.css" />
  <link rel="stylesheet" href="<?=$uri ?>assets/css/print/main.css" media="print" />
  
  <!--[if IE]><link rel="stylesheet" href="<?=$uri ?>assets/css/patches/win-ie-all.css" /><![endif]-->
  <!--[if IE 7]><link rel="stylesheet" href="<?=$uri ?>assets/css/patches/win-ie7.css" /><![endif]-->
  <!--[if lt IE 7]><link rel="stylesheet" href="<?=$uri ?>assets/css/patches/win-ie-old.css" /><![endif]-->
  <!--[if lt IE 9]><script src="<?=$uri ?>assets/js/libs/modernizr-1.6.min.js"></script><![endif]-->
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="/assets/js/libs/jquery-1.5.0.min.js"%3E%3C/script%3E'))</script>
  <script src="<?=$uri ?>assets/js/functions.js"></script>
  
  <!--<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-9156301-21']);
    _gaq.push(['_trackPageview']);
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>-->
  
</head>

<body id="www-elsevierauthors-com">

<div id="container">

  <header>
    
    <hgroup>
      <h1 class="semantics-only"><a href="/">Premier Collection : Author Access</a></h1>
      <h2 class="semantics-only">Welcome to Premier Collection Author Access!</h2>
      <h3 class="semantics-only">Your personal resource for promoting you &amp; your titles for maximum exposure &amp; circulation.</h3>
    </hgroup>
  
  </header>
  
  <section>
  
    <article id="welcome">
      
      <h1 class="semantics-only">Welcome!</h1>
      
      <div class="inner">
        <p>A single download delivers a folder of custom tools specific to your product:</p>
        <ul id="two-column" class="clearfix">
          <li><i>Your book&rsquo;s Cover Art</i></li>
          <li><i>Custom email template</i></li>
          <li><i>Elsevier marketing plan</i></li>
          <li><i>Interview source notes</i></li>
          <li class="last"><i>Flyer with friends &amp; family savings offer</i></li>
          <li class="last"><i>Social media guidelines</i></li>
        </ul>
        <hr />
        <p>Using these materials you can create your own professional communications addressing friends, colleagues and other potential customers. Use the search field to the right to get started.</p>
      </div>
      
    </article>
    
    <article id="step-one" class="sidebar"><div class="inner">
      
      <h1 class="semantics-only">Step 1. Access.</h1>
      <p>Type in your name and hit the <b class="uc">search</b> button.</p>
      <form action="" method="post">
        <fieldset>
          <input type="text" id="search-str" name="search-str" />
          <input type="submit" id="submit" name="submit" class="semantics-only" value="Search" />
        </fieldset>
      </form>
      
      <?php
      if ( !empty ( $matches ) )
      {
        if ( count( $matches ) < 10 )
        {
          // build the results unordered list
          $results = "<ul>\n";
          foreach ( $matches as $val )
          {
            $results .= "        <li><a href=\"http://" . $_SERVER['HTTP_HOST'] . $uri . "access/" . $val . "\">" . $val . "</a></li>\n";
          }
          $results .= "      </ul>\n";
        
          print $results;
        }
        else {
          print "      <p><i>There were too many matches, please narrow down your search.</i></p>\n";
        }
      }
      elseif ( isset( $_POST['search-str'] ) ) {
        print "      <p><i>Your search returned no results.</i></p>\n";
      }
      else {
        print "      <p>Click the link that appears to automatically download a zip file containing your custom communication tools.</p>\n";
      }
      ?>
      
    </div></article>
    
    <article id="step-two" class="sidebar"><div class="clearfix inner">
      
      <h1 class="semantics-only">Step 2. Share.</h1>
      <p>Please click to answer a brief survey. The feedback you provide will help us bring you even more useful and effective communication tools.</p>
      <a href="/survey/" id="btn-take-the-survey" class="semantics-only">Take the Survey</a>
      
    </div></article>
  
  </section>
  
  <aside id="get-fifteen-percent-off">
  
    <h2 class="semantics-only">Get 15% Off!</h2>
    <p class="semantics-only">Offer your friends and family an exclusive 15% discount on the purchase of your title with your unique e-flyer!</p>
  
  </aside>
  
  <footer><div class="inner">
    
    <p><small>&copy; 2011 Elsevier Inc. All Rights Reserved. <a href="http://elseiver.com/" id="elsevier-logo"><img src="<?=$uri ?>assets/images/elsevier-logo.gif" alt="Elsevier" /></a></small></p>
    
  </div></footer>

</div>

</body>
</html>
