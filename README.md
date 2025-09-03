![PHP-ElevenLabs-AI](https://coreylang.github.io/php-elevenlabs-ai/logo_black_elephant.png)

# PHP ElevenLabs AI

[![Latest Version](https://img.shields.io/badge/release-v0.7.2_beta-blue)](https://github.com/coreylang/php-elevenlabs-ai/releases)


PHP ElevenLabs AI is a PHP library to make calls to the ElevenLabs Conversational AI API.

**PHP ElevenLabs AI**'s current focus is the Conversational AI API. In the future we will focus on the other APIs.
The current release has calls to Twilo, SIP Trunk, Conversations, Tools, and Batch Calling APIs. 

# Need Help?

Email me coreylang.dev@gmail.com

## Install

The recommended way to install PHP ElevenLabs AI is through
[Composer](https://getcomposer.org/).

```bash
composer require coreylang/php-elevenlabs-ai
```

## Twilio

###  Make Outbound Call Example
Handle an outbound call via Twilio

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Twilio;

try {
    $client = new Twilio();

    $client->SetAuthKey('{API_KEY}');

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

## SIP Trunk

###  Make Outbound Call Example
Handle an outbound call via SIP trunk

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\SIPTrunk;

try {
    $client = new SIPTrunk();

    $client->SetAuthKey('{API_KEY}');

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

## Conversations

### Get Conversation Details Example
Get the details of a particular conversation

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Conversations;

$conversationId = "{CONVERSATION_ID}";

try {
    $client = new Conversations();

    $client->SetAuthKey({API_KEY});

    $conversation = $client->GetConversationDetails($conversationId);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Get Conversation Audio Example
Get the audio recording of a particular conversation

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Conversations;

$conversationId = "{CONVERSATION_ID}";

try {
    $client = new Conversations();

    $client->SetAuthKey('{API_KEY}');

    $audio = $client->GetConversationAudio($conversationId);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Delete Conversation Example
Delete a particular conversation

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Conversations;

$conversationId = "{CONVERSATION_ID}";

try {
    $client = new Conversations();

    $client->SetAuthKey('{API_KEY}');

    $result = $client->DeleteConversation($conversationId);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Get Signed URL Example
Get a signed url to start a conversation with an agent with an agent that requires authorization

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Conversations;

$agent_id = "{AGENT_ID}";

try {
    $client = new Conversations();

    $client->SetAuthKey('{API_KEY}');

    $result = $client->GetSignedURL($agent_id);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Get Conversation Token Example
Get a WebRTC session token for real-time communication

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Conversations;

$agent_id = "{AGENT_ID}";
$participantName = "{PARTICIPANT_NAME}";

try {
    $client = new Conversations();

    $client->SetAuthKey('{API_KEY}');

    $result = $client->GetSignedURL($agent_id, $participantName);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Send Conversation Feedback Example
Send the feedback for the given conversation

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Conversations;

$conversation_id = "{CONVERSATION_ID}";
$feedback = "like"; // either 'like' or 'dislike'

try {
    $client = new Conversations();

    $client->SetAuthKey('{API_KEY}');

    $result = $client->SendConversationFeedback($conversation_id, $feedback);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### List Conversations Example
Get all conversations of agents that user owns. With option to restrict to a specific agent.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Conversations;

// each option is optional
$options = [ 
    'cursor' => '{CURSOR_STRING}',
    'agent_id' => '{AGENT_ID}',
    'call_successful' => '{CALL_SUCCESSFUL}', // success, failure, or unknown
    'call_start_before_unix' => '{CALL_START_BEFORE_UNIX_TIMESTAMP}',
    'call_start_after_unix' => '{CALL_START_AFTER_UNIX_TIMESTAMP}',
    'user_id' => '{USER_ID}',
    'page_size' => '{PAGE_SIZE_INTEGER}', // >=1, <=100 defaults to 30
    'summary_mode' => '{SUMMARY_MODE}', // either exclude, or include
]

try {
    $client = new Conversations();

    $client->SetAuthKey('{API_KEY}');

    $result = $client->SendConversationFeedback($options);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

## Tools

### Create tool
Add a new tool to the available tools in the workspace.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Tools;

try {
    $client = new Tools();

    $client->SetAuthKey('{API_KEY}');

    $params = [];
    $params['tool_config'] = [
        'name' => 'Test_Webhook_Tool',
        'description' => 'A test tool created by the API',
        'api_schema' => [
            'url' => 'https://coreylang.dev/AI/TestToolCreatedByAPI',
            'method' => 'GET',
        ],
        'type' => 'webhook'
    ];

    // $params['tool_config'] = [
    //     'name' => 'Test_Client_Tool',
    //     'description' => 'A test tool created by the API',
    //     'type' => 'client'
    // ];

    // $params['tool_config'] = [
    //     'name' => 'end_call',
    //     'description' => 'A test system tool created by the API',
    //     'params' => ['system_tool_type' => 'end_call'],
    //     'type' => 'system'
    // ];

    $result = $client->CreateTool($params);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Get tool
Get tool that is available in the workspace.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Tools;

try {
    $client = new Tools();

    $client->SetAuthKey('{API_KEY}');

    $tool_id = "{TOOL_ID}";

    $result = $client->GetTool($tool_id);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Delete tool
Delete tool from the workspace.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Tools;

try {
    $client = new Tools();

    $client->SetAuthKey('{API_KEY}');

    $tool_id = "{TOOL_ID}";

    $result = $client->DeleteTool($tool_id);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Update tool
Update tool that is available in the workspace.

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Tools;

try {
    $client = new Tools();

    $client->SetAuthKey('{API_KEY}');

    $toolOptions = [];
    $toolOptions['tool_config'] = [
        'name' => 'Test_Webhook_Tool',
        'description' => 'A test tool created by the API',
        'api_schema' => [
            'url' => 'https://coreylang.dev/AI/TestToolCreatedByAPI',
            'method' => 'GET',
        ],
        'type' => 'webhook'
    ];

    // $toolOptions['tool_config'] = [
    //     'name' => 'Test_Client_Tool',
    //     'description' => 'A test tool created by the API',
    //     'type' => 'client'
    // ];

    // $toolOptions['tool_config'] = [
    //     'name' => 'end_call',
    //     'description' => 'A test system tool created by the API',
    //     'params' => ['system_tool_type' => 'end_call'],
    //     'type' => 'system'
    // ];

    $result = $client->UpdateTool($toolId, $toolOptions);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Get dependent agents
Get a list of agents depending on this tool

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use coreylang\ElevenLabsAI\ConversationalAI\Tools;

try {
    $client = new Tools();

    $client->SetAuthKey('{API_KEY}');

    $tool_id = "{TOOL_ID}";

    $result = $client->GetDependentAgents($tool_id);
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Submit Batch calling job
Submit a batch call request to schedule calls for multiple recipients.

```php
<?php

require __DIR__."/vendor/autoload.php"

use coreylang\ElevenLabsAI\ConversationalAI\BatchCalling;

try {
    $client = new BatchCalling();

    $client->SetAuthKey('{API_KEY}');

    $params = [];
    $params['call_name'] = "{CALL_NAME}";
    $params['agent_id'] = "{AGENT_ID}";
    $params['agent_phone_number_id'] = "{AGENT_PHONE_NUMBER_ID}";
    $params['scheduled_time_unix'] = "{UNIX_TIME_STAMP}";
    $params['recipients'] = [];
    $params['recipients']['phone_number'] = "{PHONE_NUMBER}";
    $params['recipients']['id'] = "{CUSTOM_ID}";
    $params['recipients']['conversation_initiation_client_data'] = [
        'conversation_config_override' => [
            "agent" => [
                'first_message' => "{FIRST_MESSAGE_TEXT}",
                'language' => "{LANGUAGE_CODE}",
                'prompt' => "{PROMPT_TEXT}"
            ],
            "conversation" => [
                'text_only' => "{true or false}"
            ],
            "tts" => [
                'voice_id' => "{VOICE_ID}"
            ]
        ],
        'custom_llm_extra_body' => "{CUSTOM_LLM_TEXT}",
        'user_id' => "{USER_ID}",
        'source_info' => [
            'source' => 'unknown',
            'version' => '{VERSION_NUMBER}'
        ]
    ];

    $result = $client->SubmitBatchCallingJob($params);
} catch(Exception $e) {
    echo $e->getMessage();
}

```