<?php
    include_once '../config.php';
    $result = [];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $response = (array) json_decode(file_get_contents("php://input"),TRUE);

        $name       = strval($response['name']);
        $call       = strval($response['call']);
        $position   = strval($response['position']);
        $definition = strval($response['definition']);
        $login      = strval($response['login']);
        $password   = sha1(strval($response['password']));

        $sql = mysqli_query($link,"INSERT INTO `users` (`login`,`password`,`name`, `call`, `position`, `definition`) VALUES ('$login','$password','$name','$call','$position','$definition')");

        if ($sql){
            $result = [
                "success" => 1,
                "message" => "Foydalanuvchi qo'shildi"
            ];
        }

        else{
            $result = [
                "success" => 0,
                "message" => "Foydalanuvchi qo'shishdagi hatolik"
            ];
        }
    }
    else{
        $result = [
            "success"   => 0,
            "message"   => "Bu urlga faqatgina POST malumotlarni yuborish mumkin"
        ];
    }

    echo json_encode($result);