<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	public function __construct()
    {
     
        parent::__construct();
 
        //Filters
        $class = get_called_class();
        switch($class) {
            case 'Home_Controller':
                $this->filter('before', 'auth')->only(array('logout'));
                $this->filter('before', 'nonauth');
                break;
            default:
                $this->filter('before', 'auth');
                break;
        }
    }

}