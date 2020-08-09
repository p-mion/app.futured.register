<?php

namespace CashRegister\Router;

use CashRegister\Controller\ServiceController;
use CashRegister\Request\ApiRequest;
use Router;
use Response;

class ApiRouter extends Router
{

    protected $version = 'v1';

    /**
     * @return Response
     */
    public function response(ApiRequest $request)
    {

        if ($this->access($request)) {

            if ($this->version !== $request->getParameter('version')) {

                $response = new Response();
                $response->forbidden('ap version mismatch');
                return $response;
            }


            $controller = new ServiceController();

            if (!$request->getParameter('register_id')) {

                $response = new Response();
                $response->notFound('register not found');

            } else {


                switch ($request->getMethod()) {

                    case 'GET':
                    case 'HEAD':

                        if (!$request->hasParameter('bill')) {

                            $response = $controller->summary($request);

                        } else {

                            if ($request->hasParameter('bill_id')) {

                                $response = $controller->get($request);
                            } else {

                                $response = $controller->all($request);
                            }
                        }
                        break;
                    case 'POST':

                        $response = $controller->post($request);
                        break;

                    case 'DELETE':

                        $response = $controller->delete($request);
                        break;
                    default:

                        $response = new Response();
                        $response->notFound('service router action empty');
                }
            }
            return $response;
        }

        return ( new Response() )->forbidden('access denied');
    }

    /**
     * @return bool
     */
    public function access(ApiRequest $request)
    {

        return $request->getHeader('X-Token') === env('API_TOKEN');
    }

}
