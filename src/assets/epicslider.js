(function(){


    // Flickity options, defaults
    var options = {
        // settings
        prevNextButtons: false,
        wrapAround:true,
        autoPlay:false,
        pageDots: true,
        adaptiveHeight: false,
        fade: true,


        // methods
        on: {
            // when ready
            ready: function() {
                // play video 1.
                changeSlide(0);
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
        const waittime = 3;

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

        // One-time : Loop number of videos in array and add event listeners
        for(let i = 0;i < videosLength; i++){

            /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
            *   │                     [EVENTLISTENER]: Metadata Load                      │
            *   └─────────────────────────────────────────────────────────────────────────┘ */
            videos[i].addEventListener('loadedmetadata',function(){
                // console.log("Video Duration_" + i + " : "+ videos[i].duration);
            },false);
            
            /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
            *   │                        [EVENTLISTENER]: Video Ended                     │
            *   └─────────────────────────────────────────────────────────────────────────┘ */
            videos[i].addEventListener('ended',function(){
                flickity.next('true');                // switch flickity to the next slide.
            },false);

        }

        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │          [EVENTLISTENER]: on Change, run changeSlide function.          │
        *   └─────────────────────────────────────────────────────────────────────────┘ */
        flickity.on('change',changeSlide);



        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                                                                         │░
        *   │                           Change the slide.                             │░
        *   │                                                                         │░
        *   └─────────────────────────────────────────────────────────────────────────┘░
        *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
        */
        // play the video (INDEX)
        async function changeSlide(index) {

            // reset the videos back to the start
            for(let i = 0;i < videosLength; i++){
                videos[i].style.objectFit = "contain";
                // remove-then-add-back source to see the poster image again
                var source = videos[i].src;
                videos[i].src = ''; 
                videos[i].removeAttribute('src');
                // reset time
                videos[i].currentTime = 0;
                videos[i].pause();
            }

            // set video duration
            var duration=12;
            if (index in videos) { 
                duration = videos[index].duration; 
            }

            // run progress bar
            runProgressBar(index, duration + waittime);
            
            // sleep
            await sleep(waittime*1000);

            // play video
			if (index in videos) { 
                playVideo(index); 
            } else {
                await sleep(10000);
                flickity.next('true');
            }

        }

        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                                                                         │░
        *   │                           CONTROLLER CAROUSEL.                          │░
        *   │                        (after flickity declared).                       │░
        *   │                                                                         │░
        *   └─────────────────────────────────────────────────────────────────────────┘░
        *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
        */

        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │          [EVENTLISTENER]: on Click, Select flickity slide.              │
        *   └─────────────────────────────────────────────────────────────────────────┘ */
        buttonGroup.addEventListener( 'click', function( event ) {
            var index = buttons.indexOf( event.target );
            flickity.select( index );
        });

        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                               Progress Bar                              │
        *   └─────────────────────────────────────────────────────────────────────────┘ */
        function runProgressBar(index,duration) {
            resetAllProgressBars();
            duration = duration;
            progress = buttons[index].querySelector('.progress');
            progress.style.animationDuration = duration+'s'; // s for seconds
            progress.style.animationPlayState = "running";
        }

        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                          Reset ALL Progress Bar                         │
        *   └─────────────────────────────────────────────────────────────────────────┘ */
        function resetAllProgressBars() {
            var progressbars = buttonGroup.querySelectorAll('.progress');
            progressbars = fizzyUIUtils.makeArray( progressbars );

            for(let i = 0;i < progressbars.length; i++){
                progressbars[i].style.animation = 'none';
                progressbars[i].offsetHeight; /* trigger reflow */
                progressbars[i].style.animation = null; 
            }
        }


        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                               Play video                                │
        *   └─────────────────────────────────────────────────────────────────────────┘ */
        function playVideo(index) {
            videos[index].play();
            videos[index].style.objectFit = "cover";
        }


        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                          Sleep function utility                         │
        *   └─────────────────────────────────────────────────────────────────────────┘ */
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

}());