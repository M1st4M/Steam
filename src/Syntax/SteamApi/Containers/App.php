<?php namespace Syntax\SteamApi\Containers;

use Syntax\SteamApi\Collection;

class App extends BaseContainer {
	public $id;

	public $type;

	public $name;	

	public $age;

	public $dlc;

	public $controllerSupport;

	public $description;

	public $about;

	public $header;

	public $website;

	public $pcRequirements;
	
	public $linuxRequirements;

	public $macRequirements;

	public $languages;	

	public $legal;

	public $developers;

	public $publishers;

	public $price;

	public $platforms;

	public $metacritic;

	public $categories;

	public $images;

	public $genres;

	public $release;

	public function __construct($app)
	{
		$this->id                 = $app->steam_appid;
		$this->type               = $app->type;
		$this->name               = $app->name;
		$this->age                = $app->required_age;
		$this->fullgame           = $this->checkIssetField($app, 'fullgame', 'None');
		$this->dlc                = $this->checkIssetField($app, 'dlc', 'None');
		$this->controllerSupport  = $this->checkIssetField($app, 'controller_support', 'None');
		$this->description        = $app->detailed_description;
		$this->about              = $app->about_the_game;
		$this->header             = $app->header_image;
		$this->website            = $this->checkIsNullField($app, 'website', 'None');
		$this->pcRequirements     = $app->pc_requirements;
		$this->linuxRequirements  = $this->checkIssetField($app, 'linux_requirements', '');
		$this->macRequirements    = $this->checkIssetField($app, 'mac_requirements', '');
		$this->languages	  = $this->checkIssetField($app, 'supported_languages', 'Unknown');			
		$this->legal              = $this->checkIssetField($app, 'legal_notice', 'None');
		$this->developers         = $this->checkIssetCollection($app, 'developers');
		$this->publishers         = new Collection($app->publishers);
		$this->price              = $this->checkIssetField($app, 'price_overview', $this->getFakePriceObject());
		$this->platforms          = $app->platforms;
		$this->metacritic         = $this->checkIssetField($app, 'metacritic', $this->getFakeMetacriticObject());
		$this->categories         = $this->checkIssetCollection($app, 'categories');
		$this->images         	  = $this->checkIssetCollection($app, 'screenshots');
		$this->genres             = $this->checkIssetCollection($app, 'genres');
		$this->release            = $app->release_date;
	}

	protected function getFakeMetacriticObject()
	{
		$object        = new \stdClass();
		$object->url   = null;
		$object->score = '0';

		return $object;
	}

	protected function getFakePriceObject()
	{
		$object        		= new \stdClass();
		$object->initial 	= '0';
		$object->final 		= '0';

		return $object;
	}

}
