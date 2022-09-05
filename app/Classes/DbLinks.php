<?php
class DbLinks {
    public $db = [];
    private $linksFilePath = ConfigRoutes::STORAGE . 'links.json';
    const JSON_SAMLPE = 
    [
        "original_link" => null,
        "short_link" => null,
        "created_at" => null,
        "clicked" => null,
        "created_by" => null,
    ];
    
    public function __construct() 
    {
        if (!file_exists($this->linksFilePath)) {
            throw new Exception('File Links not found', 500);
        }
        $this->db = $this->getLinksFromFile();
    }
    
    public function getLinksFromFile() : array
    {
        $file = file_get_contents($this->linksFilePath);
        $file = json_decode($file, true);
        if (is_array($file)) {
            return $file;
        }
        return [];
    }
    
    public function getLinkIndex($shortLink) : int|bool
    {
        return array_search($shortLink, array_column($this->db, 'short_link'));
    }
    
    public function clicked($index) : void
    {
        $this->db[$index]['clicked']++;
    }
    
    public function addLink(string $originalLink, string $shortLink, string $createdBy) : void
    {
        $link = self::JSON_SAMLPE;
        $link['original_link'] = $originalLink;
        $link['short_link'] = $shortLink;
        $link['created_at'] = time();
        $link['clicked'] = 0;
        $link['created_by'] = $createdBy;
        array_push($this->db, $link);
        $this->writeLinksToFile();
    }
    
    public function writeLinksToFile() : void
    {
        $file = json_encode($this->db, JSON_PRETTY_PRINT);
        file_put_contents(ConfigRoutes::STORAGE . 'links.json', $file);
    }

    public function __destruct()
    {
        $this->writeLinksToFile();
    }

    public function getLastSixRecords() : array
    {
        return array_slice($this->db, -6, 6, true);
    }
    
}
?>