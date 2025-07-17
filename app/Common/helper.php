<?php

function getAgoraProject($name)
{
    // $customerKey = env('AGORA_CUSTOMER_KEY');
    // $customerSecret = env('AGORA_CUSTOMER_SECRET');
    $customerKey = env('customerKey');

    // Customer Secret
    $customerSecret = env('customerSecret');
    $credentials = base64_encode($customerKey . ':' . $customerSecret);

    $url = 'https://api.agora.io/dev/v1/projects';
    $headers = [
        "Authorization: Basic $credentials",
        "Content-Type: application/json"
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return [
            'error' => true,
            'message' => "cURL Error: $error"
        ];
    }

    $data = json_decode($response, true);

    if (isset($data['projects']) && is_array($data['projects'])) {
        foreach ($data['projects'] as $project) {
            if ($project['name'] === $name) {
                return [
                    'success' => true,
                    'project_id' => $project['id'] ?? null,
                    'name' => $project['name'] ?? null,
                    'app_id' => $project['vendor_key'] ?? null,
                    'certificate' => $project['sign_key'] ?? null,
                    'raw' => $project
                ];
            }
        }

        return [
            'error' => true,
            'message' => "Project '$name' not found.",
            'projects' => $data['projects']
        ];
    }

    return [
        'error' => true,
        'message' => 'Invalid response from Agora API',
        'response' => $data
    ];
}


function createAgoraProject($name)
{
    // Customer ID
    $customerKey = env('customerKey');

    // Customer Secret
    $customerSecret = env('customerSecret');

    // Concatenate customer key and customer secret
    $credentials = $customerKey . ":" . $customerSecret;

    // Encode with base64
    $base64Credentials = base64_encode($credentials);

    // Create authorization header
    $auth_header = "Authorization: Basic " . $base64Credentials;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.agora.io/dev/v1/project',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            "name" => $name,
        ]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            $auth_header
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function createToken($appId, $appCertificate, $channelName)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://mahendrucompany.com/agoraToken/sample/RtcTokenBuilderSample.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'appId' => $appId,
            'appCertificate' => $appCertificate,
            'channelName' => $channelName,
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function generateRandomString($length = 70)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}
