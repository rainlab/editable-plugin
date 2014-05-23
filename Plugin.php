<?php namespace RainLab\Editable;

use System\Classes\PluginBase;

/**
 * Editable Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Editable',
            'description' => 'In-context content editor',
            'author'      => 'RainLab',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            'RainLab\Editable\Components\Editable' => 'editable',
        ];
    }

}
