# PHP ElevenLabs AI
The current release, v0.1.1-beta, has functionality for only one API call. That is to make an outbound call using Twilio, using the ElevenLabs Conversational AI API. **PHP Elevenlabs AI**'s current focus is the Conversational AI API. In the future we will focus on the other APIs.

## Install
```
composer require coreylang/php-elevenlabs-ai
```

## Example Usage

- If an outbound call is successfull Twilio::MakeOutboundCall() will return _true_.
- If an outbound call errors, an exception is thrown.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Twilio;

try {
    $client = new Twilio();

    $client->SetAuthKey({AUTH_KEY});

    $params = [];
    // --- required
    $params['Agent_Id'] = "{AGENT_ID}";
    $params['Agent_Phone_Number_Id'] = "{AGENT_PHONE_NUMBER_ID}";
    $params['To_Phone_Number'] = "{TO_PHONE_NUMBER}";
    // --- optional
    $params['Intiation_Prompt'] = "{PROMPT_TEXT}";
    $params['Initiation_First_Message'] = "{FIRST_MESSAGE_TEXT}";
    $params['Initiation_Language'] = "{LANGUAGE_CODE}"; // english -> 'en'
    $params['Intitiation_Voice_Id'] = "{VOICE_ID}";
    $params['Initiation_Dynamic_Variables'] = array (
        'first_name' => 'Corey Lang'
    );

    $result = $client->MakeOutboundCall($params);
} catch(Exception $e) {
    echo $e->getMessage();
}
```