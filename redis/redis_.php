<?php
/**
 * Description of redis
 *
 * @author ofke
 */
class redis_ {
    private $redis = null;
    
    //Yapıcı class ile redis bağlantısı sağlanıyor.
    function __construct(){
    }
    
    //Redis kurulduğunda default olarak 6379 portunda gelir.
    public function redisConnect(){
        try {
            $this->redis = new Redis();
            $this->redis->connect('localhost',6379);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    //redis üzerinde tanımlı set methodu ile tanımladığımız mesajımızı redis hafızasına alırız
    public function setText($key,$value){
        try {
           $this->redis->set($key,$value);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    //redis üzerinde tanımlı get methodu ile daha önce set metodu ile tanımladığımız mesajımızı redis hafızasından alınır
    public function getText($key){
        try {
           return $this->redis->get($key);
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //Redis içerisinde tanımlanan in değerin artmasını ya da azaltılmasını sağlayabilir.
    //Eğer type 1 ise anahtar değeri ve değeri verilen int ifadeyi redis hafızasına tanımlar.
    //Eğer type 2 ise daha önce tanımlanmış değeri $value değerinde belirtilen kadar arttırır.incrby methodunu kullanır
    //Eğer type 3 ise daha önce tanımlanmış değeri $value değerinde belirtilen kadar azaltır.decrby methodunu kullanır.
    //Eğer type 4 ise anahtar değeri gönderilen değeri döndürür.
    function redisCounter($type,$key,$value=null){
        try {
            if($type==1){
                $this->redis->set($key,$value);
            } elseif ($type==2) {
                return $this->redis->incrby($key,$value);
            } elseif ($type==3) {
                return $this->redis->decrby($key,$value);
            } else{
                return $this->redis->get($key);
            }
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    /*
     * Redis ile hash kullanımı fonksiyonları
    */
    
    //hset methodunu kullanrak sadece belirtilen anahtara tek değer tanımlaması yapar.
    public function setHashSingle($hashKey,$key,$value){
        /*
        *   Örnek Kullanım
            $redis->hset($key, 'age', 44);
            $redis->hset($key, 'country', 'finland');
        */
        try {
            $this->redis->hset($hashKey,$key,$value);
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //hmset methodu kullanılarak belirtilen anahtara birçok değer tanımlanır.
    public function setHashAll($hashKey,$values = array()){
        /*
         *  Örnek Kullanım :
            $redis->hmset($key, [
                'age' => 44,
                'country' => 'finland',
                'occupation' => 'software engineer',
                'reknown' => 'linux kernel',
            ]);
        */
        try {
            $this->redis->hmset($hashKey,$values);
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //hmset methodu kullanılarak belirtilen anahtara birçok değer tanımlanır.
    //setHashAll fonksiyonundan farklı olarak array içerisinde array içeren değerler gönderilebilir.
    public function setHashAllMultiArray($hashKey,$values = array()){
        /*
         *  Örnek Kullanım :
            $redis->hmset($key, [
                0 =>[ 
                   'age' => 44,
                   'country' => 'finland',
                   'occupation' => 'software engineer',
                   'reknown' => 'linux kernel'
                ],
                1 =>[ 
                   'age' => 45,
                   'country' => 'turkey',
                   'occupation' => 'software engineer',
                   'reknown' => 'linux kernel'
                ],
            ]);
        */
        //Array ile gelen data içerisinde kaç array daha barındırıyor bakılıyor.
        $boyut = count($values);
        //Toplam boyut belirleniyor.
        $this->setText($hashKey."boyut",$boyut);
        $i=0;
        try {
            foreach ($values as $key => $value) {
                $this->setHashAll($hashKey.$i."tr", $value);
                $i++;
            }
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //hget methodunu kullanrak sadece belirtilen anahtara atanan tek değer alınır.
    public function getHashSingle($hashKey,$key){
        /*
        *   Örnek Kullanım
            $redis->get($key, 'country')); // Finland
        */
        try {
            return $this->redis->hget($hashKey,$key);
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //hget methodunu kullanrak sadece belirtilen anahtara atanan tek değer alınır.
    public function getHashFullMultiArray($hashKey){
        //Redis hafızasına alınan data boyutu
        $boyut = $this->getText($hashKey."boyut");
        $i = 0;
        try {
            for($i;$i<$boyut;$i++){
                $data[] = $this->redis->hgetall($hashKey.$i."tr");
            }
            return $data;
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //hget methodunu kullanrak sadece belirtilen anahtara atanan tek değer alınır.
    public function getHashFull($hashKey){
        /*
        *   Örnek Kullanım
            $data = $redis->hgetall($key);
            print_r($data); // returns all key-value that belongs to the hash
        */
        try {
            return $this->redis->hgetall($hashKey);
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
        //setHashAllMultiArray fonksiyonundan farklı olarak içi içe 3 array verisini ve iç içe 4 array verisini çalıştırır çalıştırır içeren değerler gönderilebilir.
    public function setHashAllMultiArray3Sıze($hashKey,$values = array()){
        /*
         *  Örnek Kullanım :
            $redis->hmset($key,$yeni = array(
                0=>array(
                    "ad"=>
                        array(
                          0=>"Ömer",
                          1=>"Faruk"
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
                          1=>"60kg",
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
                          2=>""
                        )
                    )
                )
            );
        */
        //Array ile gelen data içerisinde kaç array daha barındırıyor bakılıyor.
        $boyut = count($values);
        //Toplam boyut belirleniyor.
        $this->setText($hashKey."boyut3",$boyut);
        $i=0;
        try { 
            foreach ($values as $key => $value) {
                if(is_array($value)){
                    $this->setText($hashKey.$i."tr_",$key);//array taşın sütun adı alınıyor
                    $this->setHashAll($hashKey.$i."tr", $value); 
                    $k=0;
                    foreach ($value as $key2 => $val){
                        if(is_array($val)){//İç içe üçüncü bir array mevcut ise
                            $this->setText($hashKey.$i.$k."tr__",$key2);
//                            $this->setHashAll($hashKey.$i."tr".$key2, $val);
                            $j=0;
                            foreach ($val as $key3 => $v){
                                $this->setText($hashKey.$i."trkey3".$key2.$j,$key3);
                                if(is_array($v)){
                                    $this->setText($hashKey.$i."trkntrl".$key2,1);
                                    $this->setHashAll($hashKey.$i."tr".$key2.$j,$v);
                                } else{
                                    $this->setHashAll($hashKey.$i."tr".$key2, $val);
                                }
                                $j++;
                                $this->setText($hashKey.$i."trsyc".$key2, $j);
                            }
                        }
                    $k++;
                    }					
                } 
                $i++;
            }
//            exit;
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //iç içe 3 ya da 4 array hash değerini getirir.
    public function getHashFullMultiArray3Sıze($hashKey){
        //Redis hafızasına alınan data boyutu
        $boyut = $this->getText($hashKey."boyut3");
        $i = 0;
        try {
            for($i;$i<$boyut;$i++){
                $data[$this->getText($hashKey.$i."tr_")] = $this->redis->hgetall($hashKey.$i."tr");
                $j=0;
                foreach ($data[$this->getText($hashKey.$i."tr_")] as $value){
                    if($value == "Array"){
                        $key = $this->getText($hashKey.$i.$j."tr__");
//                        $data[$this->getText($hashKey.$i."tr_")][$key] = $this->getHashFull($hashKey.$i."tr".$key);
                        if($this->getText($hashKey.$i."trkntrl".$key)==1){
                            $sayac = $this->getText($hashKey.$i."trsyc".$key);
                            unset($data[$this->getText($hashKey.$i."tr_")][$key]);
                            for($k=0;$k<$sayac;$k++){
//                                $data[$this->getText($hashKey.$i."tr_")][$key][$k]= $this->getHashFull($hashKey.$i."tr".$key.$k);
                               $anahtar = $this->getText($hashKey.$i."trkey3".$key.$k);
//                               $anahtar = $k;
                               if(count($this->getHashFull($hashKey.$i."tr".$key.$k))>0){
                                    $data[$this->getText($hashKey.$i."tr_")][$key][$anahtar]= $this->getHashFull($hashKey.$i."tr".$key.$k);
                               } else{
                                    $data[$this->getText($hashKey.$i."tr_")][$key][$anahtar]= $this->getHashFull($hashKey.$i."tr".$key);
                                    $b=0;
                                    $_boyut = count($data[$this->getText($hashKey.$i."tr_")][$key][$anahtar]);
                                    foreach ($data[$this->getText($hashKey.$i."tr_")][$key][$anahtar] as $key2 => $v){
                                        if($i==2){
                                            echo $key2."-$v-$k<br>";
                                            echo "boyut-".$_boyut;
                                        }
                                        
                                        if($b!=$k){
                                            unset($data[$this->getText($hashKey.$i."tr_")][$key][$anahtar][$key2]);
                                        } else{
                                            $_real = $data[$this->getText($hashKey.$i."tr_")][$key][$anahtar][$key2];
                                            $sira  = $anahtar;
                                        }
                                       
                                        $b++;
                                        if($b==$_boyut){
                                            unset($data[$this->getText($hashKey.$i."tr_")][$key][$sira]);
                                            $data[$this->getText($hashKey.$i."tr_")][$key][$sira] = $_real;
                                        }
                                        
                                    }
                               }
                            }
                        } else{
                            $data[$this->getText($hashKey.$i."tr_")][$key] = $this->getHashFull($hashKey.$i."tr".$key);
                        }
                    }
                    $j++;
                }
            }
//            print_r($data);
//            exit;
            return $data;
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //hdel methodu ile redis hafızasına tanımlamış olduğum hash değerini silebilirim.
    public function deleteHash($hashKey,$key=null){
        /*
        *   Örnek Kullanım
            Sadece bir Anahtarı silmek için : $redis->hdel($key, 'country');
            Tanımlı tüm hash değerlerini silmek için : $redis->delete($this->redis->keys($hashKey));
        */
        try {
            if($key){
                $this->redis->hdel($hashKey,$key);
            } else{
                $this->redis->delete($this->redis->keys($hashKey."*"));
            }
        } catch (Exception $ex) {
            return "hata";
        }
    }
    
    //Redis hafıza zamanlaması
    public function setTime($key,$time){
        $this->redis->expire($key, $time); // expires in 1 hour
//        $this->redis->expireat($key, time() + 3600); // expires in 1 hour 
    }
	
}
