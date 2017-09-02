<?php
function datetime_from_format($datetime, $format_from, $format_to = 'Y-m-d H:i:s')
{
    $datetime_new = DateTime::createFromFormat($format_from, $datetime);
    return $datetime_new->format($format_to);
}

function build_tree($elements = [], $parent_id = 0)
{
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent_id'] == $parent_id) {
            $children = build_tree($elements, $element['id']);
            if ($children)  {
                $element['child'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

function pr($data)
{
    if (is_array($data))
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    else
    {
        var_dump($data);
    }
}

function print_tree($elements = [], $prefix = '-', $parent_id = 0, $branch = [])
{
    foreach ($elements as $element) {
        $tree_prefix = ($element['parent_id'] == 0) ? '' : $prefix;
        $branch[$element['id']] = $tree_prefix.$element['text'];
        if (isset($element['child'])) {
            $branch = print_tree($element['child'], $tree_prefix.$prefix, $element['parent_id'], $branch);
        }
    }

    return $branch;
}
