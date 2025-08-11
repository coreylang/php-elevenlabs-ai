<?php

declare(strict_types=1);

namespace coreylang\ElevenLabsAI;

/**
 *  
 * 
 */

trait Auth {

    private string $apiKey;

    public function SetAuthKey(?string $apiKey):void {
        $this->apiKey = $apiKey;
    }

    private function GetAuthKey():string {
        return $this->apiKey;
    }
}


class ElevenLabs {
    use Auth;
}
