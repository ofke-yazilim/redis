<?php
//Redis servis aktif ediliyor
include 'includes/redis.php';
$redis = new redis_();
$redis->redisConnect();//Redis servisi portuna baðlanýyor

//iç içe 3 array yapýsý için örnek array
$yeni = array(
    0=>array(
        "ad"=>
            array(
              "1.ad"=>"Ömer",
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
              0=>"Yýldýz",
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
        "ad"=>"HALÝL",
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

//Yukarýda tanýlmlý olan array verisini redis üzerinde tanýmlýyoruz ve alýyoruz.
echo $redis->deleteHash("_hafiza");//Daha önce bu key yani _hafiza isminde redis hafýzasý oluþturduk ise siliyoruz
$redis->setHashAllMultiArray3Sýze("_hafiza",$yeni);//Yukarýda tanýmladýðýmýz iç içe 3 array verisini redis hafýzasýna attýk.
$data  = $redis->getHashFullMultiArray3Sýze("_hafiza");//_hafiza anahtarý ile redis hafýzasýna tanýmladýðýmýz array verisini alýyoruz.
print_r($data);//Aldýðýmýz veriyi ekrana basýyoruz.
