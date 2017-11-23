<?php
//Redis servis aktif ediliyor
include 'redis_.php';
$redis = new redis_();
$redis->redisConnect();//Redis servisi portuna bağlanıyor

//iç içe 3 array yapısı için örnek array
$yeni = array(
    0=>array(
        "ad"=>
            array(
              "1.ad"=>array(0=>"Ömer",1=>"Ömürlü"),
              "2.ad"=>array(0=>"Faruk",1=>"Adeletli"),
              "3.ad"=>"yok"
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
              0=>"Yıldız",
              1=>"Kesmez"
            ),
        "kisaca"=>
            array(
              0=>"1.70",
              1=>array("aciken"=>70,"tokiken"=>66),
              2=>"30beden",
              3=>"Beyaz"
            )
        ),
    2=>array(
        "ad"=>"HALİL",
        "soyad"=>
            array(
              0=>"",
              1=>"Kesmez"
            ),
        "kisaca"=>
            array(
              0=>"1.82",
              1=>"71kg",
              "memleket"=>array("yer"=>"oltu","tarih"=>1990)
            )
        )
    );

//Yukarıda tanılmlı olan array verisini redis üzerinde tanımlıyoruz ve alıyoruz.
echo $redis->deleteHash("_hafiza");//Daha önce bu key yani _hafiza isminde redis hafızası oluşturduk ise siliyoruz
$redis->setHashAllMultiArray3Sıze("_hafiza",$yeni);//Yukarıda tanımladığımız iç içe 4 array verisini redis hafızasına attık.
$data  = $redis->getHashFullMultiArray3Sıze("_hafiza");//_hafiza anahtarı ile redis hafızasına tanımladığımız array verisini alıyoruz.
print_r($data);//Aldığımız veriyi ekrana basıyoruz.
