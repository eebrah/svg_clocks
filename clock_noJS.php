<?php

if( substr_count( $_SERVER[ 'HTTP_ACCEPT_ENCODING' ], 'gzip' ) ) { ob_start( "ob_gzhandler" ); } else {	ob_start(); }

date_default_timezone_set( "Africa/Nairobi" );

$GMTDiff = ( ( ( int ) date( "O" ) ) / 100 );

$hour = ( int ) date( "g" );
$minute = ( int ) date( "i" );
$second = ( int ) date( "s" );

$hour = ( -1 * ( $GMTDiff - 3 ) ) + ( $hour + ( $minute / 60 ) + ( $second / 3600 ) );
$minute = $minute + ( $second / 60 );

$output = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
<svg xmlns="http://www.w3.org/2000/svg"
	 xmlns:xlink="http://www.w3.org/1999/xlink"
	 width="501" height="501"
	 onload="init( evt );">
	 
	<title>SVG Clock</title>

	<circle cx="250" cy="250" 
	        r="200" 
	        fill="#FFFFFF" 
	        stroke="black"
	        stroke-width="20" />
	        
	<circle cx="250" cy="250" 
	        r="20" 
	        fill="#000000" />
	       
	<g fill="black" stroke="black">
		
		<path d="M 240,240 l 130,0 0,21 -130,0 z"
		      fill="black"
		      stroke="none">
			<animateTransform attributeName="transform"
							  begin="0s"
							  dur="43200s"
					 		  type="rotate"
					 		  from="' . ( ( $hour * 30 ) - 90 ) . ' 250 250"
					 		  to="' . ( 360 + ( $hour * 30 ) - 90 ) . ' 250 250"
					 		  repeatCount="indefinite" />
		</path>
			     
		<path d="M 240,240 l 170,0 0,21 -170,0 z"
		      fill="black"
		      stroke="none">
			<animateTransform attributeName="transform"
							  begin="0s"
							  dur="3600s"
					 		  type="rotate"
					 		  from="' . ( ( $minute * 6 ) - 90 ) . ' 250 250"
					 		  to="' . ( 360 + ( $minute * 6 ) - 90 ) . ' 250 250"
					 		  repeatCount="indefinite" />
		</path>
				     
		<path d="M 240,247 l 170,0 0,7 -170,0 z"
		      fill="red"
		      stroke="none">
			<animateTransform attributeName="transform"
							  begin="0s"
							  dur="60s"
					 		  type="rotate"
					 		  from="' . ( ( $second * 6 ) - 90 ) . ' 250 250"
					 		  to="' . ( 360 + ( $second * 6 ) - 90 ) . ' 250 250"
					 		  repeatCount="indefinite" />
		</path>
				
	</g> 
	
	<circle cx="250" cy="250" 
	        r="10" 
	        fill="red" />	     

</svg>
';

header("Content-type: text/xml");

echo $output;

?>
