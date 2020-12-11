<?php 

$directory = get_template_directory();

// INCLUDE
    require $directory . "/include/setup.php";

// HOOKS
    add_action( "wp_enqueue_scripts", "ln_theme_styles");
    add_action( "after_setup_theme", "ln_after_setup");


    //Injection javascript inside tag head <script>code js</script>

    function custom_internal_javascript(){
        ?>
    <script>
    window.onload = function(){
    let canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
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