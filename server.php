<?php

$url = 'https://api.github.com/search/repositories';

$context = stream_context_create([
    "http" => [
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
    ]
]);

//=========== MAIN CODE START ===============
if( isset( $_GET["rules"] ) ){
    $rules = json_decode( $_GET["rules"] );

    $options_text = '?q=';

    foreach($rules as $rule){
        $options_text .= $rule->field.':'.$rule->operator.$rule->value.'+';
    }

    file_put_contents('test.txt', $url.$options_text); //<---- test row to see what happens

    $data = file_get_contents($url.$options_text, false, $context);

    //====exit with data====
    exit($data);
}

//===exit if errors===
exit('Error');