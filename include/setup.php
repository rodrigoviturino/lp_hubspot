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
    wp_enqueue_script( "create_js", "https://code.createjs.com/1.0.0/createjs.min.js", $version, ["jquery_js"] , true);
    wp_enqueue_script( "teste_js", $directory . "/assets/js/teste.js", $version, ["jquery_js"] , false);
		wp_enqueue_script( "banner_animado_js", $directory . "/banner-b.js", $version, [] , false);
//	wp_enqueue_script( 'banner_b_js', "http://localhost/wp/banner-b.js", array(), "1.0.0", true );

}

function ln_after_setup(){
    // MENU NAVEGAÇÃO
    register_nav_menu( "primary-menu",("Menu Principal") );
}

