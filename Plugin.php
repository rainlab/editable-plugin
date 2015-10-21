<?php namespace RainLab\Editable;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Editable',
            'description' => 'In-context content editor',
            'author'      => 'RainLab',
            'icon'        => 'icon-leaf',
            'homepage'    => 'https://github.com/rainlab/editable-plugin'
        ];
    }

    public function registerComponents()
    {
        return [
            'RainLab\Editable\Components\Editable' => 'editable'
        ];
    }
}
