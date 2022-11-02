<link rel="stylesheet" type="text/css" href="styles.css">

<style>
    table {
        margin: auto;
        border-spacing: 0px;
    }

    td {
        padding: 5px;
        border: solid 1px #000;
    }

    td:nth-child(1) {
        background-color: #DDF7D2;
    }

    td:nth-child(2) {
        background-color: #D2F0F7;
    }

    td:last-child {
        background-color: #F7D9D2;
    }
</style>
<?php
$filename = 'data/notes.txt';
//ADDING TO FILE//
$fp = fopen($filename, 'a');   //opens the file for appending

$toDoList = $_POST['to_do_list'];
$finishedList = $_POST['finished_list'];
$attentionList = $_POST['attention_list'];

$output_line = $toDoList . '|' . $finishedList . '|' . $attentionList . "\n";

if ($toDoList == '' && $finishedList == '' && $attentionList == '') {
    //echo "You didn't add anything, but here is your list! May the HYUTS be with you!";
    fclose($fp);
} else {
    fwrite($fp, $output_line);
    fclose($fp);
}

//OPEN THE FILE FOR READING-----------------------------------------------------

$fp = fopen($filename, 'r');

$toDoListPrint = "";
$finishLPrint = "";
$attLPrint = "";

while (true) {
    $line = fgets($fp);

    if (feof($fp)) {
        break;
    }

    list($toDo, $finishL, $attL) = explode('|', $line);

    $toDoListPrint .= "<li>" . $toDo . "</li>";
    $finishLPrint .= "<li>" . $finishL . "</li>";
    $attLPrint .= "<li>" . $attL . "</li>";
}

fclose($fp);

print '<div id="to_do">
    <h2>To Do:</h2>
    <div name="to_do_list" id="formating" class="green_c" placeholder="What needs doing?"><ol>' . $toDoListPrint . '</ol></div>
</div>

<div id="done">
    <h2>Finished!</h2>
    <div name="finished_list" id="formating" class="blue_c" placeholder="Done with it!"><ol>' . $finishLPrint . '</ol></div>
</div>
    
<div id="attention">
    <h2>Needs attention</h2>
    <div name="attention_list" id="formating" class="red_c" placeholder="Any reminders?"><ol>' . $attLPrint . '</ol></div>
</div>';

?>