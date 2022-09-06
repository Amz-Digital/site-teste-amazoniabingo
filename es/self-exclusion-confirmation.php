<?php

session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//$apiHost = 'http://sandbox.api.amazoniabingo.com';
$apiHost = 'https://rgsapi.amazoniabingo.com';
$apiEndpoint = 'player-self-exclusion';

$playerId = $_SESSION['player_id'];
$sessionId = $_SESSION['session_id'];

if (empty($playerId) || empty($sessionId)) {
    redirectTo('/es/self-exclusion-fail.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $url = sprintf(
            '%s/%s/player-remove/%s/%s', 
            $apiHost, $apiEndpoint, $playerId, $sessionId
        ); 
    
    if (removePlayer($url)) {
        $_SESSION['player_id'] = null;
        $_SESSION['session_id'] = null;
        redirectTo('/es/self-exclusion-success.php');
    } else {
        redirectTo('/es/self-exclusion-fail.php');
    }
}

function redirectTo($to)
{
    header("Location: {$to}");   
}

function removePlayer($url): bool
{
    
    try {
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        
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

        if ($httpCode != 200) {
            return false;
        }
        
        return true;

    } catch (Throwable $ex) {
//        throw $ex;
        return false;
    }
}

?>

<!doctype html>
<html lang="en">
    <head>        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TZ29WQ3');</script>
        <!-- End Google Tag Manager -->
        
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Confirmación de autoeliminación</title>
        <meta name="description" content="Condiciones de Servicio">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="/css/font-awesome.min.css" rel="stylesheet">
        <link href="/font/flaticon.css" rel="stylesheet">

        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/slick.css" rel="stylesheet">
        <link href="/css/animate.min.css" rel="stylesheet">
        <link href="/css/magnific-popup.css" rel="stylesheet">
        <link href="/css/YouTubePopUp.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/menu.css">

        <link rel="icon" href="/images/icon/favicon.png"/>

        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/responsive.css" rel="stylesheet">
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZ29WQ3"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v11.0" nonce="CAAejLVO"></script>

        <div id="back-top-btn">
            <i class="fa fa-chevron-up"></i>
        </div>

        <section id="header">
            <nav id="nav-part" class="navbar header-nav other-nav custom_nav full_nav sticky-top navbar-expand-md hidden-main">
                <div class="container">
                    <div class="collapse navbar-collapse justify-content-between" id="bs-example-navbar-collapse-1">
                        <div class="nav-res d-flex">                            
                            <ul class="nav navbar-nav menu-inner">
                                <li><a href="/es/index.html#banner">Home</a></li>
                                <li><a href="/es/index.html#project-img">Juegos</a></li>
                                <li><a href="/es/index.html#faq">Soporte</a></li>
                            </ul>                            
                            <a class="navbar-brand" href="/es/index.html"><img src="/images/logo/amazonia-bingo.png" class="img-fluid logo-color" alt="logo amazonia bingo"></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <ul class="social-media-box list-unstyled list-inline">
                                <li class="list-inline-item" title="facebook">
                                    <a target="_blank" href="https://www.facebook.com/amazoniabingo">
                                        <img src="/images/social/facebook.png">
                                    </a>
                                </li>
                                <li class="list-inline-item" title="youtube">
                                    <a target="_blank" href="https://www.youtube.com/channel/UCO7JEY9snjKxFsvmm6wS3kA">
                                        <img src="/images/social/youtube.png">
                                    </a>
                                </li>
                                <li class="list-inline-item" title="instagram">
                                    <a target="_blank" href="https://www.instagram.com/amazoniabingo">
                                        <img src="/images/social/instagram.png">
                                    </a>
                                </li>
                                <li class="btn-language list-inline-item" title="Seleccione el Idioma">
                                    <a target="#"  data-toggle="modal" data-target=".language-selector-modal">
                                        <img src="/images/flag/spain.png">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <nav id='cssmenu' class="hidden mobile">
                <div class="logo">
                    <a href="/es/index.html" class="logo">
                        <img src="/images/logo/amazonia-bingo.png" class="img-responsive" alt="logo amazonia bingo">
                    </a>
                </div>
                <div id="head-mobile"></div>
                <div class="btn-language">
                    <a target="#"  data-toggle="modal" data-target=".language-selector-modal">
                        <img src="/images/flag/spain.png">
                    </a>
                </div>
                <div class="button"><i class="more-less fa fa-align-right"></i></div>
                <ul>
                    <li><a href="/es/index.html#banner" class="active">Home</a></li>
                    <li><a href="/es/index.html#project-img">Juegos</a></li>
                    <li><a href="/es/index.html#faq">Soporte</a></li>
                </ul>
            </nav>
        </section>

        <section id="inner-content" class="back-light section">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6 mt-5 ">
                        <div class="heading">
                            <h1>Eliminación automática de cuenta</h1>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <div class="">
                            <h3 class="text-uppercase font-italic pt-5">¿Está seguro?</h3>
                        </div>
                    </div>
                </div>
                
                <div class="row text-justify justify-content-center text-center">
                    <div class="col-md-10">
                        <p>Eliminar tu cuenta es irreversible. Perderás: monedero, nivel, colecciones, progreso de estrellas. Si es así, haga clic en "eliminar mi cuenta" a continuación para comenzar.</p>
                    </div>
                    
                    <div class="row justify-content-center text-center">
                        <form method="POST">
                            <div clas="text-justify">
                                <input class="btn btn-danger pb-1" type="submit" value="Sí, eliminar mi cuenta">
                                <a href="/es/index.html" class="btn btn-secondary pb-1">Mantener mi cuenta</a>
                            </div>
                        </form> 
                    </div>
                
                </div> 
            </div>
        </section>
        
        <section id="contact-us" class="contact-us back-dark contact section">
            <div class="container">
                <div class="row">                    

                    <div class="col-lg-6 col-md-12 mb-5">
                        <div class="row contact-about">
                            <div class="col-12">
                                <div class="heading">
                                    <h2>Sobre nosotros</h2>
                                </div>
                                <p>
                                    Amazonia Bingo te da la bienvenida a través de una propuesta de experiencia y viaje increíble con premios, jackpots,
                                    bingos y mucha emoción. Nuestro soporte está listo para resolver problemas, aprender, mejorar y deleitar a nuestros clientes.
                                    Estaremos preparando novedades, nuevos juegos, promociones a través de nuestras redes sociales.
                                </p>
                            </div>
                            <div class="col-12 mt-5 game-links">
                                <div class="row justify-content-center">
                                    <div class="heading">
                                        <h2>Jogue</h2>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <a class="btn-glow" target="_blank" href="https://play.google.com/store/apps/details?id=com.amazoniagaming.lobby">
                                        <img src="/images/platform/play_store.png">
                                    </a>
                                </div>
                                <div class="mt-5 row justify-content-center">
                                    <a class="btn-glow" target="_blank" href="https://apps.apple.com/br/app/amazonia-bingo/id1577781549">
                                        <img src="/images/platform/app_store.png">
                                    </a>                                    
                                </div>
                                <div class="mt-5 row justify-content-center">
                                    <a class="btn-glow" target="_blank" href="https://apps.facebook.com/amazoniabingo/">
                                        <img src="/images/platform/facebook.png">
                                    </a>
                                </div>
                            </div>
                        </div>                                                
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="heading">
                            <h2>Acceso</h2>
                        </div>
                        <div class="fb-page" data-href="https://www.facebook.com/amazoniabingo" data-tabs="timeline, messages" data-width="400" data-height="550" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/amazoniabingo" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/amazoniabingo">Amazonia Bingo - Casino Social - Slots &amp; Video Bingo Grátis</a></blockquote></div>
                        <ul class="social-media-box list-unstyled list-inline">
                            <li class="list-inline-item" title="facebook">
                                <a target="_blank" href="https://www.facebook.com/amazoniabingo">
                                    <img src="/images/social/facebook.png">
                                </a>
                            </li>
                            <li class="list-inline-item" title="youtube">
                                <a target="_blank" href="https://www.youtube.com/channel/UCO7JEY9snjKxFsvmm6wS3kA">
                                    <img src="/images/social/youtube.png">
                                </a>
                            </li>
                            <li class="list-inline-item" title="instagram">
                                <a target="_blank" href="https://www.instagram.com/amazoniabingo">
                                    <img src="/images/social/instagram.png">
                                </a>
                            </li>
                            <li class="list-inline-item" title="twitter">
                                <a target="_blank" href="https://twitter.com/AmazoniaBingo">
                                    <img src="/images/social/twitter.png">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>                
            </div>  
        </section>

        <section id="footer" class="footer back-dark section pt-0 pb-0">
            <div class="container">

                <div class="row control-pad">
                    <div class="border-effect1">
                        <img src="/images/border/border-effect.png" class="img-fluid">
                    </div>
                    <div class="border-effect2">
                        <img src="/images/border/border-effect.png" class="img-fluid">
                    </div>
                </div>

                <div class="row justify-content-center text-center">
                    <div class="col-md-12 bot-menu mb-5">
                        <div class="foot-menu">                            
                            <a href="/es/terms-of-service.html">Condiciones de Servicio</a>
                            <span> | </span>
                            <a href="/es/terms-of-privacy-policy.html">Política de Privacidad</a>
                            <span> | </span>
                            <a href="/es/terms-of-cookies-policy.html">Política de Cookies</a>
                            <span> | </span>
                            <a href="/es/responsible-game.html">Juego Responsable</a>
                            <span> | </span>
                            <a href="/es/index.html#faq">Preguntas frecuentes</a>
                        </div>
                    </div>
                    <div class="col-md-12 pb-5">
                        <div class="copy-right">
                            <h5>2021 &copy Amazonia Bingo. Todos los derechos reservados.</h5>
                            <!-- <h6>todos los derechos reservados</h6>                             -->
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="text-center modal fade language-selector-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="select-language">
                            <button type="button" class="btn-change-language" data-language='pt'>
                                <img src="/images/flag/brazil.png">
                            </button>
                            <button type="button" class="btn-change-language" data-language='es'>
                                <img src="/images/flag/spain.png">
                            </button>
                            <button type="button" class="btn-change-language" data-language='en'>
                                <img src="/images/flag/usa.png">
                            </button>
                        </div>                                            
                    </div>
                </div>
            </div>
        </div>


        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/jquery-migrate-3.0.0.min.js"></script>

        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/slick.min.js"></script>
        <script src="/js/counter.js"></script>
        <script src="/js/jquery.countdown.min.js"></script>
        <script src="/js/menu-opener.js"></script>
        <script src="/js/waypoints.js"></script>
        <script src="/js/YouTubePopUp.jquery.js"></script>
        <script src="/js/jquery.event.move.js"></script>
        <script src="/js/SmoothScroll.js"></script>

        <script src="/js/custom.js"></script>
        <script src="/js/menu.js"></script>
    </body>
</html>
