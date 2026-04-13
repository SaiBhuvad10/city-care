<?php
header('Content-Type: application/manifest+json');
?>
{
  "name": "City Care Hospital",
  "short_name": "City Care",
  "description": "City Care Hospital - Your health is our priority.",
  "start_url": "index.php",
  "display": "standalone",
  "background_color": "#faf8ff",
  "theme_color": "#0052c6",
  "orientation": "portrait-primary",
  "icons": [
    {
      "src": "icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png"
    },
    {
      "src": "icon-512x512.png",
      "sizes": "192x192",
      "type": "image/png",
      "purpose": "any maskable"
    }
  ],
  "scope": "./",
  "lang": "en-US",
  "dir": "ltr"
}