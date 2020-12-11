<?php



function ln_theme_styles(){

    $version = date("hmi");
    $directory = get_template_directory_uri();

    // CSS

    wp_enqueue_style( "theme_css", $directory . "/style.css", array(), $version, false );
    wp_enqueue_style( "fontawesome_css", "https://kit.fontawesome.com/db192ad007.js", array(), $version, false );
    wp_enqueue_style( "aos_css", "https://unpkg.com/aos@next/dist/aos.css", array(), $version, false );

    // JAVASCRIPT

    wp_enqueue_script( "jquery_js", $directory . "/assets/js/lib/jquery-3.5.1.min.js", $version, true );
    wp_enqueue_script( "main_js", $directory . "/assets/js/main.js", $version, ["jquery_js"] , true);
    wp_enqueue_script( "fontawesome", "https://kit.fontawesome.com/db192ad007.js", $version, [] , true);
    wp_enqueue_script( "aos_js", "https://unpkg.com/aos@next/dist/aos.js", $version, [] , true);
    wp_enqueue_script( "create_js", "https://code.createjs.com/1.0.0/createjs.min.js", $version, [] , false);
    wp_enqueue_script( "teste_js", $directory . "/assets/js/teste.js", $version, [] , true);
	wp_enqueue_script( "banner_animado_js", $directory . "/banner-b.js", $version, [] , true);
//	wp_enqueue_script( 'banner_b_js', "http://localhost/wp/banner-b.js", array(), "1.0.0", true );

}

function ln_after_setup(){
    // MENU NAVEGAÇÃO
    register_nav_menu( "primary-menu",("Menu Principal") );
}


//Injection javascript inside tag head <script>code js</script>

    function custom_internal_javascript(){
	?>
<script>
var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
function init() {
	canvas = document.getElementById("canvas");
	anim_container = document.getElementById("animation_container");
	dom_overlay_container = document.getElementById("dom_overlay_container");
	var comp=AdobeAn.getComposition("9CDA72EBAA2EF24D99FA234E0BA48B21");
	var lib=comp.getLibrary();
	var loader = new createjs.LoadQueue(false);
	loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
	loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
	var lib=comp.getLibrary();
	loader.loadManifest(lib.properties.manifest);
}
function handleFileLoad(evt, comp) {
	var images=comp.getImages();	
	if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
}
function handleComplete(evt,comp) {
	//This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
	var lib=comp.getLibrary();
	var ss=comp.getSpriteSheet();
	var queue = evt.target;
	var ssMetadata = lib.ssMetadata;
	for(i=0; i<ssMetadata.length; i++) {
		ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
	}
	var preloaderDiv = document.getElementById("_preload_div_");
	preloaderDiv.style.display = 'none';
	canvas.style.display = 'block';
	exportRoot = new lib.bannerb();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.framerate = lib.properties.fps;
		createjs.Ticker.addEventListener("tick", stage);
	}	    
	//Code to support hidpi screens and responsive scaling.
	AdobeAn.makeResponsive(true,'width',true,1,[canvas,preloaderDiv,anim_container,dom_overlay_container]);	
	AdobeAn.compositionLoaded(lib.properties.id);
	fnStartAnimation();
}
</script>

<?php
}

    add_action( 'wp_enqueue_scripts', 'custom_internal_javascript' );

    //filter for capture body tag and inject init() function
    add_filter('template_include','start_buffer_capture',1);

function start_buffer_capture($template) {
  ob_start('end_buffer_capture');  // Start Page Buffer
  return $template;
}

function end_buffer_capture($buffer) {
  return str_replace('<body','<body onload="init()"',$buffer);
}