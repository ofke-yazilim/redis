<?php
//Redis funksiyonlarını içeren class yüklrniyor
include 'redis_.php';
$redis = new redis_();
//Redis portuna bağlanılıyor
$redis->redisConnect();
//Redis set methodu kullanıldı
$redis->setText("adım","omer faruk");
//Redis get methodu kullanıldı
echo $redis->getText("adım");
//Redis counter kullanımı.
$redis->redisCounter(1,"sayac",0);//Sayac redis hafızasına tanımlanıyor
echo $redis->redisCounter(4,"sayac");//Tnımlanmış sayac ekrana yazılıyor.
echo $redis->redisCounter(2,"sayac",2);//Sayac 2 arttırılıyor ve ekrana yazılıyor.
echo $redis->redisCounter(3,"sayac",1);//Sayac 1 azaltılıyor ve ekrana yazılıyor.

//hash kullanımı
$redis->setHashSingle("omer","faruk","kesmez");
echo $redis->getHashSingle("omer","faruk")."<br>";
$redis->deleteHash("omer","faruk");
echo "Silindimi : ". $redis->getHashSingle("omer","faruk")."<br>";
$data = array("name"=>"ömer faruk","surname"=>"KESMEZ","yaş"=>27,"meslek"=>"mühendis");
$redis->setHashAll("all",$data);//Redis içerisine array değerleri hash olarak koyuyorum
print_r($redis->getHashFull("all"));//Tanımladığım hash değerini array olaak ekrna basıyorum

//Hash içerisine Array tanımlarken içi içe array var ise kullanılacak fonksiyon
$data = array(0=>array("id"=>1,"name"=>"omer"),1=>array("id"=>2,"name"=>"faruk")) $redis->setHashAllMultiArray("all",$data);
//Yukarıda Tanımlanan iç içe array için Hash değeri ekrana basılıyor.
print_r($redis->getHashFullMultiArray("all"));

$redis->deleteHash("all");//Tanımlanmış hash siliniyor
echo  "<br>-------------------------------<br>Silindimi : <br>";
