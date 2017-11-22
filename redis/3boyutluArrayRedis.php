<?php
//Redis servis aktif ediliyor
include 'includes/redis.php';
$redis = new redis_();
$redis->redisConnect();//Redis servisi portuna ba�lan�yor

//i� i�e 3 array yap�s� i�in �rnek array
$yeni = array(
    0=>array(
        "ad"=>
            array(
              "1.ad"=>"�mer",
              "2.ad"=>"Faruk"
            ),
        "soyad"=>
            array(
              0=>"soyad1",
              1=>"soyad2"
            ),
        "kisaca"=>
            array(
              0=>"1.81",
              1=>"98kg",
              2=>"44beden"
            )
        ),
    1=>array(
        "ad"=>"Nuriye",
        "soyad"=>
            array(
              0=>"Y�ld�z",
              1=>"Kesmez"
            ),
        "kisaca"=>
            array(
              0=>"1.70",
              1=>"60kg",
              2=>"30beden",
              3=>"Beyaz"
            )
        ),
    2=>array(
        "ad"=>"HAL�L",
        "soyad"=>
            array(
              0=>"",
              1=>"Kesmez"
            ),
        "kisaca"=>
            array(
              0=>"1.82",
              1=>"71kg",
              2=>""
            )
        )
    );

//Yukar�da tan�lml� olan array verisini redis �zerinde tan�ml�yoruz ve al�yoruz.
echo $redis->deleteHash("_hafiza");//Daha �nce bu key yani _hafiza isminde redis haf�zas� olu�turduk ise siliyoruz
$redis->setHashAllMultiArray3S�ze("_hafiza",$yeni);//Yukar�da tan�mlad���m�z i� i�e 3 array verisini redis haf�zas�na att�k.
$data  = $redis->getHashFullMultiArray3S�ze("_hafiza");//_hafiza anahtar� ile redis haf�zas�na tan�mlad���m�z array verisini al�yoruz.
print_r($data);//Ald���m�z veriyi ekrana bas�yoruz.
