<?php

declare(strict_types=1);

use coreylang\ElevenLabsAI\Auth;
use coreylang\ElevenLabsAI\ElevenLabs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class BatchCalling extends ElevenLabs
{
    use Auth;

    /**
     *  Submit batch calling a job
     * 
     * @param array batch job options
     * @return object a response object
     */
    public function SubmitBatchCallingJob(array $args = []):object
    {
        if (empty($args['call_name']))
            $response = $this->ReturnErrorResponse('call_name is required.');
        if (empty($args['agent_id']))
            $response = $this->ReturnErrorResponse('agent_id is returned.');
        if (empty($args['agent_phone_number_id']))
            $response = $this->ReturnErrorResponse('agent_phone_number_id is required.');
        if (empty($args['scheduled_time_unix']))
            $response = $this->ReturnErrorResponse('scheduled_time_unix is required.');
        if (empty($args['recipients'])
            || !is_array($args['recipients'])
        )
            $response = $this->ReturnErrorResponse('recipients is required, and must be an array.');

        if (!isset($response)) {
            $headers = array(
                "Content-Type" => "application/json",
                "xi-api-key" => $this->GetAuthKey()
            );

            try {
                $client = new Client();
                $result = $client->post("https://api.elevenlabs.io/v1/convai/batch-calling/submit", [
                    "headers" => $headers,
                    "json" => $args,
                    "http_errors" => false // disable throwing exceptions on HTTP errors
                ]);
                $response = json_decode($result->getBody()->getContents(), false);
            } catch(\Exception $e) {
                $response = $e->getMessage();
            }
        }

        return $response;
    }
}