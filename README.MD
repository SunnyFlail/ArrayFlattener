# Array Flattener
A simple trait for recursive flattening of arrays of strings into a executable php code
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
        $string = $this->f()[0];
        var_dump($this->flattenArrayToString($param));
    }

};
```
