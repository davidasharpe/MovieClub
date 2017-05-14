<?php
 // Check is cookie is set
 if (isset($_COOKIE["theme"])) {
   // Get value for theme
   $theme = $_COOKIE["theme"];
   // Set CSS for selected theme
   switch ($theme) {
     case "Cerulean":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css";
        break;
     case "Cosmo":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css";
        break;
     case "Cyborg":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cyborg/bootstrap.min.css";
        break;
     case "Darkly":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css";
        break;
     case "Flatly":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css";
        break;
     case "Journal":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/journal/bootstrap.min.css";
        break;
     case "Lumen":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/lumen/bootstrap.min.css";
        break;
     case "Paper":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css";
        break;
     case "Readable":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/readable/bootstrap.min.css";
        break;
     case "Sandstone":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/sandstone/bootstrap.min.css";
        break;
     case "Simplex":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/simplex/bootstrap.min.css";
        break;
     case "Slate":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/slate/bootstrap.min.css";
        break;
     case "Spacelab":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/spacelab/bootstrap.min.css";
        break;
     case "Superhero":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css";
        break;
     case "Unitied":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css";
        break;
     case "Yeti":
        $css = "https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css";
        break;
     default:
        $css = "../lib/bootstrap/css/bootstrap.min.css";
       break;
     }
  } else {
    // Else set default
    $css = "../lib/bootstrap/css/bootstrap.min.css";
  }
  // Check if cookie is set
  if (isset($_COOKIE["font_size"])){
    // Get value for font-szie
    $font_size = $_COOKIE["font_size"];
    // Set selected font size
    switch ($font_size){
      case "extra_small":
        $font = "100%";
        break;
      case "small":
        $font = "110%";
        break;
      case "medium":
        $font = "150%";
        break;
      case "large":
        $font = "160%";
        break;
      case "extraLarge":
        $font = "200%";
        break;
      default:
        $font = "";
        break;
      }
  } else {
    // Else set default
    $font = "";
  }
  // Check if cookie is set
  if (isset($_COOKIE["background_image"])){
    // Get value for background
    $background_image = $_COOKIE["background_image"];
    // Set selected background
    switch ($background_image) {
      case "cubes":
        $background = "url('../public/images/cubes.jpg')";
        break;
      case "emboss":
        $background = "url('../public/images/emboss.jpg')";
        break;
      case "grunge":
        $background = "url('../public/images/grunge.jpg')";
        break;
      case "paper":
        $background = "url('../public/images/paper.jpg')";
        break;
      case "waves":
        $background = "url('../public/images/waves.jpg')";
        break;
      default:
        $background = "";
        break;
      }
    } else {
    // Else set default
    $background = "";
  }
?>
