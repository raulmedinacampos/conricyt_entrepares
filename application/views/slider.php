<!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jssor.core.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jssor.utils.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jssor.slider.js"></script>
<script>
    jQuery(document).ready(function ($) {
        //Reference http://www.jssor.com/development/slider-with-slideshow.html
        //Reference http://www.jssor.com/development/tool-slideshow-transition-viewer.html

        var _SlideshowTransitions = [

        //Swing Outside in Stairs

/*        {$Duration: 1200, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 9, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseInWave, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.2, $ScaleVertical: 0.1, $Outside: true, $Round: { $Left: 1.3, $Top: 2.5} }

        //Dodge Dance Outside out Stairs

        , { $Duration: 1500, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.1, 0.9], $Top: [0.1, 0.9] }, $SlideOut: true, $FlyDirection: 9, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Outside: true, $Round: { $Left: 0.8, $Top: 2.5} }

        //Dodge Pet Outside in Stairs

        , { $Duration: 1500, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 9, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseInWave, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.2, $ScaleVertical: 0.1, $Outside: true, $Round: { $Left: 0.8, $Top: 2.5} }

        //Dodge Dance Outside in Random

        , { $Duration: 1500, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Outside: true, $Round: { $Left: 0.8, $Top: 2.5} }

        //Flutter out Wind

        , { $Duration: 1800, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $ScaleHorizontal: 1, $ScaleVertical: 0.2, $Outside: true, $Round: { $Top: 1.3} }

        //Collapse Stairs

        , { $Duration: 1200, $Delay: 30, $Cols: 8, $Rows: 4, $Clip: 15, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2049, $Easing: $JssorEasing$.$EaseOutQuad }*/

        //Collapse Random

        , { $Duration: 1000, $Delay: 80, $Cols: 8, $Rows: 4, $Clip: 15, $SlideOut: true, $Easing: $JssorEasing$.$EaseOutQuad }

        //Vertical Chess Stripe

/*        , { $Duration: 1000, $Cols: 12, $FlyDirection: 8, $Formation: $JssorSlideshowFormations$.$FormationStraight, $ChessMode: { $Column: 12} }

        //Extrude out Stripe

        , { $Duration: 1000, $Delay: 40, $Cols: 12, $SlideOut: true, $FlyDirection: 2, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $ScaleHorizontal: 0.2, $Opacity: 2, $Outside: true, $Round: { $Top: 0.5} }

        //Dominoes Stripe

        , { $Duration: 2000, $Delay: 60, $Cols: 15, $SlideOut: true, $FlyDirection: 8, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: $JssorEasing$.$EaseOutJump, $Round: { $Top: 1.5} }*/

        ];

        var options = {

            $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false

            $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1

            $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000

            $PauseOnHover: 0,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3



            $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false

            $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500

            $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20

            //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container

            //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container

            $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0

            $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1

            $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.

            $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, direction navigator container, thumbnail navigator container etc).

            $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, default value is 1

            $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)



            $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not

                $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow

                $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow

                $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random

                $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false

            }

        };



        var jssor_slider2 = new $JssorSlider$("slider2_container", options);



        //responsive code begin

        //you can remove responsive code if you don't want the slider scales while window resizes

        function ScaleSlider() {
            var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;

            if (parentWidth)
                jssor_slider2.$SetScaleWidth(Math.min(parentWidth, 600));
            else
                window.setTimeout(ScaleSlider, 30);
        }

        ScaleSlider();

        if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
            $(window).bind('resize', ScaleSlider);
        }
        //responsive code end

		$('#slider').shadow('lifted2');
		$('.jquery-shadow').css("box-shadow", "none");
    });
</script>

<div id="slider">
  <div id="sliderDiv">
    <!-- Jssor Slider Begin -->
    <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px;">
      <!-- Slides Container -->
      <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 872px; height: 237px; overflow: hidden;">
        <div> <a u=image href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/slide/slideImg.png" /></a> </div>
        <div> <a u=image href="<?php echo base_url(); ?>sobre-el-evento/actividades-extraseminario"><img src="<?php echo base_url(); ?>images/slide/caminata.jpg" /></a> </div>
        <div> <a u=image href="<?php //echo base_url(); ?>programa/22-septiembre-2014"><img src="<?php //echo base_url(); ?>images/slide/22-septiembre.jpg" /></a> </div>
        <div> <a u=image href="<?php //echo base_url(); ?>programa/23-septiembre-2014"><img src="<?php //echo base_url(); ?>images/slide/23-septiembre.jpg" /></a> </div>
      </div>
      <a style="display: none" href="http://www.jssor.com">jQuery Carousel</a>
    </div>
    <!-- Jssor Slider End -->
  </div>
</div>
