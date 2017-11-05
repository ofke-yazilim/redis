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
                $this->redis->delete($this->redis->keys($hashKey));
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
