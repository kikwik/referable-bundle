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
    
```


Implements `ReferableInterface` to your classes and use the `ReferableTrait`:

```php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kikwik\ReferableBundle\Model\ReferableInterface;
use Kikwik\ReferableBundle\Model\ReferableTrait;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, ReferableInterface
{
    use ReferableTrait;

    //...
}
```

Make migrations and update your database

```console
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
```

