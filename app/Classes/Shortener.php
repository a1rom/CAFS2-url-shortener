<?php
class Shortener {
    public $url = null;
    public $shortUri = null;
    public $createdBy = null;
    
    public function __construct (string $url, string $userSession)
    {
        $this->url = $url;
        $this->createdBy = $userSession;
    }

    public function getPingStatus () : bool
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_exec($ch);
        curl_close($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        if (str_starts_with($httpCode, 2) || str_starts_with($httpCode, 3)) {
            $this->url = $effectiveUrl;
            return true;
        }
        return false;
    }

    public function createShortUri () : void 
    {
        $randomStr = $this->generateRandomString(6);
        $this->shortUri = '/' . $randomStr;
    }

    public function generateRandomString(int $length = 6) : string
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomString;
    }
}
?>