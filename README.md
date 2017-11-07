
# FONKSİYONLARIN KULLANIMLARI

<h4>Redis funksiyonlarını içeren class yükleniyor</h4>

<span>include 'redis_.php';</span>

<h4>Class çağrılıyor.</h4>

<em>$redis = new redis_();</em>

<h4>Redis portuna bağlanılıyor</h4>

$redis->redisConnect();

<h4>Redis set methodu kullanıldı</h4>

$redis->setText("adım","omer faruk");

<h4>Redis get methodu kullanıldı</h4>

echo $redis->getText("adım");

<h4>Redis counter kullanımı.</h4>

$redis->redisCounter(1,"sayac",0);<h4>Sayac redis hafızasına tanımlanıyor</h4>

echo $redis->redisCounter(4,"sayac");<h4>Tanımlanmış sayac ekrana yazılıyor.</h4>

echo $redis->redisCounter(2,"sayac",2);<h4>Sayac 2 arttırılıyor ve ekrana yazılıyor.</h4>

echo $redis->redisCounter(3,"sayac",1);<h4>Sayac 1 azaltılıyor ve ekrana yazılıyor.</h4>

<h4>hash kullanımı</h4>

$redis->setHashSingle("omer","faruk","kesmez");

echo $redis->getHashSingle("omer","faruk")."<br>";

$redis->deleteHash("omer","faruk");<h4>Yukarıda tanımladığım hash değerini siliyorum</h4>

echo "Silindimi : ". $redis->getHashSingle("omer","faruk")."<br>";

$data = array("name"=>"ömer faruk","surname"=>"KESMEZ","yaş"=>27,"meslek"=>"mühendis");

$redis->setHashAll("all",$data);<h4>Redis içerisine array değerleri hash olarak koyuyorum</h4>

print_r($redis->getHashFull("all"));<h4>Tanımladığım hash değerini array olaak ekrna basıyorum</h4></h4>

$redis->deleteHash("all");<h4>Tanımlanmış hash siliniyor

echo  "<br>-------------------------------<br>Silindimi : <br>";

print_r($redis->getHashFull("all"));<h4>/Tanımladığım hash değerini array olaak ekrna basıyorum</h4>


