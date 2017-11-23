<?php
//Redis servis aktif ediliyor
include 'includes/redis.php';
$redis = new redis_();
$redis->redisConnect();//Redis servisi portuna ba�lan�yor

//i� i�e 3 array yap�s� i�in �rnek array
$yeni = array(
    0=>array(
        0=>"1.81",
        1=>"98kg",
        2=>"44beden"
      ),
    1=>array(
          0=>"1.70",
          1=>array("aciken"=>70,"tokiken"=>66),
          2=>"30beden",
          3=>"Beyaz"
        ),
    2=>array(
          0=>"1.82",
          1=>"71kg"
        )
    );

//Yukar�da tan�lml� olan array verisini redis �zerinde tan�ml�yoruz ve al�yoruz.
echo $redis->deleteHash("_hafiza");//Daha �nce bu key yani _hafiza isminde redis haf�zas� olu�turduk ise siliyoruz
$redis->setHashAllMultiArray3S�ze("_hafiza",$yeni);//Yukar�da tan�mlad���m�z i� i�e 2 array verisini redis haf�zas�na att�k.
$data  = $redis->getHashFullMultiArray3S�ze("_hafiza");//_hafiza anahtar� ile redis haf�zas�na tan�mlad���m�z array verisini al�yoruz.
print_r($data);//Ald���m�z veriyi ekrana bas�yoruz.

