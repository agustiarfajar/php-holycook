<?php
require_once('../translator/vendor/autoload.php');

use Stichoza\GoogleTranslate\GoogleTranslate;

$tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
$tr->setSource('id'); // Translate from Indonesia
$tr->setSource(); // Detect language automatically
$tr->setTarget('en'); // Translate to English

$text = $_POST['bahan'];

echo GoogleTranslate::trans($text, 'en', 'id');

?>