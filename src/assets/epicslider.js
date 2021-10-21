(function(){


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                               MEDIA QUERIES.                            │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */


    // Flickity options, defaults
    var options = {
        // settings
        prevNextButtons: false,
        wrapAround:true,
        autoPlay:false,
        pageDots: true,
        adaptiveHeight: true,
        fade: true,


        // methods
        on: {
            // when ready
            ready: function() {
                // play video 1.
				videos[0].play();
				videos[0].style.objectFit = "cover";
				runProgressBar(0);
            }
        }
    };


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                  CONTROLLER CAROUSEL DEFINITIONS.                       │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    var buttonGroup = document.getElementById('flickity-control');

    var buttons = buttonGroup.querySelectorAll('.nav-item');

    buttons = fizzyUIUtils.makeArray( buttons );


    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                           MAIN CAROUSEL.                                │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

        
        // find flickity block to use
        const target = document.getElementById('flickity-main');

        // Find all video tags
        const videos = target.getElementsByTagName('video');

        // get the length of array of videos (3)
        const videosLength = videos.length;

        // Create a new flickity instance
        const flickity = new Flickity(target, options);

        // Loop number of videos in array and add event listeners
        for(let i = 0;i < videosLength; i++){
			
            // Wait for the video metadata to be loaded
            videos[i].addEventListener('loadedmetadata',function(){
                // console output the video duration
                console.log("Video Duration_" + i + " : "+ videos[i].duration);
            },false);
            
            // add listener to end of the video...
            videos[i].addEventListener('ended',function(){

                // switch flickity to the next slide.
                flickity.next('true');
            },false);

        }

        // If there is a flickity change, run the changeSlide function.
        flickity.on('change',changeSlide);

        // play the video when the slide changes.
        function changeSlide(index) {

            // loop number of videos (3)
            for(let i = 0;i < videosLength; i++){
				
				//default is 'contain' for the poster image. switch back to cover.
				videos[i].style.objectFit = "cover";

				// reset the video back to the start
				videos[i].currentTime = 0;

				// play it!
				videos[index].play();
            }
			
			runProgressBar(index, videos[index].duration);
           
        }



    /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
    *   │                                                                         │░
    *   │                           CONTROLLER CAROUSEL.                          │░
    *   │                        (after flickity declared).                       │░
    *   │                                                                         │░
    *   └─────────────────────────────────────────────────────────────────────────┘░
    *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    */

    buttonGroup.addEventListener( 'click', function( event ) {
        var index = buttons.indexOf( event.target );
        flickity.select( index );
    });




    function runProgressBar(index,duration=10) {
        resetAllProgressBars();
        progress = buttons[index].querySelector('.progress');
        progress.style.animationPlayState = "running";
        progress.style.animationDuration = duration+'s';
    }


    function resetAllProgressBars() {
        var progressbars = buttonGroup.querySelectorAll('.progress');
        progressbars = fizzyUIUtils.makeArray( progressbars );

        for(let i = 0;i < progressbars.length; i++){
            progressbars[i].style.animation = 'none';
            progressbars[i].offsetHeight; /* trigger reflow */
            progressbars[i].style.animation = null; 
        }
    }


}());