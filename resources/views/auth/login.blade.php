<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ATLauncher Login</title>

        <link href="/css/login.css" rel="stylesheet">
    </head>
    <body>
        <h1 class="logo" data-js="logo">
            <a href="/">
                <span></span>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 312 362.3" enable-background="new 0 0 312 362.3" xml:space="preserve" class="cdunn">
                    <polygon fill="#3B3B3B" points="156,0 207.5,30 51.5,120.3 0,90.5 "/>
                    <polygon fill="#3B3B3B" points="172.5,70 224.3,40 312,91.3 259.8,120.3 "/>
                    <polygon fill="#2E2E2E" points="0,90.5 0,271.8 156,362.3 156,302.5 51.8,241.8 51.5,120.3 "/>
                    <polygon fill="#333333" points="312,271 156,362.3 156,302.5 260,242 259.8,120.3 312,91.3 "/>
                    <polygon fill="#89C236" points="259.8,120.3 156,178.8 156,210 196.5,186.8 196.5,279 222.7,263.7 222.7,171.3 259.8,149.5 "/>
                    <g>
                        <g>
                            <path fill="#78AB2F" d="M51.5,120.3l0.3,121.5l28.8,17v-37.5l43.6,25v37.6l31.9,18.6V178.8L51.5,120.3z M124,220.5l-43-24.8v-28.3
			l43,24V220.5z"/>
                        </g>
                    </g>
                </svg>
            </a>
        </h1>

        <div class="login-page">
            @if (count($errors) > 0)
                <div class="error display-message">
                    <h2>Error</h2>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="form">
                <form role="form" method="POST" action="{{ url('/register') }}" class="register-form">
                    <input type="text" name="username" placeholder="username"/>
                    <input type="email" name="email" placeholder="email"/>
                    <input type="password" name="password" placeholder="password"/>
                    <input type="password" name="password_confirmation" placeholder="confirm password"/>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button>create</button>

                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                </form>
                <form role="form" method="POST" action="{{ url('/login') }}" class="login-form">
                    <input type="text" name="username" placeholder="username"/>
                    <input type="password" name="password" placeholder="password"/>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button>login</button>

                    <p class="message">Not registered? <a href="#">Create an account</a></p>
                </form>
            </div>
        </div>

        <script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
        <script src="/js/login.js"></script>
    </body>
</html>