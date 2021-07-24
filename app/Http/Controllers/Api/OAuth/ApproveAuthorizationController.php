<?php

namespace App\Http\Controllers\Api\OAuth;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\Bridge\User;
use Nyholm\Psr7\Response as Psr7Response;

class ApproveAuthorizationController extends \Laravel\Passport\Http\Controllers\ApproveAuthorizationController
{
    /**
     * Approve the authorization request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $this->assertValidAuthToken($request);

        $authRequest = $this->getAuthRequestFromSession($request);

        return  $this->convertJsonResponse(
                $this->server->completeAuthorizationRequest($authRequest, new Psr7Response)
            );
    }

    /**
     * Convert a PSR7 response to a Illuminate Response.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $psrResponse
     */
    public function convertJsonResponse($psrResponse)
    {
        if (isset($psrResponse->getHeaders()['Location'])) {
            $qs = (parse_url($psrResponse->getHeaders()['Location'][0]))['query'];
            parse_str($qs, $params);

            return new JsonResponse(
                $params,
            );
        }

        return new Response(
            $psrResponse->getBody(),
            $psrResponse->getStatusCode(),
            $psrResponse->getHeaders()
        );
    }
}
