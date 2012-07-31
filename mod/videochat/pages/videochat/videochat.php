<?php
	// Load Elgg engine
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");

	// Get the specified blog post
	$roomname = get_input('roomname');
  if (!$roomname) $roomname="Lobby";

	$ver=explode('.', get_version(true));			
	if ($ver[1]>7) {
    elgg_push_breadcrumb($roomname, "videochat/$roomname");
  }

  global $CONFIG;
  //swf to load
  $baseurl=$CONFIG->url."mod/videochat/";
  $swfurl=$baseurl."2wvc.swf?room=".$roomname;

  $title=$roomname;

 $area1 = <<< htmlEND
<div id="videochat_container" style="height:700px; border: solid 4px #AAA; background: #555">
<object width="100%" height="100%">
<param name="movie" value="$swfurl" /><param name="bgcolor" value="#777777" /><param name="salign" value="lt" /><param name="scale" value="noscale" /><param name="allowFullScreen" value="true" /><param name="allowscriptaccess" value="always" /> <param name="base" value="$baseurl" /> <param name="wmode" value="transparent" /> <embed width="100%" height="100%" scale="noscale" salign="lt" src="$swfurl" bgcolor="#777777" base="$baseurl" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed>
</object>
<noscript>
<p align=center><a href="http://www.videowhisper.com/?p=2+Way+Video+Chat"><strong>VideoWhisper 2 Way Video Chat Script</strong></a></p>
<p align="center"><strong>This content requires the Adobe Flash Player:
<a href="http://www.macromedia.com/go/getflash/">Get Flash</a></strong>!</p>
</noscript>
</div>
htmlEND;

 	// Display through the correct canvas area
	$body = elgg_view_layout("one_column", $area1);

	// Display page
  if ($ver[1]>7) echo elgg_view_page($title,$body, 'default', array( 'sidebar' => "" ));
  else page_draw($title,$body);

?>
