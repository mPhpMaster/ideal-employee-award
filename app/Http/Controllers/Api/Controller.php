<?php

namespace App\Http\Controllers\Api;

use App\Traits\HttpResponses;
use App\Traits\TAuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *
 */
class Controller extends BaseController
{
    use TAuthorizesRequests, DispatchesJobs, ValidatesRequests, HttpResponses;

    /**
     * false? you need to write this code in each controller method : `$this->authorize('[permission name]', [model instance|class]);`
     * true? no need to write this code in controller *__construct* method (but you can) : `$this->registerResourceAuthorization([model class], [route parameter name], [controller options], [request]);`
     *
     * @type bool
     */
    const AUTO_AUTHORIZES_METHODS = true;

    public function __construct() {
        $this->initializeTAuthorizesRequests();
    }
}
