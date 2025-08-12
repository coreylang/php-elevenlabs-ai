<?php

declare(strict_types=1);

namespace coreylang\ElevenLabsAI;

trait Auth
{
    private string $apiKey;

    public function SetAuthKey(?string $apiKey):void
    {
        $this->apiKey = $apiKey;
    }

    private function GetAuthKey():string
    {
        return $this->apiKey;
    }
}

class ElevenLabs
{
    /**
     * Returns an API error response object.
     * 
     * @param object the message to be returned
     * @return object the response object
     */
    protected function ReturnErrorResponse(string $message):object
    {
        $response = new \stdClass();
        $response->message = $message;

        return $response;
    }
}
