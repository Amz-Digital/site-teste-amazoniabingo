<?php

//error_reporting(E_ALL ^ E_NOTICE);

require_once '../vendor/autoload.php';

$siteOwnersEmail = 'info@amzdig.com';

$post = (!empty($_POST)) ? true : false;

if ($post) {
        
    try {
        
        // start captcha 
        
        /*
        $captcha = null;
	if (isset($_POST['g-recaptcha-response'])) {
            $captcha = $_POST['g-recaptcha-response'];
	}

	if (!$captcha) {
            throw new Exception('Please check the the captcha form');
	}
	
	$secretKey = "6Lfq6twUAAAAADJljKzd6m-5SkfWAl2FIUDVNqJY";
	$ip = $_SERVER['REMOTE_ADDR'];
	
	// post request to server
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
	$response = file_get_contents($url);
	$responseKeys = json_decode($response, true);
	
	if(!$responseKeys["success"]) {
            throw new Exception('Spam detected!');
	}
         * 
         */
	
	// end captcha

        $name = trim(stripslashes($_POST['name']));
        $email = trim(stripslashes($_POST['email']));
//        $phone = trim(stripslashes($_POST['phone']));
        
        // message
        if (isset($_POST['message'])) {
            $contact_message = trim(stripslashes($_POST['message']));
        } else {
            $contact_message = null;
        }
        
        // source
        if (isset($_GET['source'])) {
            $source = $_GET['source']; 
        } else {
            $source = null;
        }

        // Set Message
        $message = '';
        $message .= "Nome: " . $name . "<br />";
        $message .= "Email: " . $email . "<br />";
//        $message .= "Telefone: " . $phone . "<br />";
        
        if ($source !== 'subscribe') {
            $message .= "Mensagem: <br />";
            $message .= $contact_message;            
        }
        
        $message .= "<br /> ----- <br /> Mensagem foi enviada via site. <br />";

        // Set From: header
        $from = $name . " <" . $email . ">";

        // Email Headers
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // create the transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('info@amzdig.com')
                ->setPassword('X9>jEQ>A6754')
                ->setAuthMode('login')
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
         
        // subject
        if ($source == 'subscribe') {
            $subject = 'Amazonia Bingo - Nova inscrição';
        } else {
            $subject = 'Amazonia Bingo - Contato';
        }

        // Create a message
        $message = (new Swift_Message($subject))
                ->setFrom([$siteOwnersEmail => 'Amazonia Bingo'])
                ->setTo([
                    'diego@amzdig.com' => 'Diego Escorza',
                    'joi.pires@gmail.com' => 'Reginaldo Pires',
                ])
                ->setReplyTo($email)
                ->setBody($message, 'text/html')
        ;

        // Send the message
        $result = $mailer->send($message);

        if ($result > 0){
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