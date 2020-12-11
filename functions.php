<?php 

$directory = get_template_directory();

// INCLUDE
    require $directory . "/include/setup.php";

// HOOKS
    add_action( "wp_enqueue_scripts", "ln_theme_styles");
    add_action( "after_setup_theme", "ln_after_setup");