
  <link href="video-js.css" rel="stylesheet" type="text/css">
  <script src="video.js"></script>
  <style>
	video {
    right: 0;
    bottom: 0;
    z-index: -1;               // Put on background

    min-width: 100%;           // Expand video
    min-height: 100%;
    width: auto;               // Keep aspect ratio
    height: auto;

    top: 50%;                  // Vertical center offset
    left: 50%;                 // Horizontal center offset

    -webkit-transform: translate(-50%,-50%);
    -moz-transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);         // Cover effect: compensate the offset

    background: #ffffff;      // Background placeholder, not always needed
    background-size: cover;
  }
  </style>
  <script>
    videojs.options.flash.swf = "video-js.swf";
  </script>
  <video  class="video-js vjs-default-skin" width="100%" height="100%" muted data-setup='{"controls": false, "autoplay": true, "preload": "true", "loop" : true}'>
     <source src="data/db.mp4" type='video/mp4' />  
  </video>
