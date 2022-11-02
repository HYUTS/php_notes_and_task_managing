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
    echo "You didnt enter anything...";
    fclose($fp);
}

fwrite($fp, $output_line);

fclose($fp);
?>

<table>
    <tr>
        <th>To Do</th>
        <th>Finished</th>
        <th>Attention</th>
    </tr>

    <?php
    $fp = fopen($filename, 'r');

    $display = "";

    while (true) {
        $line = fgets($fp);

        if (feof($fp)) {
            break;
        }

        list($toDo, $finishL, $attL) = explode('|', $line);

        $display .= "<tr>
        <td>" . $toDo . "</td>
        <td>" . $finishL . "</td>
        <td>" . $attL . "</td>
        </tr>\n";
    }

    fclose($fp);

    print $display;
    ?>