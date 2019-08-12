<?php

namespace App\ViewModels;

abstract class ViewModel
{

    protected $mappings = [];

    /**
     * Map an array to the view-model's properties.
     *
     * @param $values
     * @return ViewModel
     */
    public function mapArray($values)
    {
        foreach ($this->mappings as $index => $mapping) {
            if (is_array($mapping)) {
                if (count($mapping) == 3 && $mapping[2] == 'array') {
                    foreach ($values[$mapping[1]] as $index2 => $value) {
                        /* @var $vm ViewModel */
                        $vm = new $mapping[0]();
                        $this->$index[] = $vm->mapArray($value);
                    }
                } else {
                    /* @var $vm ViewModel */
                    $vm = new $mapping[0]();
                    $this->$index = $vm->mapArray(@$values[$mapping[1]]);
                }
            } else {
                $this->$index = @$values[$mapping];
            }
        }
        return $this;
    }

    /**
     * Turn view model into associative array with mapping as keys.
     *
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->mappings as $index => $mapping) {
            if (is_array($mapping)) {
                if (count($mapping) == 3 && $mapping[2] == 'array') {
                    foreach ($this->$index as $index2 => $value) {
                        /* @var ViewModel $value */
                        $result[$mapping[1]] = $value->toArray();
                    }
                } else {
                    $result[$mapping[1]] = $this->$index->toArray();
                }
            } else {
                $result[$mapping] = $this->$index;
            }
        }
        return $result;
    }

    function __get($name)
    {
        if (empty($this->$name)) {
            return null;
        }

        return $this->$name;
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

}