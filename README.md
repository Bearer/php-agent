# Bearer PHP Agent

[![Build Status](https://build.bearer.tech/api/badges/Bearer/php-agent/status.svg)](https://build.bearer.tech/Bearer/php-agent)

## Requirements

**PHP:** ^5.6

**Extensions:**
- [cURL](https://www.php.net/manual/en/book.curl.php)
- [JSON](https://www.php.net/book.json)
- [Stream](https://www.php.net/manual/en/intro.stream.php)


# Supported

The Bearer PHP Agent supports any cURL request (single and multiples) and:
- [Symfony HttpClient](https://github.com/symfony/http-client)
- [Guzzle](https://github.com/guzzle/guzzle)

## Installation

From a terminal, install the Bearer agent module and save it into your project:

```bash
composer require bearer/php-agent
```

Now, open your application main script (e.g. `index.php`) and initialize the Bearer agent at the top:

```php
require_once __DIR__ . '/vendor/autoload.php';

\Bearer\Agent::init([
    'secretKey' => 'YOUR_BEARER_SECRET_KEY'
]);
```

Your Secret Key is available on the [Bearer dashboard](https://app.bearer.sh/keys)

_Note: We strongly recommend to initialize the Bearer agent as early as possible. This ensures that all external HTTP requests performed from your application are monitored._

All API calls using CURL will be monitored and available on your Bearer dashboard.

For detailed configuration options check the [Agent's configuration page](https://php.docs.bearer.sh/).

## Keeping your data protected

We recommend you sanitize your data before sending it to the Bearer dashboard.
We think it's best to setup the sanitization level that best suits your needs.
An example using the default values is as follows:

```php
\Bearer\Agent::init([
  'stripSensitiveData' => true,
  'stripSensitiveKeys' => '/^authorization$|^client.id$|^access.token$|^client.secret$/i',
  'stripSensitiveRegex' => '[a-z0-9]{1}[a-z0-9.!#$%&’*+=?^_`{|}~-]+@[a-z0-9-]+(?:\\.[a-z0-9-]+)*'
]);
```

### Configuration options explained

- `stripSensitiveData` - Globally enable/disable data sanitization. It's enabled by default. If you set it to `false` no sanitization will take place, and all the data will be sent to the Bearer dashboard as-is.
- `stripsSensitiveKeys` - List of _key_ names regex patterns that will be applied to sanitize values in headers, query parameters or response body. If you specify `'stripSensitiveKeys' => '/^authorization$/'` the following sanitization actions would take place:

  - In headers: "authorization" header value will be sanitized and would be sent to the Bearer dashboard as "authorization: [FILTERED]"
  - In query string parameters: "authorization" query parameter value will be sanitized, and in the Bearer dashboard your URL will look like: "http://www.example.com/auth?authorization=[FILTERED]"
  - In application/json response body: Any value of "authorization" key in response payload will be replaced with "[FILTERED]" (e.g., { "name": "John", "authorization": "granted" } will be sent to the Bearer dashboard as { "name": "John", "authorization": "[FILTERED]" }

- `stripSensitiveRegex` - A regular expression that will be used to sanitize any _value_ in headers, query string parameters or response body. Bearer will check all the values sent in the request or response and will replace matching patterns with "[FILTERED]".

### FAQ

**Question:** My project uses the Symfony HttpClient, do I need to install the PHP cURL extension?

**Answer:** Yes, Bearer Agent only handles cURL requests so you need to enable the extension.
