<?php namespace Laget\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laget\User;
use Laget\Classes\Stream;

class NugetRequest {
    /**
     * NugetRequest constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return null|User
     */
    public function getUser()
    {
        $apiKey = $this->request->header('X-Nuget-Apikey');

        if (empty($apiKey))
        {
            return null;
        }

        return User::fromApiKey($apiKey);
    }

    public function hasUploadedFile($name)
    {
        $data = array();
        new Stream($data);

        if (empty($data['file'][$name]))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getUploadedFile($name)
    {
        $data = array();
        new Stream($data);

        if (empty($data['file'][$name]))
        {
            return false;
        }

        return $data['file'][$name]['tmp_name'];
    }
}