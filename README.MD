# Array Flattener
A simple trait for recursive flattening of arrays of strings into an executable php code
# Sample usage
```php
use SunnyFlail\ArrayFlattener\ArrayFlattener;

$implementator = new class {
    use ArrayFlattener;

    public function sampleUsage()
    {
        $array = [
            "First", "Second", "A key" => "A value"
        ];
        var_dump($this->flattenArrayToString($array));
    }

};
```
