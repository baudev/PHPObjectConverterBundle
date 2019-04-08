# PHPObjectConverterBundle

[![GitHub release](https://img.shields.io/github/release/baudev/PHPObjectConverterBundle.svg)](https://github.com/baudev/PHPObjectConverterBundle/releases)
[![PHP MINIMUM VERSION](https://img.shields.io/badge/dynamic/json.svg?url=https://raw.githubusercontent.com/baudev/PHPObjectConverterBundle/master/composer.json&label=PHP&query=$.require.php)]()
![LICENSE](https://img.shields.io/github/license/mashape/apistatus.svg)

This Symfony bundle converts PHP objects into ones of different languages.

## Installation

### Download the Bundle

```
composer require baudev/php-object-converter-bundle
```

*This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.*

### Enable the Bundle

- If you're using Flex:

The bundle is automatically enabled :tada:

- If you're not using Flex:

You must add the bundle to your kernel:


```php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new Baudev\PHPObjectConverterBundle\PHPObjectConverterBundle(),
        ];

        // ...
    }

    // ...
}
```

## How to use this Bundle?

Use the following command to convert your PHP classes:

```
bin/console converter:generate converter source [output]
```

The command parameters are the following ones:

| Parameter  | Details |
| ------------- | ------------- |
| converter **(required)** | Name of a converter. E.g. `typescript`. [See available converters.](#available-converters)  |
| source **(required)**  | The directory containing classes to scan.  |
| output *(optional)*  | The output directory for generated classes.  |

### Available Converters

| Name  | Converter file |
| ------------- | ------------- |
| `typescript` | `Entity/converters/TypeScriptConverter.php`  |
| More soon! | ...  |

You can create your own converter as explained [here](https://github.com/baudev/PHPObjectConverterBundle/wiki/Create-a-Converter).

## Demo

This example uses the `typescript` converter. It is the result of the follwing command `bin/console converter:generate typescript src build`.

Input class:

```php
// src/Entity/Person.php
class Person extends \App\Kernel
{
    /**
     * @var iterable
     */
    public static $firstName;
    /**
     * @var string
     */
    protected $lastName;
    /**
     * @var int
     */
    private $age;
}
```

Output class:

```typescript
// build/Person.ts
class Person extends Kernel 
{

    public static firstName:any;

    protected lastName:string;

    private age:number;

}
```

## Settings

Soon...

## TODO

- [ ] Write **Settings** documentation part.
- [ ] Write tests.
- [ ] Support interfaces and methods conversion.
- [ ] Add more converters.


## Credits

- [PHP Parser](https://github.com/nikic/php-parser)
- [TypeScriptGeneratorBundle](https://github.com/janit/TypeScriptGeneratorBundle)

## LICENSE

```
MIT License  
  
Copyright (c) 2019 Baudev
  
Permission is hereby granted, free of charge, to any person obtaining a copy  
of this software and associated documentation files (the "Software"), to deal  
in the Software without restriction, including without limitation the rights  
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell  
copies of the Software, and to permit persons to whom the Software is  
furnished to do so, subject to the following conditions:  
  
The above copyright notice and this permission notice shall be included in all  
copies or substantial portions of the Software.  
  
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR  
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,  
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE  
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER  
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,  
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE  
SOFTWARE.  
```
