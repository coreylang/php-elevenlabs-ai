<?php

declare(strict_types=1);

/**
*
*/

namespace coreylang\ElevenLabsAI\ConversationalAI;

use coreylang\ElevenLabsAI\ElevenLabs;
use coreylang\ElevenLabsAI\Auth;

use GuzzleHttp\Client;

class Twilio extends ElevenLabs
{

    use Auth;

    /**
     * Make outbound call using twilio
     * 
     * @param Array $argsArray an array of outbound call data
     * @return Boolean true if the outbound call is started
     * @throws Exception if an arguement is invalid or missing
     */
    public function MakeOutboundCall(array $argsArray):mixed
    {

        //  $argsArray:
        //  [Agent_Id] => required, string, the elevenlabs ai caller agent unique id
        //  [Agent_Phone_Number_Id] => required, string, an elevenlabs phone number unique id to call from
        //  [To_Phone_Number] => required, numeric, the phone number to make the outbound call to
        //  [Initiation_Prompt] => optional, text, the agent system prompt
        //  [Initiation_First_Message] => optional, text, the agent greeting or first message
        //  [Initiation_Language] => optional, string, the speaking language of the agent
        //  [Initiation_Voice_Id] => optional, string, the voice id of the agent
        //  [Initiation_Dynamic_Variables] => optional, array, an array of dynamic variables
        //  [
        //      'Variable_Name' => 'Variable_Value',
        //      ...
        //  ]

        // required
        $agentId = ($argsArray['Agent_Id']) ?? "";
        $agentPhoneNumberId = ($argsArray['Agent_Phone_Number_Id']) ?? "";
        $toPhoneNumber = ($argsArray['To_Phone_Number']) ?? "";
        if ($agentId === "")
            throw "Agent_Id is missing.";
        if ($agentPhoneNumberId === "")
            throw "Phone_Number_Id is missing.";
        if ($toPhoneNumber === "")
            throw "To_Phone_Number is missing.";

        // optional
        $initiationPrompt = ($argsArray['Initiation_Prompt']) ?? "";
        $initiationFirstMessage = ($argsArray['Initiation_First_Message']) ?? "";
        $initiationLanguage = ($argsArray['Initiation_Language']) ?? "";
        $initiationVoiceId = ($argsArray['Intitiation_Voice_Id']) ?? "";
        $initiationDynamicVariables = (!empty($argsArray['Initiation_Dynamic_Variables']))
                                        ? $argsArray['Intiation_Dynamic_Variables']
                                        : [];

        $headers = [
            "Content-Type: application/json",
            "xi-api-key: " . $this->GetAuthKey()
        ];

        $payload = [];
        $payload['agent_id'] = $agentId;
        $payload['agent_phone_number_id'] = $agentPhoneNumberId;
        $payload['to_number'] = $toPhoneNumber;

        if (!empty($initiationFirstMessage))
        {
            $payload['conversation_initiation_client_data']['conversation_config_override']['agent']['first_message'] = $initiationFirstMessage;
        }

        if (!empty($initiationPrompt))
        {
            $payload['conversation_initiation_client_data']['conversation_config_override']['agent']['prompt']['prompt'] = $initiationPrompt;
        }

        if (!empty($initiationLanguage))
        {
            $payload['conversation_initiation_client_data']['conversation_config_override']['agent']['language'] = $initiationLanguage;
        }

        if (!empty($initiationVoiceId))
        {
            $payload['conversation_initiation_client_data']['conversation_config_override']['tts']['voice_id'] = $initiationVoiceId;
        }

        if (!empty($initiationDynamicVariables))
        {
            $payload['conversation_initiation_client_data']['dynamic_variables'] = $initiationDynamicVariables;
        }

        try {
            $client = new Client();
            $response = $client->post("https://api.us.elevenlabs.io/v1/convai/twilio/outbound_call", [
                "json" => $payload,
                "headers" => $headers
            ]);
        } catch(Exception $e) {
            throw $e->getMessage();
        }

        return true;
    }
}
