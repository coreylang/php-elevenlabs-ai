<?php 

declare(strict_types=1);

namespace coreylang\ElevenLabsAI\ConversationalAI;

use coreylang\ElevenLabsAI\Auth;
use coreylang\ElevenLabsAI\ElevenLabs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Conversations extends ElevenLabs
{

    use Auth;

    /**
     * Get a ElevenLabs conversation details
     * 
     * @param string $conversation_id the conversation id
     * @return object the response object 
     */
    public function GetConversationDetails(string $conversation_id): object
    {
        $headers = [
            "Content-Type" => "application/json",
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversations/$conversation_id", [
                "headers" => $headers
            ]);
            $response = json_decode($result->getBody()->getContents(), false);
        } catch(Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Get a ElevenLabs conversation audio
     * 
     * @param string $conversation_id the conversation id
     * @return object the response object
     */
    public function GetConversationAudio(string $conversation_id): mixed
    {
        $headers = [
            "Content-Type" => "application/json",
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversations/$conversation_id/audio", [
                "headers" => $headers
            ]);
            $response = $result->getBody()->getContents();
        } catch(Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Delete a Elevenlabs conversation
     * 
     * @param string $conversation_id the conversation id
     * @return object the response object
     */
    public function DeleteConversation(string $conversation_id): object
    {
        $headers = [
            "Content-Type" => "application/json",
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversations/$conversation_id", [
                "headers" => $headers
            ]);
            $response = json_decode($result->getBody()->getContents(), false);
        } catch(Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
