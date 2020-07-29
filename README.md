# Strict PHP
## Installation
```shell script
composer require nusje2000/strict-php
```

## Why?
This package was created because of the way the default php functions behave. A lot of functions return types that just
are not logical. This package wraps these functions and adds correct error handling and typing to these functions.

## Functions
### File functions
#### is_file
To check if a file exists, you can use `File::exists()`:
```php
use Nusje2000\StrictPhp\File;

File::exists('path/to/file.txt');
```

#### file_get_contents
To retreive contents from a file, you can use `File::getContents()`. Unlike the php function, this function will always
return the contents and if it's not possible, it will throw an exception.
```php
use Nusje2000\StrictPhp\File;

File::getContents('path/to/file.txt');
```

#### file_put_contents
To write contents to a file, you can use `File::putContents()`. Unlike the php function, this function will always
return the amout of bytes written and if it's not possible, it will throw an exception.
```php
use Nusje2000\StrictPhp\File;

File::putContents('path/to/file.txt', 'contents');
```

### Directory functions
#### is_dir
To check if a directory exists, you can use `Directory::exists()`.
```php
use Nusje2000\StrictPhp\Directory;

Directory::exists('path/to/file.txt');
```

### Json functions
#### json_encode
To encode a variable into json, you can use `Json::encode()`. This will always return the encoded string. If the
encoding fails, an exception is thrown.
```php
use Nusje2000\StrictPhp\Json;

Json::encode(['key' => 'value']);
```
#### json_decode
To decode a json formatted string, you can use `Json::decode()`. This function has multiple return types because the
content type can vary. For the situations where an object is expected, `Json::decodeToObject` can be used. For the
situations where an array is expected, `Json::decodeToArray` can be used.

Both decodeToObject and decodeToArray will force the return type to be either an object or an array, any other types
will result in an exception.
```php
use Nusje2000\StrictPhp\Json;

Json::decode('"some-valid-json"');
Json::decodeToArray('["value 1", "value 2", "value 3"]'); // ['value 1', 'value 2', 'value 3']
Json::decodeToArray('{"key": "value"}'); // ['key' => 'value']
Json::decodeToObject('{"key": "value"}'); // stdClass { $key = 'value' }
```
