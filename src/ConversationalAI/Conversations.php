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
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversations/$conversation_id", [
                "headers" => $headers,
                'http_errors' => false // disable throwing exceptions on HTTP errors
            ]);
            $response = json_decode($result->getBody()->getContents(), false);
        } catch(\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Get a ElevenLabs conversation audio
     * 
     * @param string $conversation_id the conversation id
     * @return mixed the response object or error message
     */
    public function GetConversationAudio(string $conversation_id):mixed
    {
        $headers = [
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversations/$conversation_id/audio", [
                "headers" => $headers,
                'http_errors' => false // disable throwing exceptions on HTTP errors
            ]);
            // $response = json_decode($result->getBody()->getContents(), false);
            $response = $result->getBody()->getContents();
        } catch(RequestException $e) {
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
    public function DeleteConversation(string $conversation_id): mixed
    {
        $headers = [
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->delete("https://api.elevenlabs.io/v1/convai/conversations/$conversation_id", [
                "headers" => $headers,
                'http_errors' => false // disable throwing exceptions on HTTP errors
            ]);

            $response = $result->getBody()->getContents();
        } catch(\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Get a Elevenlabs signed url to start a conversation with an agent that requires authorization
     * 
     * @param string $agent_id the agent id
     * @return object the response object
     */
    public function GetSignedURL(string $agent_id): object
    {
        $headers = [
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversation/get-signed-url?agent_id=$agent_id", [
                "headers" => $headers,
                'http_errors' => false // disable throwing exceptions on HTTP errors
            ]);
            $response = json_decode($result->getBody()->getContents(), false);
        } catch(\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Get a WebRTC session token for real-time communication
     * 
     * @param string $agent_id the agent id
     * @param string $participantName optional custom participant name if not provided user id will be used
     * @return object the response object
     */
    public function GetConversationToken(string $agent_id, ?string $participantName): object
    {
        $headers = [
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversation/token", [
                "headers" => $headers,
                "query" => [
                    'agent_id' => $agent_id,
                    'participant_name' => $participantName
                ],
                'http_errors' => false // disable throwing exceptions on HTTP errors
            ]);
            $response = json_decode($result->getBody()->getContents(), false);
        } catch(\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Send the feedback for the given conversation
     * 
     * @param string the conversation id
     * @param string the feedback, either 'like' or 'dislike'
     * @return object the response object
     */
    public function SendConversationFeedback(string $conversation_id, ?string $feedback):object
    {
        $headers = [
            "Content-Type" => "application/json",
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $body = json_encode(['feedback' => $feedback], JSON_UNESCAPED_UNICODE);

            $client = new Client();
            $result = $client->request('POST', "https://api.elevenlabs.io/v1/convai/conversations/$conversation_id/feedback", [
                'body' => $body,
                'headers' => $headers,
                'http_errors' => false // disable throwing exceptions on HTTP errors
            ]);
            $response = json_decode($result->getBody()->getContents(), false);
        } catch(\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Get a list of Elevenlabs conversations
     * 
     * @param array an array of list conversations options
     * @return object the response object
     */
    public function ListConversations(array $options):object
    {
        //  $options: (all optional)
        //
        //  ['cursor'] => string, used for fetching next page. Cursor is returned in ther response.
        //  ['agent_id'] => string, the id of the agent you're taking the action on.
        //  ['call_successful'] = string, the result of the success evalution.
        //  ['call_start_before_unix'] = number, unix timestamp (in seconds) to filter conversations up to this start date.
        //  ['call_start_after_unix'] = number, unix timestamp (in seconds) to filter conversations after to this start date.
        //  ['user_id'] = string, filter conversations by the user id who initiated them.
        //  ['page_size'] = number, how many conversations to return at maximum. Can not exceed 100, defaults to 30.
        //  ['summary_mode'] = string, whether to include transcript summaries in the response.


         $headers = [
            "xi-api-key" => $this->GetAuthKey()
        ];

        try {
            $client = new Client();
            $result = $client->get("https://api.elevenlabs.io/v1/convai/conversations", [
                "headers" => $headers,
                "query" => $options,
                'http_errors' => false // disable throwing exceptions on HTTP errors
            ]);
            $response = json_decode($result->getBody()->getContents(), false);
        } catch(\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
