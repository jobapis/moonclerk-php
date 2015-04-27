# Moonclerk PHP Client

This package makes it simple to integrate your application with Moonclerk's read
only API discussed [here](https://github.com/moonclerk/developer/blob/master/api/README.md).

## What's Moonclerk?

Moonclerk is a wrapper around Stripe's payment processor that allows you to easily 
set up recurring payments. Moonclerk will generate the forms and let you embed them
on your site or link to them directly that way payments are handled securely and
even non-technical people can update pricing, issue coupon codes, and check on 
payment statuses.

*Note: I am not affiliated with Moonclerk in any way; I just happen to use their
product.*

## Requirements

The following versions of PHP are supported.

* PHP 5.4
* PHP 5.5
* PHP 5.6
* PHP 7.0
* HHVM

## Usage

Please see [example.php](https://github.com/JobBrander/moonclerk-php/blob/master/example.php) for details.

## Install

Via Composer

``` bash
$ composer require jobbrander/moonclerk-php
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/jobbrander/moonclerk-php/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Karl Hughes](https://github.com/karllhughes)
- [All Contributors](https://github.com/jobbrander/moonclerk-php/contributors)


## License

The Apache 2.0. Please see [License File](https://github.com/jobbrander/moonclerk-php/blob/master/LICENSE) for more information.
