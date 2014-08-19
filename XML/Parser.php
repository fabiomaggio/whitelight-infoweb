<?php
namespace Infoweb\XML;

class Parser
{
    
    /**
     * @var string The XML file
     */
    public $file = '';
    
    /**
     * Creates a new instance of the parser.
     * 
     * @param   string      $file       The XML file
     * @throws  Exception               In case the XML file does not exist
     */
    public function __construct($file)
    {
        // Check if the provided file exists
        if (!is_file($file))
            throw new \Exception("The file \"{$file}\" does not exist");
        
        $this->file = $file;
    }
    
    /**
     * Parses the XML file.
     * The file is parsed into an object and returned.
     * 
     * @return  object
     * @throws  Exception               In case the XML file can not be loaded
     * @uses    \Infoweb\XML\Reader
     */
    public function parse()
    {                
        $doc = new \DOMDocument;
        $doc->preserveWhiteSpace = false;
        
        if (!$doc->load($this->file))
            throw new \Exception("the file \"{$file}\" can not be loaded");    
        
        return $this->read($doc);
    }
    
    /**
     * Reads the provided DOMDocument into an object
     * 
     * @param   DOMDocument $doc
     * @return  object
     */
    protected function read($doc)
    {
        // Create an xml reader
        $reader = new \Infoweb\XML\Reader($doc);
        
        $data = new \stdClass;
        
        // Read the mainTitle
        $data->mainTitle = $reader->mainTitle();
        
        // Read the menuItems
        $data->menuItems = $reader->menuItems();
        
        return $data; 
    }    
}