<?php
    
if (!empty($_POST)) {
        
    try {
        $token = trim(stripslashes($_POST['token']));

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://rgsapi.amazoniabingo.com/api-op/email-unsubscribe/' . $token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HEADER => TRUE,
            CURLOPT_NOBODY => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic b3BlcmF0aW9uYWxhcGk6b3BlcmFwaWFteg=='
              ),
        ]);

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        
        if ($httpcode == 200) {
            echo json_encode([
                'success' => true
            ]);
        } else {
            echo json_encode([
                'success' => false
            ]);
        }
    
    } catch (\Exception $ex) {
        echo $ex->getMessage();
        die;
    }    
}
?> 