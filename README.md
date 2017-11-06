
# FONKSİYONLARIN KULLANIMLARI

-------------------------------------------------------------------

//Redis funksiyonlarını içeren class yükleniyor

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

$redis->deleteHash("omer","faruk");//Yukarıda tanımladığım hash değerini siliyorum

echo "Silindimi : ". $redis->getHashSingle("omer","faruk")."<br>";

$data = array("name"=>"ömer faruk","surname"=>"KESMEZ","yaş"=>27,"meslek"=>"mühendis");

$redis->setHashAll("all",$data);//Redis içerisine array değerleri hash olarak koyuyorum

print_r($redis->getHashFull("all"));//Tanımladığım hash değerini array olaak ekrna basıyorum

$redis->deleteHash("all");//Tanımlanmış hash siliniyor

echo  "<br>-------------------------------<br>Silindimi : <br>";

print_r($redis->getHashFull("all"));//Tanımladığım hash değerini array olaak ekrna basıyorum


