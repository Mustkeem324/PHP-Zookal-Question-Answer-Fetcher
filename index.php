<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['url'])) {
        $url = filter_var($_GET['url'], FILTER_VALIDATE_URL);
        if ($url === false) {
            echo "Invalid URL provided";
            exit;
        }
    } else {
        echo "URL parameter missing";
        exit;
    }

    $text.= $url;
    //echo $text;
    $Ownername = "NX";
    $OwnernameLINK = "https://t.me/CheggbyTnTbot";
    $path = parse_url($text, PHP_URL_PATH);
    $segments = explode('/', rtrim($path, '/'));
    $slug= end($segments);
    //echo $slug;
    if(preg_match('/zookal.com/', $text)){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://homework-api-v2.production.aws.zookal.com/v1/public-questions/'.$slug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'authority: homework-api-v2.production.aws.zookal.com',
                'accept: application/json, text/plain, */*',
                'accept-language: en-US,en;q=0.9',
                'authorization: '.file_get_contents('cookieszookal.txt'),
                'dnt: 1',
                'newrelic: eyJ2IjpbMCwxXSwiZCI6eyJ0eSI6IkJyb3dzZXIiLCJhYyI6IjIyMjAyMiIsImFwIjoiODgxNzk5NDU1IiwiaWQiOiI4NTBhYTc4MWM4NjMwMDkyIiwidHIiOiJjNTYzMWIzZDJkMzU2ZWI1NDQ0ODA0MjJlZjA4NjAwMCIsInRpIjoxNjk5MTcyNTYyMjI1fX0=',
                'origin: https://www.zookal.com',
                'referer: https://www.zookal.com/',
                'sec-ch-ua: "Chromium";v="118", "Google Chrome";v="118", "Not=A?Brand";v="99"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Linux"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;
        $info = curl_getinfo($curl);
        if( $info["http_code"] =200){
            $data = json_decode($response,true);
            $slug2= $data["question"]["slug"];
            $question= $data["question"]['content'];
            $answer= $data["question"]['answer']['content'];
            //echo $answer;
            $rate = $data["question"]["rating"];
            if ($rate === null) {
                $rate = 0;
            }
            else{
                $rate = $data["question"]["rating"];
            }
            $folderPath ='zookalanswer';
            $filePath = $folderPath . '/'.$slug2.'.html'; // Replace 'filename.html' with your desired file name
            if($answer !== null){
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true); // 0755 is a common permission setting
                    }
                if (file_exists($filePath)) {
                    $answerhtml = file_get_contents($filePath);
                } else {
                    $answerhtml.='<!DOCTYPE html> <html> <head> <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1"> <title>NX pro</title> <meta name="description" content=""> <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css"> <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.0/es5/tex-mml-chtml.min.js"></script> </head> <body> <div class="container"> <div id="app"> <div class="container"> <div class="section"> <div class="box" style="word-break: break-all;"> <h1>Question Link</h1> <div class="url">'.$text.'</div></div> <div class="box"> <div class="content"> <h1>Question</h1> <div class="questionnx">'.$question.'</div><br> <div class="rate">Rate : '.$rate.' ⭐️</div> </div> </div> <div class="box"> <div class="content"> <h1>Answer</h1> <div class="answernx"></div> '.$answer.'</div> </div> </div> </div> </div> </div> <script type="text/x-mathjax-config">MathJax.Hub.Config({ config: ["MMLorHTML.js"], jax: ["input/TeX","input/MathML","output/HTML-CSS","output/NativeMML"], extensions: ["tex2jax.js","mml2jax.js","MathMenu.js","MathZoom.js"], TeX: { extensions: ["AMSmath.js","AMSsymbols.js","noErrors.js","noUndefined.js"] } });</script> <script type="text/javascript" src="https://cdn.mathjax.org/mathjax/2.0-latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script></body> </html>';
                    file_put_contents($filePath, $answerhtml);
                }
                echo $answerhtml;     
            }
            else{
                echo 'error contact owner https://t.me/spacenx1';
            }
        }
    }
}
?>
