<?php namespace App\Http\Middleware;

use App\Gaia\LocaleSwitcher;

use Closure;

class SwitchLocale {

    protected $localeSwitcher;

    function __construct(LocaleSwitcher $localSwitcher)
    {
        $this->localeSwitcher = $localSwitcher;
    }


    /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        //Always set locale to english for admin:
        if(strrpos($request->getRequestUri(),"/admin") === 0){
            $this->localeSwitcher->switchLocale('en');
            return $next($request);
        }

        $this->localeSwitcher->setAppLocale();
		return $next($request);
	}

}
