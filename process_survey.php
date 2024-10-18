<?php
// Set the path to the XML file
$xmlFile = 'survey_responses.xml';
$number_of_questions=101;
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
   for ($i = 1; $i <= $number_of_questions; $i++) {
        if ($i==30 ||$i==32 ||$i==39 ||$i==46 ||$i==53 ||$i==60 ||$i==67 ||$i==74 ||$i==81 ||$i==88 ||$i==95){
            ${"q" . $i."a"}=$_POST["q".$i."_a"];
            ${"q" . $i."b"}=$_POST["q".$i."_b"];
            ${"q" . $i}=${"q" . $i."a"}.", ".${"q" . $i."b"};
        }
        
        else{
    ${"q" . $i} = $_POST["q" . $i];}
        }

    // Load the XML file if it exists, otherwise create a new XML structure
    if (file_exists($xmlFile)) {
        $xml = simplexml_load_file($xmlFile);
    } else {
        
        $xml = new SimpleXMLElement('<surveyResponses></surveyResponses>');
        $surveyResponse = $xml->addChild('surveyResponse');
        
    }

    // Add new survey response to XML
    $surveyResponse = $xml->addChild('surveyResponse');
    for ($i = 35; $i <= $number_of_questions; $i++) {
        
        $surveyResponse->addChild(strval("Question" . $i), ${"q" . $i});
        } 


    // Save the updated XML back to the file
    $xml->asXML($xmlFile);

    // Provide a success message or redirect back to the form
    echo "Thank you for your submission!";
} else {
    echo "Invalid request.";
}
header('location: /survey/index.html')
?>
