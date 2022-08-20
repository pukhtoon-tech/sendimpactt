"use strict"
								var tpj=jQuery;

					var revapi10;
					tpj(document).ready(function() {
						if(tpj("#rev_slider_10_1").revolution == undefined){
							revslider_showDoubleJqueryError("#rev_slider_10_1");
						}else{
							revapi10 = tpj("#rev_slider_10_1").show().revolution({
								sliderType:"standard",
			jsFileLocation:"//localhost/revslider-standalone/revslider-standalone/revslider/public/assets/js/",
								sliderLayout:"fullwidth",
								dottedOverlay:"none",
								delay:9000,
								navigation: {
									onHoverStop:"off",
								},
								visibilityLevels:[1240,1024,778,480],
								gridwidth:1400,
								gridheight:830,
								lazyType:"none",
								parallax: {
									type:"mouse",
									origo:"enterpoint",
									speed:400,
									levels:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,55],
									type:"mouse",
								},
								shadow:0,
								spinner:"spinner0",
								stopLoop:"off",
								stopAfterLoops:-1,
								stopAtSlide:-1,
								shuffle:"off",
								autoHeight:"off",
								disableProgressBar:"on",
								hideThumbsOnMobile:"off",
								hideSliderAtLimit:0,
								hideCaptionAtLimit:0,
								hideAllCaptionAtLilmit:0,
								debugMode:false,
								fallbacks: {
									simplifyAll:"off",
									nextSlideOnWindowFocus:"off",
									disableFocusListener:false,
								}
							});
						}
						});	/*ready*/
