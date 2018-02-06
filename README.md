# Bikroy.com scraper
## Requirements
PHP version 5.4.0 or higher

## Installation with composer
It is also possible to install library via composer

`composer require mahedimaruf/bikroy`

## Example usage
```require_once 'vendor/autoload.php';

// import goutte
use Goutte\Client;

// Create new goutte client
$bot = new Client();

//Initialize a Instance "bikroy" class
$bikroy = new Mahedimaruf\Bikroy($bot);
$city = 'dhaka';

// Pass the city to start_page method.It will return the first ad list page link to start scraping
$nextlink = $bikroy->start_page($city);
while ($nextlink) {

//Pass page link. It will return an array with all the name and phone numbers from the ad list page and a link to next page.
    $results = $bikroy->scrap($nextlink);
    var_dump($results['details']);
		
		//Set next page link. So script it continue scraping until there is no next link!
    $nextlink = $results['nextlink'];
}
```

### Enjoy. Just don't abuse too much
