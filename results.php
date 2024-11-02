<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Резултати</title>
</head>
<body style="background-color: rgb(184, 183, 183);">

    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $rezultat = 0;

        $tocniOdgovori  = [
            'selektiraj1' => 'din',
            'selektiraj2' => 'web',
            'selektiraj3' => 'dollar',
            'selektiraj4' => ['izbor1', 'izbor4'],
            'selektiraj5' => '28',
            'selektiraj6' => '5',
            'selektiraj7' => ['print_r()', 'var_dump()'],
            'selektiraj8' => ['// rezultat', '# rezultat', '/* rezultat */'],
            'selektiraj9' => 'radio2',
            'selektiraj10' => 'radio4' 
        ];

        foreach($tocniOdgovori as $odgovor => $tocenOdgovor) {

            if(isset($_POST[$odgovor])) {

                $odgovorNaKorisnik = $_POST[$odgovor];

                if($odgovor === 'selektiraj8') { 

                    $odgovorNiza = array_map('trim', explode("\n", $odgovorNaKorisnik));

                    if(count($odgovorNiza) === count($tocenOdgovor) && empty(!array_diff($tocenOdgovor, $odgovorNiza)) && empty(!array_diff($odgovorNiza, $tocenOdgovor))) {
                        $rezultat++;
                    }

                } else if($odgovor === 'selektiraj7') {
                    if(is_array($tocenOdgovor) && is_array($odgovorNaKorisnik) && !array_diff($tocenOdgovor, $odgovorNaKorisnik) && !array_diff($odgovorNaKorisnik, $tocenOdgovor)) {
                        $rezultat++;
                    } else if(in_array($odgovorNaKorisnik, $tocenOdgovor)) {
                        $rezultat++;
                    }
                } else if(is_array($tocenOdgovor)) {
                    if(is_array($odgovorNaKorisnik) && !array_diff($tocenOdgovor, $odgovorNaKorisnik) && !array_diff($odgovorNaKorisnik, $tocenOdgovor)) {
                        $rezultat++;
                    }
                    
                }  else if($odgovorNaKorisnik == $tocenOdgovor) {
                    $rezultat++;
                } 

            }

        } 

        echo "<h1>Резултатот е: $rezultat </h1>";
        echo '<h1><a href="./kviz.html">Обидете се повторно</h1>';
    
    } else {
        echo "<h1>Мора да одговорите на сите прашања!</h1>";
    }

    ?>

</body>
</html>