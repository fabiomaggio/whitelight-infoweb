<?php
namespace Infoweb\XML;

class Reader
{
    
    /**
     * @var DOMDocument The parsed XML file
     */
    public $doc = '';
    
    /**
     * @var DOMXpath    The DOMXpath object that is used to navigate the DOMDocument
     */
    protected $xpath = null;
    
    /**
     * Creates a new instance of the reader.
     * 
     * @param   DomDocument $doc        The DomDocument
     * @throws  Exception               In case the file is no instance of DOMDocument
     */
    public function __construct($doc)
    {
        // Check if the provided document is an instance of DOMDocument
        if (!$doc instanceof \DOMDocument)
            throw new \Exception('Invalid DOMDocument');
        
        $this->doc = $doc;
        
        // Use the document to load the DOMXpath object
        $this->xpath = new \DOMXPath($doc);
    }
    
    /**
     * Returns the value of the main title tag
     * 
     * @return  string
     */
    public function mainTitle()
    {
        // Query the title tag in the document
        $title = $this->xpath->query('//data/title');

        return (!$title) ? '' : $title->item(0)->nodeValue;
    }
    
    
    public function menuItems()
    {
        $menuItems = $this->xpath->query('//menuItem');
        
        return $menuItems;    
    }    
}