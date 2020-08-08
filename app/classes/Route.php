<?php


class Route
{
    protected $request;

    public function __construct(\Request $request)
    {
        $this->request = $request;
    }

    public function access()
    {

        return $this->request->getHeader('X-Token') === env('API_TOKEN');
    }

}
