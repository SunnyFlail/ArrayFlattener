<?php

namespace SunnyFlail\ArrayFlattener;

use ArrayIterator;
use InvalidArgumentException;

trait ArrayFlattener
{

    /**
     * Returns a string containing executable php representation of the array 
     * 
     * @param string[] $array Array of strings
     * @return string An executable php code representation of the array
     * @throws InvalidArgumentException
     */
    protected function flattenArrayToString(array $array): string
    {
        $string = "[";
        $iterator = new ArrayIterator($array);

        while ($iterator->valid())
        {
            $entry = $iterator->current();
            $key = $iterator->key();

            if (!is_string($entry) && !is_array($entry) && !is_numeric($entry)) {
                throw new InvalidArgumentException("This may only work for arrays of strings!");
            }
            if (!is_numeric($key)) {
                $string .= sprintf('"%s"=>', $key);
            }
            if (is_array($entry)) {
                $string .= $this->flattenArrayToString($entry);
            }
            if (is_string($entry)) {
                $string .= sprintf('"%s"', $entry);
            }

            $iterator->next();
            if ($iterator->valid()) {
                $string .= ",";
            }
        }

        $string .= "]";
        return $string;
    }    

}