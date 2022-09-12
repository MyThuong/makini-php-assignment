<?php

namespace App\Services;

use Illuminate\Support\Arr;

class TreeViewService
{
    protected $originalData;

    public function __invoke($input)
    {
        $this->originalData = $input;
        $output = $this->buildTree($input);
        return $output;
    }

    public function buildChildren(&$children)
    {
        foreach ($children as $index => $child_id) {

            $child_value = Arr::first($this->originalData, function ($value) use ($child_id) {
                return !empty($value['fields']['parents']) && in_array($child_id, $value['fields']['parents']);
            });

            $children[$index] = $child_value;

            if (!empty($children[$index]['fields']['children'])) {
                $this->buildChildren($children[$index]['fields']['children']);
            }
        }
    }

    public function buildTree($values)
    {

        $roots = array_filter($values, function ($value) {
            return empty($value['fields']['parents']);
        });

        foreach ($roots as &$value) {
            if (!empty($value['fields']['children'])) {
                $this->buildChildren($value['fields']['children']);
            }
        }

        return $roots;
    }

}
