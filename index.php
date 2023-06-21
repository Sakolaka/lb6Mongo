<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wdisciplineth=device-wdisciplineth, initial-scale=1.0">
    <title>Inventory</title>
</head>
<body>
    <h2>Список комп'ютерів із заданим типом центрального процесора</h2>
    <form action="getCentralProcessor.php" method="post">
        <select name="Proc">
            <?php
            include("connect.php");
            require_once("connect.php");
            $collections = (new MongoDB\Client)->Mongo->inventory;
            $processors = $collections->distinct('processor');
          foreach($processors as $processor){
             echo '<option value = "' .$processor. '">' .$processor . '</option>';
         }
        ?>
        </select>
            <input type="submit" value="Результат">       
    </form>

    <h2>Список комп'ютерів зі встановленим ПЗ (назву ПЗ вибирають із переліку)</h2>
    <form action="getListbySoftware.php" method="post">
    <select name="soft" id="sort">
        <?php
        include("connect.php");
        require_once("connect.php");
        $collections = (new MongoDB\Client)->Mongo->inventory;
        $licensed_softwares = $collections->distinct('licensed_software');
        foreach($licensed_softwares as $licensed_software){
            echo '<option value="' . $licensed_software . '">' . $licensed_software . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Результат">
</form>


    <h2>Список комп'ютерів з вичерпаним гарантійним терміном</h2>
<form action="getListbySoftout.php" method="post">
        <?php
        include("connect.php");
        $collections = (new MongoDB\Client)->Mongo->inventory;
        ?>
    <input type="submit" value="Результат">
</form>


<script>
    const data = localStorage.getItem("request");
    const result = JSON.parse(data);
    if (result.length > 0) {
        let output = "";
        result.forEach(function(element){
            output += "<br>Date: " + element.date;
            output += "<br>Time: " + element.time;
            output += "<br>licensed_until: " + element.licensed_until;
            output += "<br>Discipline: " + element.discipline;
            output += "<br>Type: " + element.type;
            output += "<br>processor: " + element.processor.join(", ");
            output += "<br>licensed_software: " + element.licensed_software.join(", ");
            output += "<br>";
        });
        document.write("Попередній запит:" + output);
    }
</script>

</body>
</html>