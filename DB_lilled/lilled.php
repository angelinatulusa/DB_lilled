<?php
require_once ('conect.php');
global $yhendus;
//andmete lisaminetabelisse
if(isset($_REQUEST['lisamisvorm']) &&!empty($_REQUEST["lill"])){
    $paring=$yhendus->prepare(
        "INSERT INTO tooted2(toodenimi,hind,kogus) Values (?,?,?)"
    );
    $paring->bind_param("sii",$_REQUEST["lill"],$_REQUEST["hind"],$_REQUEST["kogus"]);
    //"s" - string, $_REQUEST - tekstikasti nimega nimi
    //sdi, s - string d - double, i - inger
    $paring->execute();
}
//kustutamine
if(isset($_REQUEST['kustuta'])){
    $paring=$yhendus->prepare("DELETE FROM tooted2 WHERE ToodedID=?");
    $paring->bind_param('i',$_REQUEST['kustuta']);
    $paring->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DB Lilled</title>
    <link rel="stylesheet" type="text/css" href="lilled.css">
</head>
<body>
<h1>DB Lilled</h1>
<div id="meny">
    <ul>
        <?php
        $paring=$yhendus->prepare("SELECT ToodedID,toodenimi FROM tooted2");
        $paring->bind_result($id,$lill);
        $paring->execute();
        //näitab loomade loetelu tabelist loomad
        while($paring->fetch()){

            echo"<li id='nimi'>"."<a href='?id=$id'>".htmlspecialchars($lill)."</a>"."</li>";
        }
        echo "</ul>";
        echo "<a href='?lisalill=jah' >Lisa lilled</a>";
        ?>
<br>
<a href="https://github.com/angelinatulusa/DB_lilled/tree/main/DB_lilled" target="_blank">kode GitHub'is</a>
</div>

<div id="sisu">
    <?php
    if(isset($_REQUEST["id"])){
        $paring=$yhendus->prepare("SELECT toodenimi,hind,kogus FROM tooted2 WHERE ToodedID=?");
        $paring->bind_param("i",$_REQUEST["id"]);
        //? küsimärki asemel adressiribalt tuleb id
        $paring->bind_result($lill,$hind,$kogus);
        $paring->execute();
        if($paring->fetch()){
            echo"<div>"."Lillede nimi on - "."<strong>".htmlspecialchars($lill)."</strong>";
            echo "<br>";
            echo "Tema hind on - "."<strong>".htmlspecialchars($hind)."</strong>"." eurot";
            echo "<br>";
            echo "Laos on "."<strong>".htmlspecialchars($kogus)."</strong>"." tk";
            echo"</div>";
            echo"<a href='?kustuta=$id'>Kustuta</a>";

        }
    }

    else if(isset($_REQUEST["lisalill"])){
        ?>
        <h2>Uute lillede lisamine</h2>
        <form name="uusloom" method="post" action="?">
            <input type="hidden" name="lisamisvorm" value="jah">
            <input type="text" name="lill" placeholder="lillede nimi">
            <input type="number" name="hind" max="15" placeholder="hind(max=15)">
            <input type="number" name="kogus" max="300" placeholder="kogus(max=30)">
            <input type="submit" value="OK">
        </form>
        <?php
    }else{
        echo"<h3>siia tuleb lillede info...</h3>";
    }
    ?>
</div>
</body>
</html>