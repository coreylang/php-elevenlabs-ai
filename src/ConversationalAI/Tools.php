<?php

declare(strict_types=1);

namespace coreylang\ElevenLabsAI\ConversationalAI;

use coreylang\ElevenLabsAI\Auth;
use coreylang\ElevenLabsAI\ElevenLabs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Tools extends ElevenLabs
{
    use Auth;

    /**
     * Create a Elevenlabs tool
     * 
     * @param array an array of tool options to create a tool
     * @return object|array a response object
     */
    public function CreateTool($toolOptions):object|array
    {
        if (isset($toolOptions['tool_config'])
            && empty($toolOptions['tool_config']['name'])
        )
            $response = $this->ReturnErrorResponse("Tool config 'name' is required.");

        if (isset($toolOptions['tool_config'])
            && empty($toolOptions['tool_config']['description'])
        )
            $response = $this->ReturnErrorResponse("Tool config 'description' is required.");

        if (isset($toolOptions['tool_config'])
            && (isset($toolOptions['tool_config']['type']))
            && (strtolower($toolOptions['tool_config']['type']) == "webhook")
            && empty($toolOptions['tool_config']['api_schema'])
        )
            $response = $this->ReturnErrorResponse("Webhook tool config 'api_schema' is required.");

        if (isset($toolOptions['tool_config'])
            && (isset($toolOptions['tool_config']['type']))
            && (strtolower($toolOptions['tool_config']['type']) == "webhook")
            && empty($toolOptions['tool_config']['api_schema']['url'])
        )
            $response = $this->ReturnErrorResponse("Webhook tool config 'api_schema' 'url' is required.");

        if (isset($toolOptions['tool_config'])
            && (isset($toolOptions['tool_config']['type']))
            && (strtolower($toolOptions['tool_config']['type']) == "system")
            && empty($toolOptions['tool_config']['params'])
        )
            $response = $this->ReturnErrorResponse("System tool, tool config 'params' is required.");


        if (isset($toolOptions['tool_config'])
            && (isset($toolOptions['tool_config']['type']))
            && (strtolower($toolOptions['tool_config']['type']) == "system")
            && empty($toolOptions['tool_config']['params']['system_tool_type'])
        )
            $response = $this->ReturnErrorResponse("System tool, tool config 'params' 'system_tool_type' is required.");

        if (!isset($response)) {
            $headers = array(
                "Content-Type" => "application/json",
                "xi-api-key" => $this->GetAuthKey()
            );

            try {
                $client = new Client();
                $result = $client->post("https://api.elevenlabs.io/v1/convai/tools", [
                    "headers" => $headers,
                    "json" => $toolOptions,
                    'http_errors' => false // disable throwing exceptions on HTTP errors
                ]);
                $response = json_decode($result->getBody()->getContents(), false);
            } catch(\Exception $e) {
                $response = $e->getMessage();
            }
        }

        return $response;
    }
}
