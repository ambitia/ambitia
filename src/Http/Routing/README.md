
```
require_once __DIR__ . '/../vendor/autoload.php';
 
use Ambitia\Http\Routing\Router;
use Ambitia\Http\Input\Symfony\Request;
use Ambitia\Example\Test\IndexEntry;
use Ambitia\Http\Routing\FastRoute\FastRouteDispatcher;
use Ambitia\Http\Routing\MatchRoute;
use Ambitia\Http\Output\Response;
 
$router = new Router(new FastRouteDispatcher());
$router->route('GET', 'index', '/', [IndexEntry::class, 'index']);
 
$router->run(new Request(), new MatchRoute(), new Response());
```
