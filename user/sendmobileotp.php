<?php

class sendmobileotp
{

    function send_mobileOtp($mobile)
    {


        $otp = rand(100000, 999999);

        $_SESSION["mobileotp"] = $otp;


        $fields = array(
            "sender_id" => "CHKSMS",
            "message" => "2",
            "variables_values" => $otp,
            "route" => "s",
            "numbers" => $mobile,
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization:jfTF9kUteOhuXxQob4iYlwnaPZC2zSGBsM6rRVL035p8yqKE1JoCEzKQ4cjfI6d09FVeSJ8TbZ7NkOts",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo 1;
        }
    }
}
