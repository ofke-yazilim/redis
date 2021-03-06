
# A) REDİS SERVİSİN WİNDOWS ÜZERİNE KURULUM AŞAMALARI

<ul>
<li>1- https://github.com/MicrosoftArchive/redis/releases adresi üzerinden windows için redis dosyaları zip olarak indirilir.</li>
<li>2- İndirilen dosyalar c:/redis adında bir klasör oluşturularak içerisine çıkarılır.</li>
<li>3- Çıkarılan dosyalardan öncelikle redis-server.exe ve ardından redis-cli.exe çalıştırılır ve çalışır vaziyette tutulur.
   Yani gelen siyah ekranlar kapatılmaz</li>
<li>4- Daha sonra internetten hangi php sürümünü kullanıyorsanız o sürüme ait php_redis.dll indirilir ve wamp\bin\php\php5.x.xx\ext\
   klasörü içerisine atılır.</li>
<li>5- php.ini dosyası açılarak içersinde uygun yere extension=php_redis.dll yazılır.</li>
<li>6- Redis kullanıma hazır.</li>
</ul>

<div class="alert alert-info fade in alert-dismissable" style="    color: #31708f;background-color: #d9edf7;border-color: #bce8f1;">
    <strong>Önemli Bilgi!</strong> Yukarıda bulunan uygulamada redis klasöründe bulunan redis_.php dosyası, içerisinde 
    redis servisinin çalışmasını sağlayan funksiyonları barındıran redis sınıfı içermektedir.
</div>

# B) FONKSİYONLARIN KULLANIMLARI

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

<h2><strong>B-1) Redis counter kullanımı.</strong></h2>

<h4>Sayac redis hafızasına tanımlanıyor</h4>
$redis->redisCounter(1,"sayac",0);

<h4>Tanımlanmış sayac ekrana yazılıyor.</h4>
echo $redis->redisCounter(4,"sayac");

<h4>Sayac 2 arttırılıyor ve ekrana yazılıyor.</h4>
echo $redis->redisCounter(2,"sayac",2);

<h4>Sayac 1 azaltılıyor ve ekrana yazılıyor.</h4>
echo $redis->redisCounter(3,"sayac",1);

<h2><strong>B-2) HASH KULLANIMI</strong></h2>

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

<h4>Tanımladığım hash değerini array olarak ekrana basıyorum</h4>
print_r($redis->getHashFull("all"));

<h4>Hash içerisine Array tanımlarken içi içe array var ise kullanılacak fonksiyon</h4>
$data = array(0=>array("id"=>1,"name"=>"omer"),1=>array("id"=>2,"name"=>"faruk"))
$redis->setHashAllMultiArray("all",$data);

<h4>Yukarıda Tanımlanan iç içe array için Hash değeri ekrana basılıyor.</h4>
print_r($redis->getHashFullMultiArray("all"));

<h4>Tanımlanmış hash siliniyor</h4>
$redis->deleteHash("all");

<h3>İç içe 3 arraydan oluşan datanın örnek kullanımı için aşağıdaki linki tıklayınız<h3>
https://github.com/ofke-yazilim/redis/blob/master/redis/3boyutluArrayRedis.php

<h3>İç içe 4 arraydan oluşan datanın örnek kullanımı için aşağıdaki linki tıklayınız<h3>
https://github.com/ofke-yazilim/redis/blob/master/redis/4boyutluArrayRedis.php

<h3>İç içe 2 arraydan oluşan datanın örnek kullanımı için aşağıdaki linki tıklayınız<h3>
https://github.com/ofke-yazilim/redis/blob/master/redis/2boyutluArrayRedis.php


