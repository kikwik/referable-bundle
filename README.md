KikwikReferableBundle
=======================

This bundle will save referer values in Doctrine 2 entities for symfony 4


Installation
------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require kikwik/referable-bundle
```

Configuration
-------------


Create the `config/packages/kikwik_referable.yaml` config file

```yaml
kikwik_referable:
    interfaces:
        CpcReferableInterface:
            cookie_name: 'r'
            query_params: ['r']
            expire: '+30 days'
        UtmReferableInterface:
            cookie_name: 'utm'
            query_params: [ 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content' ]
            expire: '+30 days'
```

Implements one or more interfaces in your classes and use the corresponding trait (Traits can be used only with query_params from the example above):

```php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kikwik\ReferableBundle\Model\CpcReferableInterface;
use Kikwik\ReferableBundle\Model\CpcReferableTrait;
use Kikwik\ReferableBundle\Model\HttpReferableInterface;
use Kikwik\ReferableBundle\Model\HttpReferableTrait;
use Kikwik\ReferableBundle\Model\UtmReferableInterface;
use Kikwik\ReferableBundle\Model\UtmReferableTrait;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, HttpReferableInterface, CpcReferableInterface, UtmReferableInterface
{
    use HttpReferableTrait;
    use CpcReferableTrait;
    use UtmReferableTrait;
    
    //...
}
```

Make migrations and update your database

```console
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
```

