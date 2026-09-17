<?php 
 
session_start(); 
 
include_once "conn.php"; 
include_once "initialize.php"; 
 
?> 
 
<!doctype html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" 
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <title>Knight's Tour</title> 
    <link rel="stylesheet" href="index.css"> 
</head> 

<body>

    <div class="header">
        <h1>Knight's Tour</h1>
        <p>School Project - 2020</p>
        <p>Beatrice Cecchini</p>
        <p class="description">
            Move the knight across the board without visiting the same square twice.
        </p>
    </div>

    <div class="container-flex-horizontal">
 
    <?php 
 
        function stampaTabella(&$matriceCampo){ 
            echo '<table>'; 

            for($i=0;$i<count($matriceCampo);$i++){ 
                echo '<tr>'; 

                for($j=0;$j<count($matriceCampo[0]);$j++){ 

                    if($matriceCampo[$i][$j]==0){ 

                        echo '<td style="background-color: sandybrown">['.$i.','. $j.']</td>'; 

                    }else if($matriceCampo[$i][$j]==1){ 

                        echo '<td style="background-color: lightblue; background-image: url(./imports/icon-horse.png); background-size: 80%; background-repeat: no-repeat; background-position: center"></td>'; 

                    }else if($matriceCampo[$i][$j]==2){ 

                        echo '<td style="background-color: yellow">['.$i.','. $j.']</td>'; 

                    }else { 

                        echo '<td style="background-color: pink">['.$i.','. $j.']</td>'; 
                    } 
                } 

                echo '</tr>'; 
            } 

            echo '</table>'; 
        } 
 
        function stampaFormSpostamento(&$matriceCampo, $conn){ 

            $_SESSION['campo'] = $matriceCampo; 

            $arrayPosizioni = calcolaPosizioniPossibili($matriceCampo, $conn); 

            if(count($arrayPosizioni)>0){ 

                echo '<form action="cambiaPosizione.php" method="post">'; 

                echo '<h2>Scegli la posizione tra quelle disponibili</h2>'; 

                echo '<ul>'; 

                for($i=0;$i<count($arrayPosizioni);$i++){ 

                    echo '<li>'; 

                    echo '<input type="radio" name="coordinate" value="'.$arrayPosizioni[$i].'" required>';

                    echo '<label>'.$arrayPosizioni[$i].'</label>'; 

                    echo '</li>'; 
                } 

                echo '</ul>'; 

                echo '<input type="submit" value="Scegli posizione">'; 

                echo '</form>'; 

            }else{ 

                echo "<script type='text/javascript'>
                        alert('Non ci sono più mosse disponibili!');
                      </script>"; 
            } 
 
            echo '<form action="restart.php">'; 
            echo '<input type="submit" value="Termina partita">'; 
            echo '</form>'; 
        } 
 
        function calcolaPosizioniPossibili(&$matriceCampo, $conn){ 

            $query = 'SELECT x, y FROM PosizioniOccupate ORDER BY time DESC LIMIT 1'; 

            $posizione = mysqli_fetch_all(mysqli_query($conn, $query)); 

            $posizioniDestra = calcolaPosizioniDestra(
                $posizione,
                $conn,
                $matriceCampo
            ); 

            $posizioniSinistra = calcolaPosizioniSinistra(
                $posizione,
                $conn,
                $matriceCampo
            ); 

            return array_merge(
                $posizioniDestra,
                $posizioniSinistra
            ); 
        } 
 
        function calcolaPosizioniDestra($posizione, $conn, &$matriceCampo){ 

            $contatore = []; 

            for($i=0;$i<2;$i++){ 

                switch ($i){ 

                    case 0:{ 

                        if(
                            $posizione[0][0]+2 >= 0 &&
                            $posizione[0][0]+2 < 8 &&
                            $posizione[0][1]+1 >= 0 &&
                            $posizione[0][1]+1 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]+2,
                                    $posizione[0][1]+1,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]+2).",".
                                    ($posizione[0][1]+1); 

                                $matriceCampo
                                    [$posizione[0][0]+2]
                                    [$posizione[0][1]+1] = 2; 
                            } 
                        } 
 
                        if(
                            $posizione[0][0]-2 >= 0 &&
                            $posizione[0][0]-2 < 8 &&
                            $posizione[0][1]+1 >= 0 &&
                            $posizione[0][1]+1 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]-2,
                                    $posizione[0][1]+1,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]-2).",".
                                    ($posizione[0][1]+1); 

                                $matriceCampo
                                    [$posizione[0][0]-2]
                                    [$posizione[0][1]+1] = 2; 
                            } 
                        } 

                        break; 
                    } 
 
                    case 1:{ 

                        if(
                            $posizione[0][0]+1 >= 0 &&
                            $posizione[0][0]+1 < 8 &&
                            $posizione[0][1]+2 >= 0 &&
                            $posizione[0][1]+2 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]+1,
                                    $posizione[0][1]+2,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]+1).",".
                                    ($posizione[0][1]+2); 

                                $matriceCampo
                                    [$posizione[0][0]+1]
                                    [$posizione[0][1]+2] = 2; 
                            } 
                        } 
 
                        if(
                            $posizione[0][0]-1 >= 0 &&
                            $posizione[0][0]-1 < 8 &&
                            $posizione[0][1]+2 >= 0 &&
                            $posizione[0][1]+2 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]-1,
                                    $posizione[0][1]+2,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]-1).",".
                                    ($posizione[0][1]+2); 

                                $matriceCampo
                                    [$posizione[0][0]-1]
                                    [$posizione[0][1]+2] = 2; 
                            } 
                        } 

                        break; 
                    } 
                } 
            } 

            return $contatore; 
        } 
 
        function calcolaPosizioniSinistra($posizione, $conn, &$matriceCampo){ 

            $contatore = []; 

            for($i=0;$i<2;$i++){ 

                switch ($i){ 

                    case 0:{ 

                        if(
                            $posizione[0][0]+2 >= 0 &&
                            $posizione[0][0]+2 < 8 &&
                            $posizione[0][1]-1 >= 0 &&
                            $posizione[0][1]-1 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]+2,
                                    $posizione[0][1]-1,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]+2).",".
                                    ($posizione[0][1]-1); 

                                $matriceCampo
                                    [$posizione[0][0]+2]
                                    [$posizione[0][1]-1] = 2; 
                            } 
                        } 
 
                        if(
                            $posizione[0][0]-2 >= 0 &&
                            $posizione[0][0]-2 < 8 &&
                            $posizione[0][1]-1 >= 0 &&
                            $posizione[0][1]-1 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]-2,
                                    $posizione[0][1]-1,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]-2).",".
                                    ($posizione[0][1]-1); 

                                $matriceCampo
                                    [$posizione[0][0]-2]
                                    [$posizione[0][1]-1] = 2; 
                            } 
                        } 

                        break; 
                    } 
 
                    case 1:{ 

                        if(
                            $posizione[0][0]+1 >= 0 &&
                            $posizione[0][0]+1 < 8 &&
                            $posizione[0][1]-2 >= 0 &&
                            $posizione[0][1]-2 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]+1,
                                    $posizione[0][1]-2,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]+1).",".
                                    ($posizione[0][1]-2); 

                                $matriceCampo
                                    [$posizione[0][0]+1]
                                    [$posizione[0][1]-2] = 2; 
                            } 
                        } 
 
                        if(
                            $posizione[0][0]-1 >= 0 &&
                            $posizione[0][0]-1 < 8 &&
                            $posizione[0][1]-2 >= 0 &&
                            $posizione[0][1]-2 < 8
                        ){ 

                            if(
                                !controlloGiàPassato(
                                    $posizione[0][0]-1,
                                    $posizione[0][1]-2,
                                    $conn
                                )
                            ){ 

                                $contatore[] = 
                                    ($posizione[0][0]-1).",".
                                    ($posizione[0][1]-2); 

                                $matriceCampo
                                    [$posizione[0][0]-1]
                                    [$posizione[0][1]-2] = 2; 
                            } 
                        } 

                        break; 
                    } 
                } 
            } 

            return $contatore; 
        } 
 
        function controlloGiàPassato($x, $y, $conn){ 

            $query = 'SELECT * FROM PosizioniOccupate'; 

            $risultato = mysqli_fetch_all(
                mysqli_query($conn, $query)
            ); 
 
            foreach ($risultato as $posizione){ 

                if(
                    $posizione[1] == $x &&
                    $posizione[2] == $y
                ){ 
                    return true; 
                } 
            } 
 
            return false; 
        } 
 
        $matriceCampo = $_SESSION['campo']; 
 
        stampaTabella($matriceCampo); 
 
        stampaFormSpostamento(
            $matriceCampo,
            $conn
        ); 
 
    ?> 

    </div>
 
</body> 
</html>