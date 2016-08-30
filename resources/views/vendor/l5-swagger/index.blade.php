<?php

if (app()->environment() != 'testing') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
}

?>

        <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{config('l5-swagger.api.title')}}</title>
        <link rel="icon" type="image/png" href="{{config('l5-swagger.paths.assets_public')}}/images/favicon-32x32.png" sizes="32x32"/>
        <link rel="icon" type="image/png" href="{{config('l5-swagger.paths.assets_public')}}/images/favicon-16x16.png" sizes="16x16"/>
        <link href='{{config('l5-swagger.paths.assets_public')}}/css/typography.css' media='screen' rel='stylesheet' type='text/css'/>
        <link href='{{config('l5-swagger.paths.assets_public')}}/css/reset.css' media='screen' rel='stylesheet' type='text/css'/>
        <link href='{{config('l5-swagger.paths.assets_public')}}/css/screen.css' media='screen' rel='stylesheet' type='text/css'/>
        <link href='{{config('l5-swagger.paths.assets_public')}}/css/reset.css' media='print' rel='stylesheet' type='text/css'/>
        <link href='{{config('l5-swagger.paths.assets_public')}}/css/print.css' media='print' rel='stylesheet' type='text/css'/>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery-1.8.0.min.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery.slideto.min.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery.wiggle.min.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jquery.ba-bbq.min.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/handlebars-2.0.0.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/underscore-min.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/backbone-min.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/swagger-ui.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/highlight.7.3.pack.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/jsoneditor.min.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/marked.js' type='text/javascript'></script>
        <script src='{{config('l5-swagger.paths.assets_public')}}/lib/swagger-oauth.js' type='text/javascript'></script>

        <style>
            .top_button {
                display: block;
                text-decoration: none;
                font-weight: bold;
                padding: 6px 8px;
                font-size: 0.9em;
                color: white!important;
                background-color: #547f00;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                -o-border-radius: 4px;
                -ms-border-radius: 4px;
                -khtml-border-radius: 4px;
                border-radius: 4px;
            }
        </style>

        <!-- Some basic translations -->
        <!-- <script src='lang/translator.js' type='text/javascript'></script> -->
        <!-- <script src='lang/ru.js' type='text/javascript'></script> -->
        <!-- <script src='lang/en.js' type='text/javascript'></script> -->

        <script type="text/javascript">
            $(function () {
                var url = window.location.search.match(/url=([^&]+)/);
                if (url && url.length > 1) {
                    url = decodeURIComponent(url[1]);
                } else {
                    url = "{!! $urlToDocs !!}";
                }

                // Pre load translate...
                if (window.SwaggerTranslator) {
                    window.SwaggerTranslator.translate();
                }
                window.swaggerUi = new SwaggerUi({
                    url: url,
                    dom_id: "swagger-ui-container",
                    @if(array_key_exists('validatorUrl', get_defined_vars()))
                    // This differentiates between a null value and an undefined variable
                    validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
                    @endif
                    supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
                    onComplete: function (swaggerApi, swaggerUi) {
                        @if(isset($requestHeaders))
                            @foreach($requestHeaders as $requestKey => $requestValue)
                                window.swaggerUi.api.clientAuthorizations.add("{{$requestKey}}", new SwaggerClient.ApiKeyAuthorization("{{$requestKey}}", "{{$requestValue}}", "header"));
                        @endforeach
                                @endif

                        if (window.SwaggerTranslator) {
                            window.SwaggerTranslator.translate();
                        }

                        $('pre code').each(function (i, e) {
                            hljs.highlightBlock(e)
                        });
                    },

                    onFailure: function (data) {
                        console.log("Unable to Load SwaggerUI");
                    },
                    docExpansion: {!! isset($docExpansion) ? '"' . $docExpansion . '"' : '"none"' !!},
                    jsonEditor: false,
                    apisSorter: "alpha",
                    defaultModelRendering: 'schema',
                    showRequestHeaders: false
                });

                function addOAuthAuthorization() {
                    if (typeof initOAuth == "function") {
                        initOAuth({
                            clientId: $('#input_clientId')[0].value,
                            clientSecret: $('#input_clientSecret')[0].value,
                            realm: "your-realms",
                            appName: "Swagger",
                            scopeSeparator: " ",
                            additionalQueryStringParams: {}
                        });
                    }
                }

                function saveOAuthCreds() {
                    if ($('#input_clientId')[0].value == '') {
                        localStorage.removeItem('swagger-clientId');
                    } else {
                        localStorage.setItem('swagger-clientId', $('#input_clientId')[0].value);
                    }

                    if ($('#input_clientSecret')[0].value == '') {
                        localStorage.removeItem('swagger-clientSecret');
                    } else {
                        localStorage.setItem('swagger-clientSecret', $('#input_clientSecret')[0].value);
                    }
                }

                $('#input_clientId').change(function () {
                    addOAuthAuthorization();
                });

                $('#input_clientSecret').change(function () {
                    addOAuthAuthorization();
                });

                $('#save-oauth').click(function (e) {
                    e.preventDefault();
                    saveOAuthCreds();
                });

                $('#clear-oauth').click(function (e) {
                    e.preventDefault();
                    $('#input_clientId')[0].value = '';
                    $('#input_clientSecret')[0].value = '';
                    saveOAuthCreds();
                    addOAuthAuthorization();
                });

                if (localStorage.getItem('swagger-clientId') !== null) {
                    $('#input_clientId')[0].value = localStorage.getItem('swagger-clientId');
                    addOAuthAuthorization();
                }

                if (localStorage.getItem('swagger-clientSecret') !== null) {
                    $('#input_clientSecret')[0].value = localStorage.getItem('swagger-clientSecret');
                    addOAuthAuthorization();
                }

                window.swaggerUi.load();
            });
        </script>
    </head>

    <body class="swagger-section">
        <div id='header'>
            <div class="swagger-ui-wrap">
                <a id="logo" href="http://swagger.io">swagger</a>
                <form id='api_selector'>
                    <div class='input'><input placeholder="client id" id="input_clientId" name="clientId" type="text"/></div>
                    <div class='input'><input placeholder="client secret" id="input_clientSecret" name="clientSecret" type="text"/></div>
                    <div class='input'><a id="save-oauth" class="top_button" href="#">Save OAuth</a></div>
                    <div class='input'><a id="clear-oauth" class="top_button" href="#">Clear OAuth</a></div>
                </form>
            </div>
        </div>

        <div id="message-bar" class="swagger-ui-wrap" data-sw-translate>&nbsp;</div>
        <div id="swagger-ui-container" class="swagger-ui-wrap"></div>
    </body>
</html>
