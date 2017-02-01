<?php

namespace APIBundle\Controller\v1_0;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class AuthController extends Controller
{
  /**
   * In order to be able to carry out an API call a valid access token must be passed with each call. This call is used to retrieve an access token. This call supports 3 grant types: 'password', 'refresh_token', 'http://facebook.com'. Please note that access tokens expire within the given "expires_in" timeframe (expressed in seconds). Default this will be 86400 seconds (1 day), but this is subject to change. A refresh token will stay valid for up to 14 days (1209600 seconds).
   *
   * ---
   * ## Password grant type
   * The password grant type should be used when you wish to retrieve an access token for a classic username/password login. In this case the 'username' field should contain
   * the email address of the user so that this then becomes an email/password login. NOTE: the password provided in the password grant_type is the user's _plaintext_ password.
   *
   * ### POST Request - grant type 'password'
   *     {
   *         "client_id": "an_id",
   *         "client_secret": "an_id",
   *         "grant_type": "password",
   *         "username": "simon@bazookas.be",
   *         "password": "a password"
   *     }
   *
   * ## Refresh token grant type
   * The refresh token grant type is used to retrieve a new access token for an already logged in user.
   *
   * ### POST Request - grant type 'refresh_token'
   *     {
   *         "client_id": "an_id",
   *         "client_secret": "an_id",
   *         "grant_type": "refresh_token",
   *         "refresh_token": "a token"
   *     }
   *
   * ## Facebook grant type
   * The 'http://facebook.com' grant type is used to log a user in using their facebook ID and their facebook token. The facebook grant_type allows for 2 methods of authentication:
   *
   * - password based
   * - and token based
   *
   * A sample request is provided below, it is not necessary to send both a token and a password. However one of the fields must be present in order to be able to authenticate a user and to receive an access token.If both fields are provided the password field is authenticated first, if that fails the token is authenticated. _NOTE_: the authenticationhash returned as part of the profile response is the user's password which must be provided to authenticate a user using only their facebook id and hashed password.
   *
   * ### POST Request - grant type 'http://facebook.com'
   *     {
   *         "client_id": "1_4d7a7o1izigwwkkoswcc44sssk08ogkc8o40k0ogggowo4880s",
   *         "client_secret": "683rhpbvxf48cgk4sogkko0w84kogog8w804c0s4csg8w40ksg",
   *         "grant_type": "http://facebook.com",
   *         "fbid": "10157245183560612",
   *         "token": "bleh",
   *         "password": "$2y$13$RA9Yq8hz6F1ofeDuX90t5OLzUJAxwnXRPVAjf7HP/6Z7d7ifYCrl2"
   *     }
   *
   * ---
   * ## Possible API responses
   * ### HTTP 200: Successfull reponse ###
   *     {
   *       "access_token": "NDE5ZWY2ZDE5ZDM0YWE2OTAxNjVjYjA1Mjg3MmI2YjI0MDVjY2NkYmI2NjIyMWRkZDIwN2FhMjNmMzdiNjc2Zg",
   *       "expires_in": 86400,
   *       "token_type": "bearer",
   *       "scope": null,
   *       "refresh_token": "ZGRjMWQwMDU0NGFiYzM2N2Q4YzBkMzRiZDdmNGQ3ZjE2NTQyODIzYmQ0YjIwNzgxNmY1NWEyMDc0M2E1MzUyMA"
   *     }
   *
   * @ApiDoc(
   *  resource=true,
   *  description="POST new access token",
   *  requirements={},
   *  parameters={
   *  },
   *  statusCodes={
   *    200="Returned when successful",
   *    400="Missing or invalid parameter"
   *  },
   *  tags={
   *  }
   *)
   */
  public function tokenAction(Request $request) {
    //NOTE this function is also called from the createAccountAction in the AccountController

    //TODO we assume its json here
    $request->request->replace(json_decode($request->getContent(), true));

    //get a token using the OAuth server token
    $tokenController = $this->get('fos_oauth_server.controller.token');
    $response = $tokenController->tokenAction($request);

    //TODO
    //do something else here, maybe add stuff to the response?

    return $response;
  }
    
}
