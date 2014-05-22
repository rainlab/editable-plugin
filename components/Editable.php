<?php namespace RainLab\Editable\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Content;
use Cms\Classes\CmsPropertyHelper;
use BackendAuth;

class Editable extends ComponentBase
{

    public $file;
    public $content;

    public function componentDetails()
    {
        return [
            'name'        => 'Editable Component',
            'description' => 'This component allows in-context editing (click to edit).'
        ];
    }

    public function defineProperties()
    {
        return [
            'file' => [
                'title'       => 'File',
                'description' => 'File to edit',
                'type'        => 'dropdown'
            ]
        ];
    }

     public function getFileOptions()
    {
        return CmsPropertyHelper::listContents();
    }

    public function onRun()
    {
        // Piggy back the Backend's rich editor
        $this->addCss('/modules/backend/formwidgets/richeditor/assets/vendor/redactor/redactor.css');
        $this->addJs('/modules/backend/formwidgets/richeditor/assets/vendor/redactor/redactor.js');

        $this->addCss('assets/css/editable.css');
        $this->addJs('assets/js/editable.js');
    }

    public function onRender()
    {
        $this->file = $this->property('file');

        if (!is_object($user = BackendAuth::getUser()) || !$user->hasAccess('cms.manage_pages'))
            return $this->renderContent($this->file);

        $this->content = $this->renderContent($this->file);
    }

    public function onSave()
    {
        $fileName = post('file');
        $template = Content::load($this->getTheme(), $fileName);
        $template->fill(['content' => post('content')]);
        $template->save();
    }

}
