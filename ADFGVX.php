<?php 
class ADFGVX{
    public $key ; 
    public $plainText ; 
    public $alphabet = "abcdefghiklmnopqrstuvwxyz";
    public $chares = array('A','D','F','G','V','X');
    public $number = array(0,1,2,3,4,5,6,7,8,9);
    public $arr = array([6],[6],[6],[6],[6],[6]);

    public function __construct($key , $plainText){
        $this->key = $key ; 
        $this->plainText = $plainText ;
    }
    public function removeDuplicateCharacter($key){
        $newKey = [];
        foreach(str_split($key) as $char){
            if(!in_array($char,$newKey)){
                $newKey[] = $char ;
            }
        }
        return  implode("",$newKey);
    }
    public function createAlphabet($newKey){
        $newAlphabet = [];
        foreach(str_split($this->alphabet) as $char){
            if(!in_array($char , str_split($newKey))){
                $newAlphabet[] = $char; 
            }
        }
        $usedAlphabet = implode("",$newAlphabet); 
        return $usedAlphabet; 
    }
    public function createArray($alphabet , $key){
        $countKey = 0 ;
        $countAlphabet = 0 ;
        $countNumber = 0 ; 
        for($i = 0 ; $i < 6 ; $i++){
            for($j = 0 ; $j < 6 ; $j++){
                if($countKey < strlen($key)){
                    $this->arr[$i][$j] = $key[$countKey];
                    $countKey++ ;
                }else if($countAlphabet < strlen($alphabet)){
                    $this->arr[$i][$j] = $alphabet[$countAlphabet];
                    $countAlphabet++ ;
                }else{
                    $this->arr[$i][$j] = $this->number[$countNumber];
                    $countNumber++; 
                }
            }
        }
    }
    public static function findIndexOfElement($char, $arr){
        for($i = 0 ; $i < 6 ; $i++){
            for($j = 0 ; $j < 6 ; $j++){
                if($arr[$i][$j] == $char){
                    return ([$i,$j]);
                }
            }
        }
    }
    public function cipherText($plainText,$array){
        $cipherText = '';
        $plainText = str_split($plainText);
        foreach($plainText as $charcter){
            $arr = ADFGVX::findIndexOfElement($charcter , $array);
            $cipherText .= $this->chares[$arr[0]];
            $cipherText .= $this->chares[$arr[1]];
            $cipherText .= " ";
        }
        return $cipherText ; 
    }
    public function printArray(){
        for($i = 0 ; $i < 6 ; $i++){
            for($j = 0 ; $j < 6 ; $j++){
                print("{$this->arr[$i][$j]} ");
            }
            print("\n");
        }
    }

}
$obj = new ADFGVX("hellllllo","tomorrow");
$newKey = $obj->removeDuplicateCharacter($obj->key);

print("new Key is : ");
print($newKey);
print("\n");

$usedAlphabet = $obj->createAlphabet($newKey);
print("used Alphabet is : ".$usedAlphabet);
print("\n");

$obj->createArray($usedAlphabet , $newKey);
print("Used Array is : \n");


$obj->printArray();
print("____________________________________________ \n");

$cipherText = $obj->cipherText($obj->plainText , $obj->arr);
print("Cipher Text is : ".$cipherText);
