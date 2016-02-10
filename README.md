# Parse Bundle

## Introduction

This bundle provides integration for [Parse.com PHP SDK](https://github.com/ParsePlatform/parse-php-sdk) in your Symfony2 Project.

As I currently don't use other Parse.com tools, I've only implemented [Push notifications](https://parse.com/docs/php/guide#push-notifications). You're free to contribute to add other tools.

## Changelog

**1.1.0**

- Allow to schedule a push (2 weeks maximum in advance due to [Parse.com limitations](https://www.parse.com/docs/php/guide#push-notifications-scheduling-pushes))

**1.0.0**

- Allow to send push to channel or a ParseQuery

## Installation

### Install GpatonParseBundle

Simply run assuming you have installed composer.phar or composer binary:

    $ php composer.phar require gpaton/parse-bundle 1.1.*

### Enable the bundle

Finally, enable the bundle in the kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Gpaton\ParseBundle\GpatonParseBundle(),

        );
    }


## Push Notifications

### Setting up


First, you need to configure the bundle with the keys obtained when you've created your application on [Parse.com](http://www.parse.com) :
	
	# app/config/config.yml

	gpaton_parse:
    	app_id: APPLICATION_ID
    	rest_key: REST_KEY
    	master_key: MASTER_KEY

### Usage

Then, you may send push notifications from your controller by loading the service `gpaton.parse.push` and use the `send` method :

    <?php
    // Acme\DemoBundle\Controller\PushController
    
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class PushController extends Controller {

        public function indexAction() {

            $push = $this->get('gpaton.parse.push');

			$data = ['alert' => 'Hi there !'];
			$channels = ['My Channel'];

            $push->send($data, $channels);

            // ...
        }
    }

The `send` method takes up to 4 arguments. First is mandatory and you must supply at least second **or** third argument :

1. data array

2. Channels array *(optional)*

3. ParseQuery *(optional)*

4. pushTime \DateTime *(optional)*


If you want to send your push to channel(s), just follow the previous sample.
To push to Query, you will use the `createQuery` method :

    <?php
    // Acme\DemoBundle\Controller\PushController
    
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class PushController extends Controller {

        public function indexAction() {

            $push = $this->get('gpaton.parse.push');

			$data = ['alert' => 'Hi there !'];
			$query = $push->createQuery();
			$query->equalTo('foo', 'bar');

            $push->send($data, null, $query);

            // ...
        }
    }

If you want to schedule your Push in advance (2 weeks maximum due to Parse.com limitation) : 

    <?php
    // Acme\DemoBundle\Controller\PushController
    
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class PushController extends Controller {

        public function indexAction() {

            $push = $this->get('gpaton.parse.push');

			$data = ['alert' => 'Hi there !'];
			$query = $push->createQuery();
			$query->equalTo('foo', 'bar');
			$scheduledTime = new \DateTime();
			$scheduledTime->modify('+5 days');

            $push->send($data, null, $query, $scheduledTime);

            // ...
        }
    }
  

## License

This bundle is under GPL v2 license. See the complete license in the bundle:

    Resources/meta/LICENSE