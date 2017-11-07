
# FONKSİYONLARIN KULLANIMLARI

<h4>Redis funksiyonlarını içeren class yükleniyor</h4>

<span>include 'redis_.php';</span>

<h4>Class çağrılıyor.</h4>

$redis = new redis_();

<h4>Redis portuna bağlanılıyor</h4>

$redis->redisConnect();

<h4>Redis set methodu kullanıldı</h4>

$redis->setText("adım","omer faruk");

<h4>Redis get methodu kullanıldı</h4>

echo $redis->getText("adım");

<h2><strong>Redis counter kullanımı.</strong></h2>

<h4>Sayac redis hafızasına tanımlanıyor</h4>
$redis->redisCounter(1,"sayac",0);

<h4>Tanımlanmış sayac ekrana yazılıyor.</h4>
echo $redis->redisCounter(4,"sayac");

<h4>Sayac 2 arttırılıyor ve ekrana yazılıyor.</h4>
echo $redis->redisCounter(2,"sayac",2);

<h4>Sayac 1 azaltılıyor ve ekrana yazılıyor.</h4>
echo $redis->redisCounter(3,"sayac",1);

<h2><strong>hash kullanımı</strong></h2>

<h4>Tek değerili bir hash değeri tanımlıyorum </h4>
$redis->setHashSingle("omer","faruk","kesmez");

echo $redis->getHashSingle("omer","faruk");

<h4>Yukarıda tanımladığım hash değerini siliyorum</h4>
$redis->deleteHash("omer","faruk");

<h4>Eğer silinme başarılı ise getHashSingle boş değer döner.</h4>
echo "Silindimi : ". $redis->getHashSingle("omer","faruk");

$data = array("name"=>"ömer faruk","surname"=>"KESMEZ","yaş"=>27,"meslek"=>"mühendis");
<h4>Redis içerisine array değerleri hash olarak koyuyorum çok boyutlu hash değeri kullanıyorum </h4>
$redis->setHashAll("all",$data);

<h4>Tanımladığım hash değerini array olaak ekrna basıyorum</h4>
print_r($redis->getHashFull("all"));

<h4>Tanımlanmış hash siliniyor</h4>
$redis->deleteHash("all");

<h4>Tanımladığım hash değerini array olarak ekrna basıyorum Eğer boş ise silme işlemi başarılı</h4>
print_r($redis->getHashFull("all"));


