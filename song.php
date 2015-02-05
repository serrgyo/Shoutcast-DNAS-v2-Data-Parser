<?php

/*

	This is used to parse the bit of information you can pull
	from a shoutcast server.  The URL you use is
	http://www.example.com:port/stats?sid=y 
	
	Replace domain with the one you wish to monitor, the port is the main
	port of the server, and 'y' is the actual server you wish to monitor.  
	For most folks that would be sid=1.  But with the newest incarnation
	of the ShoutCAST DNAS, you can actually host many servers on the same
	port.
	
	The variables that are available are:
	
		CURRENTLISTENERS - Number of listeners on this stream
		PEAKLISTENERS    - Highest number of listeners
		MAXLISTENERS     - Largest number of listeners per stream/server
		UNIQUELISTENERS  - Shows unique listeners (some folks listen on 
								 multiple devices from the same ip)
		AVERAGETIME		  - Average listen time (in seconds)
		SERVERGENRE		  - If is set, this will be the stream's genre
		SERVERURL 	     - Web address of the station's homepage
		SERVERTITLE      - What the station/stream calls themselves
		SONGTITLE	     - What the streaming software sends, usually a
								 combo of Artist - Song Name
		STREAMHITS		  - How many times listeners have connected to stream
								 since it started  (cumalative)
		STREAMSTATUS	  - 1 if on, 0 if off
		BACKUPSTATUS	  - 1 if on, 0 if off (implies server has a file it plays
								 when there isn't a source connected.
		STREAMPATH		  - what the listener puts into their audio software to
								 listen.  Usually it would be http://server:port/path?sid=1
		STREAMUPTIME	  - Time (in seconds) of how long the stream has been up since
								 (re)start.
		BITRATE			  - data rate in kb.  (ie 128 would be 128kb)
		CONTENT			  - mime type for stream (audio/video/etc)
		VERSION			  - server version
		
	Functions included in this script:
	
	   secs_to_str      - parses an integer and turns it into human-readable string
	   					    (ie:  hours minutes seconds)
	   					    
	   					    
   =====================  COPYRIGHT NOTICE  ========================
   
   ShoutCAST DNAS v2 data parser by Thomas Kroll is licensed under a 
   
   Creative Commons Attribution-ShareAlike 4.0 International License
   
   Based on a work at http://www.zhivco.com/song.php.txt
   
   =================================================================
     If you choose to use this script in part or whole, please
     place credit where credit is due.  You can simply email me
     
     zhivotnoya [at] gmail [dot] com  with a link to your work(s).
     
     All that I ask is that this script in some way inspires/helps
     you in your programming endeavors.
     
   =================================================================


*/

$derp = "Nope";  /*  serves no real purpose :D */

/* --BEGIN: functions */

function secs_to_str ($duration)
{
    $periods = array(
        'day' => 86400,
        'hour' => 3600,
        'minute' => 60,
        'second' => 1
    );
 
    $parts = array();
 
    foreach ($periods as $name => $dur) {
        $div = floor($duration / $dur);
 
        if ($div == 0){
            continue;
        } else {
            if ($div == 1) {
                $parts[] = $div . " " . $name;
            } else {
                $parts[] = $div . " " . $name . "s";
            }
        }
        $duration %= $dur;
    }
 
    $last = array_pop($parts);
 
    if (empty($parts)) {
        return $last;
    } else {
        return join(', ', $parts) . " and " . $last;
    }
}

/* --END: functions */

/*  Get Artist - Song - Server Name */

$server = "http://radio.eurotruckradio.com:8002/stats?sid=1";

$srv_url = urlencode($server);

$sc_stats = simplexml_load_file($srv_url);

/* output starts here */

echo "<html><head><title>ShoutCAST stream info parser</title></head><body>";
echo "<center><table border=0>";
echo "<tr><td align=\"right\">Station:</td><td><a href=\"".$sc_stats->SERVERURL."\">".$sc_stats->SERVERTITLE."</a></td></tr>";
echo "<tr><td align=\"right\">Currently Playing:</td><td>".$sc_stats->SONGTITLE."</td></tr>";
echo "<tr><td align=\"right\">Listeners:</td><td>".$sc_stats->CURRENTLISTENERS." of ".$sc_stats->MAXLISTENERS." [Peak: ".$sc_stats->PEAKLISTENERS."]</td></tr>";
echo "<tr><td align=\"right\">Stream Uptime:</td><td>". secs_to_str($sc_stats->STREAMUPTIME) ."</td></tr>";
echo "</table><br /><br />";

/* end of useful output */

// please leave this line in for copyright reasons as outlined above.  Thanks!
echo "<a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/4.0/\"><img alt=\"Creative Commons License\" style=\"border-width:0\" src=\"https://i.creativecommons.org/l/by-sa/4.0/88x31.png\" /></a><br /><span xmlns:dct=\"http://purl.org/dc/terms/\" href=\"http://purl.org/dc/dcmitype/Text\" property=\"dct:title\" rel=\"dct:type\">ShoutCAST DNAS v2 data parser</span> by <a xmlns:cc=\"http://creativecommons.org/ns#\" href=\"http://www.zhivco.com/\" property=\"cc:attributionName\" rel=\"cc:attributionURL\">Thomas Kroll</a> is licensed under a <a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/4.0/\">Creative Commons Attribution-ShareAlike 4.0 International License</a>.<br />Based on a work at <a xmlns:dct=\"http://purl.org/dc/terms/\" href=\"http://www.zhivco.com/song.php.txt\" rel=\"dct:source\">http://www.zhivco.com/song.php.txt</a>";

/* end of document */
echo "</center></body></html>";



?>
