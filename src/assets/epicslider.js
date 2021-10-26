(function(){


        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                                                                         │░
        *   │                       VARIABLES / CONSTANTS.                            │░
        *   │                                                                         │░
        *   └─────────────────────────────────────────────────────────────────────────┘░
        *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
        */

                var waittime = 3; // seconds
                var duration=10;  // default duration in seconds

                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                               Navigation                                │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                var buttonGroup = document.getElementById('flickity-control');
                var buttons = buttonGroup.querySelectorAll('.nav-item');
                buttons = fizzyUIUtils.makeArray( buttons );


                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                              Flicity Target                             │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                const target = document.getElementById('flickity-main');


                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                                 Videos                                  │
                *   └─────────────────────────────────────────────────────────────────────────┘ */        
                const videos = target.getElementsByTagName('video');
                const videosLength = videos.length;


        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                                                                         │░
        *   │                           FLICKITY INSTANCE.                            │░
        *   │                                                                         │░
        *   └─────────────────────────────────────────────────────────────────────────┘░
        *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
        */

                var options = {
                    prevNextButtons: false,
                    wrapAround:true,
                    autoPlay:false,
                    pageDots: true,
                    adaptiveHeight: false,
                    fade: true,
                    on: {
                        ready: function() {
                            changeSlide(0); // play video 1.
                        }
                    }
                };
                const flickity = new Flickity(target, options);



        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                                                                         │░
        *   │                            EVENT LISTENERS                              │░
        *   │                                                                         │░
        *   └─────────────────────────────────────────────────────────────────────────┘░
        *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
        */

                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                        Video Ended on ALL videos                        │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                for(let i = 0;i < videosLength; i++){
                    videos[i].addEventListener('ended',function(){
                        flickity.next('true');                
                    },false);
                }

                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                   on Click, Select flickity slide.                      │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                buttonGroup.addEventListener( 'click', function( event ) {
                    var index = buttons.indexOf( event.target );
                    flickity.select( index );
                });

                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                   on Change, run changeSlide function.                  │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                flickity.on('change',changeSlide);



        /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
        *   │                                                                         │░
        *   │                               FUNCTIONS                                 │░
        *   │                                                                         │░
        *   └─────────────────────────────────────────────────────────────────────────┘░
        *    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
        */


                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                           Change the slide                              │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                async function changeSlide(index) {
                    
                    if (index in videos) { 
                        duration = videos[index].duration; // set video duration instead of default.
                    }

                    resetAllVideos();

                    resetAllProgressBars();

                    runProgressBar(index, duration + waittime);

                    await sleep(waittime*1000);

                    // play video
                    if (index in videos) { 
                        playVideo(index); 
                    } else {
                        await sleep(duration*1000);
                        flickity.next('true');
                    }
                    
                    
                    duration=10; // reset back.
                }


                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                               Progress Bar                              │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                function runProgressBar(index,duration) {
                    duration = duration;
                    progress = buttons[index].querySelector('.progress');
                    progress.style.animationDuration = duration+'s'; // s for seconds
                    progress.style.animationPlayState = "running";
                }


                /*  ┌─────────────────────────────────────────────────────────────────────────┐ 
                *   │                            Reset ALL Videos                             │
                *   └─────────────────────────────────────────────────────────────────────────┘ */
                function resetAllVideos() {
                    
                    for(let i = 0;i < videosLength; i++){

                        // change to 'contain' for the poster image.
                        videos[i].style.objectFit = "contain";

                        // remove-then-add-back source to see the poster image again
                        videos[i].src = ''; 
                        videos[i].removeAttribute('src');

                        // reset time
                        videos[i].currentTime = 0;

                        // pause video
                        videos[i].pause();
                    }
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