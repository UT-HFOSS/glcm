<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $page_title.$site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="http://use.typekit.com/lmo6wci.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
	<?php echo $header_block; ?>
		<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
</head>


<?php
  // Add a class to the body tag according to the page URI
  // we're on the home page
  if (count($uri_segments) == 0)
  {
    $body_class = "page-main";
  }
  // 1st tier pages
  elseif (count($uri_segments) == 1)
  {
    $body_class = "page-".$uri_segments[0];
  }
  // 2nd tier pages... ie "/reports/submit"
  elseif (count($uri_segments) >= 2)
  {
    $body_class = "page-".$uri_segments[0]."-".$uri_segments[1];
  }

?>

<body id="page" class="<?php echo $body_class; ?>">

<?php echo $header_nav; ?>

  <!-- top bar-->
  <div id="top-bar">

  </div>

	<!-- wrapper -->
	<div class="rapidxwpr floatholder">

		<!-- header -->
		<div id="header">

			<!-- logo -->
			<?php if ($banner == NULL): ?>
			<div id="logo">
				<h1><a href="<?php echo url::site();?>"><?php echo $site_name; ?></a></h1>
				<span><?php echo $site_tagline; ?></span>
			</div>
			<?php else: ?>
			<a href="<?php echo url::site();?>" id="glcm-logo"><img src="<?php echo $banner; ?>" alt="<?php echo $site_name; ?>" /></a>
			<?php endif; ?>
			<!-- / logo -->
			
			<div id="banner-functions">
				<!-- searchbox -->
				<div id="searchbox">
					<!-- searchform -->
					<?php echo $search; ?>
					<!-- / searchform -->
				</div>
				<!-- / searchbox -->
			
				<div id="get-updates">		
					<!-- submit incident -->
					<?php echo $submit_btn; ?>
					<!-- / submit incident -->
				</div>
				
				<div id="socialmedia">
					<!-- Youtube -->
					<a href="https://www.youtube.com/user/GreatLakesCommonsMap/" target="_top">
						<img src="/themes/glcm/images/youtube_32.png" alt="YouTube" />
					</a>
					<!-- G+ -->
					<a href="https://plus.google.com/u/0/communities/112084558161235826155?prsrc=3" target="_top">
						<img src="/themes/glcm/images/google-plus_32.png" alt="Google+" />
					</a>
					<!-- Twitter -->
					<a href="https://twitter.com/GL_Commons" target="_top">
						<img src="/themes/glcm/images/twitter_32.png" alt="Twitter" />
					</a>
					<!-- MeetUp (link TBD) -->
					<a>
						<img src="/themes/glcm/images/meetup_32.png" alt="MeetUp" />
					</a>
					<!-- Facebook -->
					<a href="https://www.facebook.com/GreatLakesCommonsMap" target="_top">
						<img src="/themes/glcm/images/facebook_32.png" alt="Facebook" />
					</a>
				</div>
				
			</div>

			<?php
				// Action::main_sidebar - Add Items to the Entry Page Sidebar
				Event::run('ushahidi_action.main_sidebar');
			?>

		</div>
		<!-- / header -->
         <!-- / header item for plugins -->
        <?php
            // Action::header_item - Additional items to be added by plugins
	        Event::run('ushahidi_action.header_item');
        ?>

		<!-- main body -->
		<div id="middle">
			<div class="background layoutleft">

				<!-- mainmenu -->
				<div id="mainmenu" class="clearingfix">
					<ul>
						<?php nav::main_tabs($this_page); ?>
					</ul>

				</div>
				<!-- / mainmenu -->
