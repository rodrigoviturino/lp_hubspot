<!DOCTYPE html>

<html lang="pt-BR">

  <head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>LP Novartis</title>

    <link rel="stylesheet" href="<?= get_template_directory_uri();?>/style.css">



    <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>

<header class="header">   

<!-- Sessao Animação -->
<div id="animation_container" style="background-color:rgba(238, 238, 238, 1.00); width:750px; height:717px;">
		<canvas id="canvas" width="750" height="717" style="position: absolute; display: none; background-color:rgba(238, 238, 238, 1.00);"></canvas>
		<div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:750px; height:717px; position: absolute; left: 0px; top: 0px; display: none;">
		</div>
	</div>
    <div id='_preload_div_' style='position:relative; top:0; left:0; display: inline-block; height:717px; width: 750px; text-align: center;'>	<span style='display: inline-block; height: 100%; vertical-align: middle;'></span>	<img src=images/_preloader.gif?1607453883306 style='vertical-align: middle; max-height: 100%'/></div>
<!-- end Sessao Animação -->   
  
</header>