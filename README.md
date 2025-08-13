# PHP ElevenLabs AI
The current release, v0.3.1-beta, has two calls. To make an outbound call using Twilio, and make an outbound call using SIP Trunk. **PHP Elevenlabs AI**'s current focus is the Conversational AI API. In the future we will focus on the other APIs.

## Install
```
composer require coreylang/php-elevenlabs-ai
```

## Twilio MakeOutboundCall() Example Usage

- Returns a response object.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Twilio;

try {
    $client = new Twilio();

    $client->SetAuthKey('{AUTH_KEY}');

    $params = [];
    // --- required
    $params['Agent_Id'] = "{AGENT_ID}";
    $params['Agent_Phone_Number_Id'] = "{AGENT_PHONE_NUMBER_ID}";
    $params['To_Phone_Number'] = "{TO_PHONE_NUMBER}";
    // --- optional
    $params['Intiation_Prompt'] = "{PROMPT_TEXT}";
    $params['Initiation_First_Message'] = "{FIRST_MESSAGE_TEXT}";
    $params['Initiation_Language'] = "{LANGUAGE_CODE}"; // english -> 'en'
    $params['Initiation_Voice_Id'] = "{VOICE_ID}";
    $params['Initiation_Native_MCP_Server_Ids'] = ['{MCP_Server_Id}'];
    $params['Initiation_Custom_LLM_Extra_Body'] = "{Custom_LLM_EXtra_Body_Text}";
    $params['Initiation_User_Id'] = "{Custom_User_Id}";
    $params['Initiation_Source'] = "{Application_Source_Name}";
    $params['Initiation_Version'] = "{Application_Version}";
    $params['Initiation_Dynamic_Variables'] = array(
        'first_name' => 'Corey Lang'
    );

    $result = $client->MakeOutboundCall($params);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

## SIP Trunk MakeOutboundCall() Example Usage

- Returns a response object.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\SIPTrunk\;

try {
    $client = new SIPTrunk();

    $client->SetAuthKey('{AUTH_KEY}');

    $params = [];
    // --- required
    $params['Agent_Id'] = "{AGENT_ID}";
    $params['Agent_Phone_Number_Id'] = "{AGENT_PHONE_NUMBER_ID}";
    $params['To_Phone_Number'] = "{TO_PHONE_NUMBER}";
    // --- optional
    $params['Intiation_Prompt'] = "{PROMPT_TEXT}";
    $params['Initiation_First_Message'] = "{FIRST_MESSAGE_TEXT}";
    $params['Initiation_Language'] = "{LANGUAGE_CODE}"; // english -> 'en'
    $params['Initiation_Voice_Id'] = "{VOICE_ID}";
    $params['Initiation_Native_MCP_Server_Ids'] = ['{MCP_Server_Id}'];
    $params['Initiation_Custom_LLM_Extra_Body'] = "{Custom_LLM_EXtra_Body_Text}";
    $params['Initiation_User_Id'] = "{Custom_User_Id}";
    $params['Initiation_Source'] = "{Application_Source_Name}";
    $params['Initiation_Version'] = "{Application_Version}";
    $params['Initiation_Dynamic_Variables'] = array(
        'first_name' => 'Corey Lang'
    );

    $result = $client->MakeOutboundCall($params);
} catch(Exception $e) {
    echo $e->getMessage();
}
```
