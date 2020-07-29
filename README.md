# Strict PHP
## Installation
```shell script
composer require nusje2000/strict-php
```

## Why?
This package was created because of the way the default php functions behave. A lot of functions return types that are
not logical. This package wraps these functions and adds correct error handling and typing to these functions.

## Functions
### File functions
#### exists (replaces is_file)
To check if a file exists, you can use `File::exists()`:
```php
use Nusje2000\StrictPhp\File;

File::exists('path/to/file.txt');
```

#### getContents (replaces file_get_contents)
To retrieve contents from a file, you can use `File::getContents()`. This function will return the contents and
if not possible, an exception will be thrown.
```php
use Nusje2000\StrictPhp\File;

File::getContents('path/to/file.txt');
```

#### putContents (replaces file_put_contents)
To write contents to a file, you can use `File::putContents()`. This function will always return the amount of bytes
written and if not possible, an exception will be thrown.
```php
use Nusje2000\StrictPhp\File;

File::putContents('path/to/file.txt', 'contents');
```

### Directory functions
#### exists (replaces is_dir)
To check if a directory exists, you can use `Directory::exists()`.
```php
use Nusje2000\StrictPhp\Directory;

Directory::exists('path/to/file.txt');
```

### Json functions
#### encode (replaces json_encode)
To encode a variable into json, you can use `Json::encode()`. This will always return the encoded string. If the
encoding fails, an exception will be thrown.
```php
use Nusje2000\StrictPhp\Json;

Json::encode(['key' => 'value']);
```
#### decode (replaces json_decode)
To decode a json formatted string, you can use `Json::decode()`. This function has multiple return types.
```php
use Nusje2000\StrictPhp\Json;

Json::decode('"some-valid-json"');
```
#### decodeToObject (replaces json_decode)
If an object is expected as return type, decodeToObject can be used to both decode and assert that the output is an object.
If the output is not an instance of stdClass, an exception will be thrown.
```php
use Nusje2000\StrictPhp\Json;

Json::decodeToObject('{"key": "value"}'); // stdClass { $key = 'value' }
```

#### decodeToArray (replaces json_decode)
If an array is expected as return type, decodeToArray can be used to both decode and assert that the output is an array.
If the output is not an array, an exception will be thrown.
```php
use Nusje2000\StrictPhp\Json;

Json::decodeToArray('["value 1", "value 2", "value 3"]'); // ['value 1', 'value 2', 'value 3']
Json::decodeToArray('{"key": "value"}'); // ['key' => 'value']
```
