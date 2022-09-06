<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$playerId = $_GET['p'];
$sessionId = $_GET['s'];
$langCode = $_GET['l'] ?? 'pt-BR';

if (empty($playerId) || empty($sessionId)) {
    redirectTo('/');
}

//$apiHost = 'http://sandbox.api.amazoniabingo.com';
$apiHost = 'https://rgsapi.amazoniabingo.com';
$apiEndpoint = 'player-self-exclusion';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    session_start();
    
    $apiGetUrl = sprintf(
            '%s/%s/player-data/%s/%s', 
            $apiHost, $apiEndpoint, $playerId, $sessionId
        );
    
    $data = getPlayerData($apiGetUrl);   
            
    if (empty($data)) {        
        switch ($langCode) {
            case 'pt-BR':
                redirectTo('/self-exclusion-fail.php');
                break;
            case 'es-ES':
                redirectTo('/es/self-exclusion-fail.php');
                break;
            case 'en-US':
                redirectTo('/en/self-exclusion-fail.php');
                break;
            default:
                break;
        }
        
    } else {
        // add ids into session and    
        $_SESSION['player_id'] = $playerId;
        $_SESSION['session_id'] = $sessionId; 
        $_SESSION['language_code'] = $langCode;
        
        switch ($langCode) {
            case 'pt-BR':
                redirectTo('/self-exclusion-confirmation.php');
                break;
            case 'es-ES':
                redirectTo('/es/self-exclusion-confirmation.php');
                break;
            case 'en-US':
                redirectTo('/en/self-exclusion-confirmation.php');
                break;
            default:
                break;
        }

        // redirect to self exclusion page
        
    }    
    
} 

function redirectTo($to)
{
    header("Location: {$to}");   
}

function getPlayerData($url): ?array
{
    
    try {
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if( ! $result = curl_exec($curl))
        {
            trigger_error(curl_error($curl));
        }

        $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($httpCode != 200 || empty($result)) {
            return null;
        }

        $player = json_decode($result, true);
        
        if (empty($player['id'])) {
            return null;
        }
        
        return $player;

    } catch (Throwable $ex) {
        return null;
    }
}