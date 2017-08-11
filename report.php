<?php
if (isset($_GET['from']) && isset($_GET['players']) && isset($_GET['reason']) && isset($_GET['server'])) {
    // Place webhook object url here
    $url = '';

    $payload = json_encode(array(
        'username' => 'Report',
        'content' => 'Incoming report bois ┻━┻ ﾐヽ(ಠ益ಠ)ノ彡┻━┻',
        'embeds' => array(array(
            'type' => 'rich',
            'author' => array(
                'name' => 'Report from ' . $_GET['from']
            ),
            'color' => 0xff0000, // red
            'fields' => array(
                array(
                    'name' => 'Reason',
                    'value' => $_GET['reason'],
                    'inline' => true
                ),
                array(
                    'name' => 'Offender(s)',
                    'value' => $_GET['players'],
                    'inline' => true
                ),
                array(
                    'name' => 'Connect',
                    'value' => 'steam://connect/' . $_GET['server']
                )
            )
        ))
    ));

    $ch = curl_init($url);
    
    curl_setopt_array($ch, array(
	      CURLOPT_RETURNTRANSFER => 1, // Block echoing of response
        CURLOPT_SSL_VERIFYPEER => false,
     	  CURLOPT_CAINFO => getcwd() . '/discord.crt',
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8')
    ));

    $result = curl_exec($ch);

    curl_close($ch);

    // Display result of request
    echo $result;
} else {
    exit('Improper request');
}
?>
