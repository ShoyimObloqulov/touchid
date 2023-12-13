<?php
    function getUserStatus($user_id){
        include_once 'config.php';
        $result = [];
        $sql = mysqli_query($link,"SELECT * FROM `schedule` WHERE user_id='$user_id'");
        if(mysqli_num_rows($sql) > 0){
            $created_at = date('Y-m-d H:i:s');
            $r = mysqli_query($link,"INSERT INTO `schedule`(`id`, `status`, `user_id`, `created_at`) VALUES (NULL,0,'$user_id','$created_at')");
            $row = mysqli_fetch_assoc($sql);
            $result = [
                "success" => 1,
                "status"  => 1,
                "data"    => $row
            ];
        }

        else{
            $r = mysqli_query($link,"INSERT INTO `schedule`(`id`, `status`, `user_id`, `created_at`) VALUES (NULL,1,'$user_id','$created_at')");

            $row = mysqli_fetch_assoc($sql);
            $result = [
                "success" => 1,
                "status"  => 1,
                "data"    => $row
            ];
        }

        return json_encode($result);
    }