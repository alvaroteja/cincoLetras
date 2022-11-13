<?php

$texto = "zabra, zabro, zacee, zaceo, zafad, zafan, zafar, zafas, zafen, zafes, zafia, zafio, zafir, zafos, zafra, zafre, zagal, zagas, zagua, zaida, zaina, zaino, zaire, zalbo, zalea, zalee, zaleo, zalle, zamba, zambo, zampa, zampe, zampo, zanca, zanco, zanga, zanja, zanje, zanjo, zapad, zapan, zapar, zapas, zapea, zapee, zapen, zapeo, zapes, zapos, zaque, zaras, zarbo, zarca, zarco, zares, zarpa, zarpe, zarpo, zarza, zarzo, zatas, zatos, zayas, zebra, zedas, zenda, zendo, zenit, zetas, zocas, zoclo, zocos, zofra, zoilo, zoizo, zolle, zomas, zombi, zompa, zompo, zonal, zonas, zonda, zonto, zonzo, zopas, zopos, zoque, zorra, zorro, zotal, zotes, zuavo, zubia, zudas, zueca, zueco, zuela, zuiza, zulla, zulle, zumba, zumbe, zumbo, zumos, zuñir, zuños, zupia, zurba, zurce, zurda, zurde, zurdo, zuree, zureo, zuros, zurra, zurre, zurro, zurza, zurzo, zuzar";
$array = explode(", ", $texto);
echo "<pre>";

foreach ($array as $key => $value) {
    echo "INSERT INTO palabras (id, palabra) VALUES (NULL, '$value" . "');" . "<br/>";
}
// print_r($array);
