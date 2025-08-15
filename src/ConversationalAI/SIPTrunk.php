<?php

declare(strict_types=1);

namespace coreylang\ElevenLabsAI\SIPTrunk;

use coreylang\ElevenLabsAI\Auth;
use coreylang\ElevenLabsAI\ElevenLabs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use SplObjectStorage;

class SIPTrunk extends ElevenLabs
{

    use Auth;

    /**
     * Make outbound call using twilio
     * 
     * @param Array $argsArray an array of outbound call data
     * @return Boolean true if the outbound call is started
     * @throws Exception if an arguement is invalid or missing
     */
    public function MakeOutboundCall(array $argsArray):object
    {
        //  $argsArray:
        //
        //  [Agent_Id] => required, string, the elevenlabs ai caller agent unique id
        //  [Agent_Phone_Number_Id] => required, string, an elevenlabs phone number unique id to call from
        //  [To_Phone_Number] => required, numeric, the phone number to make the outbound call to
        //  [Initiation_Prompt] => optional, text, the agent system prompt
        //  [Initiation_First_Message] => optional, text, the agent greeting or first message
        //  [Initiation_Language] => optional, string, the language the agent speaks
        //  [Initiation_Voice_Id] => optional, string, the voice id of the agent
        //  [INitiation_Native_MCP_Server_Ids] => optional, array, an array of MCP server ids
        //  [Initiation_Custom_LLM_Extra_Body] => optional, string, the custom LLM extra body
        //  [Initiation_User_Id] => optional, string, an user id for agent owner's user identification
        //  [Initiation_Source] => optional, string, the application source name
        //  [Initiation_Version] => optional, string, the application version
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
            $response = $this->ReturnErrorResponse("Agent_Id is missing.");
        if ($agentPhoneNumberId === "")
            $response = $this->ReturnErrorResponse("Phone_Number_Id is missing.");
        if ($toPhoneNumber === "")
            $response = $this->ReturnErrorResponse("To_Phone_Number is missing.");

        // optional
        $initiationPrompt = ($argsArray['Initiation_Prompt']) ?? "";
        $initiationFirstMessage = ($argsArray['Initiation_First_Message']) ?? "";
        $initiationLanguage = ($argsArray['Initiation_Language']) ?? "";
        $initiationVoiceId = ($argsArray['Intitiation_Voice_Id']) ?? "";
        $initiationNativeMCPServerIds = ($argsArray['Initiation_Native_MCP_Server_Ids']) ?? [];
        $initiationCustomLLMExtraBody = ($argsArray['Initiation_Custom_LLM_Extra_Body']) ?? "";
        $initiationUserId = ($argsArray['Initiation_User_Id']) ?? "";
        $initiationSource = ($argsArray['Initiation_Source']) ?? "";
        $initiationVersion = ($argsArray['Initiation_Version']) ?? "";
        $initiationDynamicVariables = (!empty($argsArray['Initiation_Dynamic_Variables']))
                                        ? $argsArray['Initiation_Dynamic_Variables']
                                        : [];
        if (!isset($response)) {
            $payload = [];
            $payload['agent_id'] = $agentId;
            $payload['agent_phone_number_id'] = $agentPhoneNumberId;
            $payload['to_number'] = $toPhoneNumber;

            if (!empty($initiationFirstMessage)) {
                $payload['conversation_initiation_client_data']['conversation_config_override']['agent']['first_message'] = $initiationFirstMessage;
            }

            if (!empty($initiationPrompt)) {
                $payload['conversation_initiation_client_data']['conversation_config_override']['agent']['prompt']['prompt'] = $initiationPrompt;
            }

            if (!empty($initiationLanguage)) {
                $payload['conversation_initiation_client_data']['conversation_config_override']['agent']['language'] = $initiationLanguage;
            }

            if (!empty($initiationVoiceId)) {
                $payload['conversation_initiation_client_data']['conversation_config_override']['tts']['voice_id'] = $initiationVoiceId;
            }

            if (!empty($initiationNativeMCPServerIds)) {
                $payload['conversation_initiation_client_data']['conversation_config_override']['agent']['prompt']['native_mcp_server_ids'] = $initiationNativeMCPServerIds;
            }

            if (!empty($initiationCustomLLMExtraBody)) {
                $payload['conversation_initiation_client_data']['custom_llm_extra_body'] = $initiationCustomLLMExtraBody;
            }

            if (!empty($initiationUserId)) {
                $payload['conversation_initiation_client_data']['user_id'] = $initiationUserId;
            }

            if (!empty($initiationSource)) {
                $payload['conversation_initiation_client_data']['source_info']['source'] = $initiationSource;
            }

            if (!empty($initiationVersion)) {
                $payload['conversation_initiation_client_data']['source_info']['version'] = $initiationVersion;
            }

            if (!empty($initiationDynamicVariables)) {
                $payload['conversation_initiation_client_data']['dynamic_variables'] = $initiationDynamicVariables;
            }

            $headers = [
                "Content-Type" => "application/json",
                "xi-api-key" => $this->GetAuthKey()
            ];

            try {
                $client = new Client();
                $result = $client->post("https://api.us.elevenlabs.io/v1/convai/sip-trunk/outbound_call", [
                    "json" => $payload,
                    "headers" => $headers
                ]);
                $response = json_decode($result->getBody()->getContents(), false);
            } catch(RequestException $e) {
                $response =  $e->getMessage();
            }
        }

        return $response;
    }
}