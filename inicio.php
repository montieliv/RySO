﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bienvenido!</title>
</head>
<body>

    <!-- Caption Style -->
    <!-- use jssor.slider.min.js instead for release -->
    <!-- jssor.slider.min.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="js/jssor.core.js"></script>
    <script type="text/javascript" src="js/jssor.utils.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>
    <script>

        jssor_slider2_starter = function (containerId) {
            var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                $SlideWidth: 1500,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 5, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 3,                             //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 0,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 0,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 5,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 0,                            //[Optional] The offset position to park thumbnail
                    $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $DisableDrag: true                              //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_slider2 = new $JssorSlider$(containerId, options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    var sliderWidth = parentWidth;

                    //keep the slider width no more than 602
                    sliderWidth = Math.min(sliderWidth, 602);

                    jssor_slider2.$SetScaleWidth(sliderWidth);
                }
                else
                    $JssorUtils$.$Delay(ScaleSlider, 30);
            }

            ScaleSlider();
            $JssorUtils$.$AddEvent(window, "load", ScaleSlider);


            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $JssorUtils$.$OnWindowResize(window, ScaleSlider);
            }

            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $JssorUtils$.$AddEvent(window, "orientationchange", ScaleSlider);
            //}
            //responsive code end
        };
    </script>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 100%; height: 650px; background: #fff; overflow: hidden; ">
        
        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 29px; width: 99%; height: 600px; border: 1px solid gray; -webkit-filter: blur(0px); background-color: #fff; overflow: hidden;">
            <div>
                <div style=" overflow: hidden; color: #000;">
                    <iframe src="index.php" width="100%" height="600px"></iframe></div>
                <div u="thumb">Área de Autenticación</div>
            </div>
            <div>
                <div style=" overflow: hidden; color: #000;"><iframe src="http://10.86.50.35/aeycSite/dictamenes.php" width="100%" height="600px"></iframe></div>
                <div u="thumb">Galeria de Imágenes</div>
            </div>
            <div>
                <div style="overflow: hidden; color: #000;"><iframe src="http://10.86.50.35/aeycSite/ubicapozos.php" width="100%" height="600px"></iframe></div>
                <div u="thumb">Avisos Importantes</div>
            </div>
            <div>
                <div style="overflow: hidden; color: #000;"><iframe src="http://10.86.50.35/aeycSite/pozos.php" width="100%" height="600px"></iframe></div>
                <div u="thumb">Contáctanos</div>
            </div>
            <div>
                <div style=" overflow: hidden; color: #000;"><iframe src="http://10.86.50.35/aeycSite/home.php" width="100%" height="600px"></iframe></div>
                <div u="thumb">Ayuda</div>
            </div>
        </div>
        
        <!-- ThumbnailNavigator Skin Begin -->
        <div u="thumbnavigator" class="jssort12" style="position: absolute; width: 900px; height: 30px; left:0px; top: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            <style>
                /* jssor slider thumbnail navigator skin 12 css */
                /*
                .jssort12 .p            (normal)
                .jssort12 .p:hover      (normal mouseover)
                .jssort12 .pav          (active)
                .jssort12 .pav:hover    (active mouseover)
                .jssort12 .pdn          (mousedown)
                */
                .jssort12 .w, .jssort12 .phv .w
                {
                	cursor: pointer;
                	position: absolute;
                	width: 12.5em;  /* caja gris */
                	height: 28px;
                	border: 4px solid gray;
                	top: 0px;
                	left: -1px;
                }
                .jssort12 .pav .w, .jssort12 .pdn .w
                {
                	border-bottom: 1px solid #fff;
                }
                .jssort12 .c
                {
                    color: #000;
                    font-size:1em;             	
                }
                .jssort12 .p .c, .jssort12 .pav:hover .c
                {
                	background-color:#eee;
                }
                .jssort12 .pav .c, .jssort12 .p:hover .c, .jssort12 .phv .c
                {
                	background-color:#fff;
                }
            </style>
            <div u="slides" style="cursor: move; top:0px; left:0px; border-left: 1px solid gray;">
                <div u="prototype" class="p" style="POSITION: absolute; width: 180px; height: 30px; TOP: 0; LEFT: 0; padding:0px;">
                    <div class=w><ThumbnailTemplate class="c" style=" width: 12.5em; height: 30px; position:absolute; TOP: 0; LEFT: 0; line-height:28px; text-align:center;"></ThumbnailTemplate></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- ThumbnailNavigator Skin End -->
        <!-- Trigger -->
        <script>
            jssor_slider2_starter('slider2_container');
        </script>
    </div>
    <!-- Jssor Slider End -->
</body>
</html>