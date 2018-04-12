<?php
class User{
    public function printItem($string){
        echo 'Foo: ' . $string . PHP_EOL;
    }
    
    public function printPHP(){
        echo 'PHP is great.' . PHP_EOL;
    }
}

class RegisteredUser extends User{
    public function printItem($string){
        echo 'Bar: ' . $string . PHP_EOL;
    }
}

?>