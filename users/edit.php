<?php

    include_once '../config.php';
    $result = [];
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        $response = (array) json_decode(file_get_contents("php://input"), TRUE);
        $id = intval($response['id']);
        $name = strval($response['data']['name']);
        $call = strval($response['data']['call']);
        $position = strval($response['data']['position']);
        $definition = strval($response['data']['definition']);
        $password = strval($response['data']['password']);
        $login = strval($response['data']['login']);

        $sql = mysqli_query($link, "UPDATE users SET password='$password',login='$login',name='$name', `call`='$call', `position`='$position', definition='$definition' WHERE id=$id");
        if ($sql) {
            $result = [
                "success" => 1,
                "message" => "Foydalanuvchi taxrirlandi"
            ];
        } else {
            $result = [
                "success" => 0,
                "message" => "Foydalanuvchi taxrirlashdagi hatolik"
            ];
        }
    } else {
        $result = [
            "success" => 0,
            "message" => "Bu urlga faqatgina PUT malumotlarni yuborish mumkin"
        ];
    }

    echo json_encode($result);