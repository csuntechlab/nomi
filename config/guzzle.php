<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication credentials for all default Guzzle requests
    |--------------------------------------------------------------------------
    |
    | These are the authentication credentials that will be used for all
    | default Guzzle requests. These values will only be consulted when
    | resolving a HandlerGuzzle instance from the HandlerGuzzleFactory class.
    | It will not affect HandlerGuzzle objects that have been instantiated
    | directly.
    |
    | If either the username or password have been provided and are non-empty
    | then the authentication credentials will be set.
    |
    */
    'auth' => [

        'username' => env("GUZZLE_AUTH_USERNAME", null),

        'password' => env("GUZZLE_AUTH_PASSWORD", null),

        // use HTTP Basic Authentication if the method has not been specified
        'method' => env("GUZZLE_AUTH_METHOD", null),

    ],

    /*
    |--------------------------------------------------------------------------
    | Base URI for all default Guzzle requests
    |--------------------------------------------------------------------------
    |
    | This is the base URI that will be used for all default Guzzle requests.
    | This value is only consulted when resolving a HandlerGuzzle instance from
    | the HandlerGuzzleFactory class. It will not affect HandlerGuzzle objects
    | that have been instantiated directly.
    |
    | Default is null.
    |
    */
    'base_uri' => env("GUZZLE_BASE_URI", null),

    /*
    |--------------------------------------------------------------------------
    | Should Guzzle return a JSON response body as an associative array?
    |--------------------------------------------------------------------------
    |
    | Should Guzzle return a JSON response body as an associative array when
    | using the resolveResponseBody() method in HandlerGuzzle?
    | 
    | The default in Guzzle 5.x was to return a response body as an associative
    | array using the json() response method. Guzzle 6.x does not have a json()
    | response method so this can be set to true in order to maintain the
    | original functionality.
    |
    | Default is false (i.e. return the JSON response as a StdClass instance).
    |
    */
    'json_assoc_array' => env("GUZZLE_JSON_ASSOC_ARRAY", false),

	/*
    |--------------------------------------------------------------------------
    | Should Guzzle verify the server certificate for HTTPS requests?
    |--------------------------------------------------------------------------
    |
    | Should Guzzle verify the server certificate during HTTPS requests? This
    | typically requires the CA cert of the server's chain to be installed on
    | the machine performing the Guzzle request.
    |
    | During development, this can be set to false safely. You may also want to
    | set this to false when using WAMP since WAMP tends to have issues with
    | Guzzle when attempting to verify the server certificate.
    |
    | Default is true.
    |
    */
    'verify_cert' => env("GUZZLE_VERIFY_CERT", true),

];