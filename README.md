# phpHtmlDocument
HtmlDocument is simple php class for html creation without using any meta tag

<h2>Examples:</h2>
<code>
<?php
require dirname (__FILE__) . "/Doc.php";
$doc = new Doc();
$doc->setHeaders($doc->createElement("meta", array("name"=>"viewport", "content"=>"initial-scale=1.0"), null, true));
$doc->createElement("div", array("id"=>1), " hello world");
//print all the html
echo $doc->initHtml();
?>
