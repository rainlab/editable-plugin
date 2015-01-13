<?php namespace RainLab\Editable\Components;

use File;
use BackendAuth;
use Cms\Classes\Content;
use Cms\Classes\ComponentBase;

class Editable extends ComponentBase
{

    public $content;
    public $isEditor;
    public $file;
    public $fileMode;

    public function componentDetails()
    {
        return [
            'name'        => 'Editable Component',
            'description' => 'This component allows in-context editing.'
        ];
    }

    public function defineProperties()
    {
        return [
            'file' => [
                'title'       => 'File',
                'description' => 'Content block filename to edit, optional',
                'default'     => '',
                'type'        => 'dropdown',
            ]
        ];
    }

    public function getFileOptions()
    {
        return Content::sortBy('baseFileName')->lists('baseFileName', 'fileName');
    }

    public function onRun()
    {
        $this->isEditor = $this->checkEditor();

        if ($this->isEditor) {
            // Piggy back the Backend's rich editor
            $this->addCss('/modules/backend/formwidgets/richeditor/assets/vendor/redactor/redactor.css');
            $this->addJs('/modules/backend/formwidgets/richeditor/assets/vendor/redactor/redactor.js');

            $this->addCss('assets/css/editable.css');
            $this->addJs('assets/js/editable.js');
        }
    }

    public function onRender()
    {
        $this->file = $this->property('file');
        $this->fileMode = File::extension($this->property('file'));

        /*
         * Compatability with RainLab.Translate
         */
        if (class_exists('\RainLab\Translate\Classes\Translator')){
            $locale = \RainLab\Translate\Classes\Translator::instance()->getLocale();
            $fileName = substr_replace($this->file, '.'.$locale, strrpos($this->file, '.'), 0);
            if (($content = Content::loadCached($this->page->controller->getTheme(), $fileName)) !== null)
                $this->file = $fileName;
        }

        if (!$this->isEditor)
            return $this->renderContent($this->file);

        $this->content = $this->renderContent($this->file);
    }

    public function onSave()
    {
        if (!$this->checkEditor())
            return;

        $fileName = post('file');
        $template = Content::load($this->getTheme(), $fileName);
        $template->fill(['markup' => post('content')]);
        $template->save();
    }

    public function checkEditor()
    {
        $backendUser = BackendAuth::getUser();
        return $backendUser && $backendUser->hasAccess('cms.manage_content');
    }

}