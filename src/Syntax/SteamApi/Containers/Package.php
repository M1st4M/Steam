<?php 
namespace Syntax\SteamApi\Containers;

use Syntax\SteamApi\Collection;

class Package extends BaseContainer {
	
	public $id;
	public $name;
	public $apps;
	public $page_content;	
	public $header;
	public $page_image;
	public $price;
	public $platforms;
	public $release;

	public function __construct($package)
	{
		$this->name               = $package->name;
		$this->apps               = $package->apps;
		$this->page_content 	  = $this->checkIssetField($package, 'page_content', 'none');		
		$this->small_logo         = $this->checkIssetField($package, 'small_logo', 'none');
		$this->header             = $this->checkIssetField($package, 'header_image', 'none');
		$this->page_image         = $this->checkIssetField($package, 'page_image', 'none');
		$this->price              = $this->checkIssetField($package, 'price_overview', $this->getFakePriceObject());
		$this->platforms          = $package->platforms;
		$this->release            = $package->release_date;
	}

	protected function getFakePriceObject()
	{
		$object        		= new \stdClass();
		$object->initial 	= '0';
		$object->final 		= '0';
		$object->individual = '0';

		return $object;
	}

}
