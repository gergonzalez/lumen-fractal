# Lumen Fractal wrapper package

This package provides an easy way to use [Fractal](http://fractal.thephpleague.com/) in Lumen.

[Fractal](http://fractal.thephpleague.com/) provides a presentation and transformation layer for complex data output, the like found in RESTful APIs.

## Getting Started

### Prerequisites

* Lumen <= 5.4
* Lumen > 5.4 - Not tested yet

## Installation

Pull it via composer:

```bash
composer require gergonzalez/lumen-fractal
```

Once installed, register the service provider in your **bootstrap/app.php**

```php
//Register Service Providers

$app->register(Gergonzalez\Fractal\FractalServiceProvider::class);
```

## Usage

Implement your transformers, add a folder at **app/Http/Transformers** and put them there.

For example, **UserTransformer.php**:

```php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
    ];

    protected $defaultIncludes = [
    ];

    /**
     * Turn User object into a generic array.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
        ];
    }
}


```

And then, at your controller, if you are retrieven only one item:

```php

	use App\Http\Transformers\UserTransformer;

	class UserController extends Controller
	{

	    public function show(Request $request, $userId)
	    {
	        $user = User::findOrFail($userId);

	        return response()->json(app('fractal')->item($user, new UserTransformer())->getArray());
	    }

	}
```

Or a collection:

```php

	use App\Http\Transformers\UserTransformer;

	class UserController extends Controller
	{

	    public function index(Request $request)
	    {
	        return response()->json(app('fractal')->collection(User::all(), new UserTransformer())->getArray());
	    }
	}

```


You can also use includes, defaults, etc. WIP docs.

If you need a real example of use, you can check [here](https://github.com/gergonzalez/funacademy-test)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.