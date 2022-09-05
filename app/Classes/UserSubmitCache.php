<?php
class UserSubmitCache {
    public $cache = [];
    public $cacheFilePath = ConfigRoutes::STORAGE . 'submitCache.json';

    public function __construct() 
    {
        if (!file_exists($this->cacheFilePath)) {
            throw new Exception('File Cache not found', 500);
        }
        $this->cache = $this->getCache();
        $this->cache = $this->refreshCache();
    }

    public function getCache() : array
    {
        $cache = json_decode(file_get_contents($this->cacheFilePath), true);
            if (is_array($cache)) {
                return $cache;
            } else {
                return [];
            }
    }

    public function refreshCache() : array
    {
        $cache = [];
        foreach ($this->cache as $key => $value) {
            if ($value['time'] > time() - 60) {
                $cache[$key] = $value;
            }
        }
        $this->cache = $cache;
        $this->saveCacheFile();
        return $cache;
    }

    public function saveCacheFile() : void
    {
        file_put_contents($this->cacheFilePath, json_encode($this->cache, JSON_PRETTY_PRINT));
    }

    public function appendCache(int $time, string $session) : void
    {
        array_push($this->cache, ['time' => $time, 'session' => $session]);
        $this->saveCacheFile();
    }

    public function countSessionSubmissions(string $session) : int
    {
        $count = 0;
        foreach ($this->cache as $key => $value) {
            if ($value['session'] === $session) {
                $count++;
            }
        }
        return $count;
    }
}
?>