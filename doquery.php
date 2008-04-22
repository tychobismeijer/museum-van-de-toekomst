<?php
    //$querystring = 'SELECT DISTINCT ?p WHERE {?a ?p ?b.}';
    $querystring = $_GET["query"];
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html
    xmlns="http://www.w3.org/1999/xhtml"
    xml:lang="en" lang="en">
  <head>
    <title>RAP SPARQL result</title>
  </head>
  <body>
  <h2><?php print(htmlentities($querystring))?></h2>
  <?php
    // Include all RAP classes
    printf("<!--");
    define("RDFAPI_INCLUDE_DIR", "/home/tbr440/www/museum-van-de-toekomst/lib/rdfapi-php/api/");
    include(RDFAPI_INCLUDE_DIR . "RdfAPI.php");
    print("--!>\n");
    // Create a SPARQL client
    $client = ModelFactory::getSparqlClient("http://webkr:webkr@sesame3.few.vu.nl/kb");
    // Create a query
    $query = new ClientQuery();
    $query->query($querystring);
    $client->setOutputFormat("array");
    $result = $client->query($query);
    // Print out the query
    printf("<table>");
    foreach($result as $line){
        print("<tr>");
        foreach($line as $value){
            print("<td>");
            if($value != ""){
                print($value->toString());
            } else{
	        print("unbound");
            }
	    print("<td>");
        }
    printf("</tr>\n");
    }
?>
</body>
</html>
