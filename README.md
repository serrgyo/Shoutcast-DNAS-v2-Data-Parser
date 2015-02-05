# Shoutcast-DNAS-v2-Data-Parser
Used to pull information from a shoutcast server's public presence and parse it for your own output.  
Helpful if you wish to keep a record of songs played on a station, or for a webpage you are building.


This is used to parse the bit of information you can pull
	from a shoutcast server.  The URL you use is
	http://www.example.com:port/stats?sid=y 
	
	Replace domain with the one you wish to monitor, the port is the main
	port of the server, and 'y' is the actual server you wish to monitor.  
	For most folks that would be sid=1.  But with the newest incarnation
	of the ShoutCAST DNAS, you can actually host many servers on the same
	port.
	
	The variables that are available are:
	
		CURRENTLISTENERS- Number of listeners on this stream
		PEAKLISTENERS   - Highest number of listeners
		MAXLISTENERS    - Largest number of listeners per stream/server
		UNIQUELISTENERS - Shows unique listeners (some folks listen on 
	                    multiple devices from the same ip)
		AVERAGETIME		  - Average listen time (in seconds)
		SERVERGENRE		  - If is set, this will be the stream's genre
		SERVERURL 	    - Web address of the station's homepage
		SERVERTITLE     - What the station/stream calls themselves
		SONGTITLE       - What the streaming software sends, usually a
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
		BITRATE         - data rate in kb.  (ie 128 would be 128kb)
		CONTENT         - mime type for stream (audio/video/etc)
		VERSION         - server version
		
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
