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
        $title = $this->xpath->query('/data/title');

        return (!$title) ? '' : $title->item(0)->nodeValue;
    }
    
    /**
     * Returns the menu items
     * 
     * @return  array
     */
    public function menuItems()
    {
        // Query the menu items
        $nodes = $this->xpath->query('//menuItem');
        $menuItems = [];

        if (!$nodes)
            return $menuItems;
        
        // Create a menu item object for each node
        foreach ($nodes as $k => $node) {
            $menuIndex = $k + 1;
            $menuItem           = new \stdClass;
            $menuItem->title    = $this->xpath->query("//menuItem[{$menuIndex}]/title")->item(0)->nodeValue;
            $menuItem->text     = $this->xpath->query("//menuItem[{$menuIndex}]/text")->item(0)->nodeValue;
            $menuItem->pages    = $this->pages($menuIndex); 
            
            $menuItems[] = $menuItem;
        }
        
        return $menuItems;    
    }
    
    /**
     * Returns the pages for a specific menu item
     * 
     * @param   int     $menuIndex
     * @return  array
     */
    public function pages($menuIndex)
    {
        $nodes = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page");
        $pages = [];
        
        // Create a page object for each node
        foreach ($nodes as $k => $node) {
            $pageIndex = $k + 1;
            $page               = new \stdClass;
            $page->template     = $node->getAttribute('template');
            $page->paragraphs   = $this->pageParagraphs($menuIndex, $pageIndex);
            $page->pictures     = $this->pagePictures($menuIndex, $pageIndex);
            $page->link         = $this->pageLink($menuIndex, $pageIndex);
            
            $pages[] = $page;
        }
        
        return $pages;    
    }
    
    /**
     * Returns the paragraphs for a specific menu item and page
     * 
     * @param   int     $menuIndex
     * @param   int     $pageIndex
     * @return  array
     */
    public function pageParagraphs($menuIndex, $pageIndex)
    {
        $nodes = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/paragraphs/paragraph");
        $paragraphs = [];
        
        // Create a paragraph object for each node
        foreach ($nodes as $k => $node) {
            $paragraphIndex = $k + 1;
            $paragraph          = new \stdClass;
            $paragraph->title   = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/paragraphs/paragraph[{$paragraphIndex}]/title")->item(0)->nodeValue;
            $paragraph->text    = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/paragraphs/paragraph[{$paragraphIndex}]/text")->item(0)->nodeValue;
            
            $paragraphs[] = $paragraph;
        }
        
        return $paragraphs;    
    }
    
    /**
     * Returns the pictures for a specific menu item and page
     * 
     * @param   int     $menuIndex
     * @param   int     $pageIndex
     * @return  array
     */
    public function pagePictures($menuIndex, $pageIndex)
    {
        $nodes = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/pictures/picture");
        $pictures = [];
        
        // Create a picture object for each node
        foreach ($nodes as $k => $node) {
            $pictureIndex = $k + 1;
            $picture                = new \stdClass;
            $picture->file          = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/pictures/picture[{$pictureIndex}]/file")->item(0)->nodeValue;
            $picture->fileDetail    = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/pictures/picture[{$pictureIndex}]/fileDetail")->item(0)->nodeValue;
            $picture->title         = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/pictures/picture[{$pictureIndex}]/title")->item(0)->nodeValue;
            $picture->text          = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/pictures/picture[{$pictureIndex}]/text")->item(0)->nodeValue;
            
            $pictures[] = $picture;
        }
        
        return $pictures;    
    }

    /**
     * Returns the link for a specific menu item and page
     * 
     * @param   int     $menuIndex
     * @param   int     $pageIndex
     * @return  array
     */
    public function pageLink($menuIndex, $pageIndex)
    {
        $link = $this->xpath->query("//menuItem[{$menuIndex}]/pages/page[{$pageIndex}]/link/text");
        
        return (!$link->length) ? '' : $link->item(0)->nodeValue;   
    }   
}