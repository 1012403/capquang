<?php
namespace common\widgets;

use kartik\select2\Select2;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SelectableGroupSelect2
 *
 * @author Than
 */
class SelectableGroupSelect2 extends \kartik\base\InputWidget{
    
    /**
     * @var array the HTML attributes for the input tag. The following options are important:
     * - multiple: boolean whether multiple or single item should be selected. Defaults to false.
     * - placeholder: string placeholder for the select item.
     */
    public $options = [];
    
    public function init() {
        parent::init();
        $this->initPlaceholder();
        \yii\helpers\Html::addCssClass($this->options, 'form-control');
        if(!isset($this->options['width']))
        {
            \yii\helpers\Html::addCssStyle($this->options, 'max-width:400px', false);
        }else
        {
            \yii\helpers\Html::addCssStyle($this->options, $this->options['width'], false);
        }
        $this->initLanguage();
        $this->registerAssets();
        $this->renderInput();
    }
    
    
    /**
     * Initializes the placeholder for Select2
     */
    protected function initPlaceholder()
    {
        $isMultiple = \yii\helpers\ArrayHelper::getValue($this->options, 'multiple', false);
        if (!empty($this->options['prompt']) && empty($this->pluginOptions['placeholder'])) {
            $this->pluginOptions['placeholder'] = $this->options['prompt'];
            if ($isMultiple) {
                unset($this->options['prompt']);
            }
            return;
        }
        if (!empty($this->options['placeholder'])) {
            $this->pluginOptions['placeholder'] = $this->options['placeholder'];
            unset($this->options['placeholder']);
        }
        if (!empty($this->pluginOptions['placeholder']) && is_string($this->pluginOptions['placeholder']) && !$isMultiple) {
            $this->options['prompt'] = $this->pluginOptions['placeholder'];
        }
    }
    
    protected function renderInput()
    {
        $input = $this->getInput('dropDownList', true);
        echo $input;
    }

    /**
     * Registers the asset bundle and locale
     */
    public function registerAssetBundle()
    {
        $view = $this->getView();
        SelectableGroupSelect2Asset::register($view);
    }
    
    
    protected function initLanguage($property = 'language', $full = false)
    {
        if (empty($this->pluginOptions[$property])) {
            $this->pluginOptions[$property] = $full ? $this->language : $this->_lang;
        }
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $id = $this->options['id'];
        $this->registerAssetBundle();
        // validate bootstrap has-success & has-error states
        $this->pluginEvents += [
//            'select2:opening' => "function(event){initSelect2DropStyle('{$id}', '{$clear}', event);}",
//            'select2:unselect' => "function(){window.{$clear} = true;}"
        ];
        $this->pluginOptions['selectedList'] = 100;
        $this->pluginOptions['height'] = 400;
        // register plugin
        $this->registerPlugin('multiselect');
        $id = "jQuery('#" . $this->options['id'] . "')";
        $this->getView()->registerJs("$id.multiselectfilter()");

    }

//    protected function getPluginScript($name, $element = null, $callback = null, $callbackCon = null)
//    {
//        $id = $element == null ? "jQuery('#" . $this->options['id'] . "')" : $element;
//        $script = '';
//        if ($this->pluginOptions !== false) {
//            $this->registerPluginOptions($name);
//            $script = "{$id}.{$name}({$this->_hashVar})";
//            if ($callbackCon != null) {
//                $script = "{$id}.{$name}({$this->_hashVar}, {$callbackCon})";
//            }
//            if ($callback != null) {
//                $script = "jQuery.when({$script}).done({$callback})";
//            }
//            $script .= ".multiselectfilter()";
//            $script .= ";\n";
//        }
//        if (!empty($this->pluginEvents)) {
//            foreach ($this->pluginEvents as $event => $handler) {
//                $function = new JsExpression($handler);
//                $script .= "{$id}.on('{$event}', {$function});\n";
//            }
//        }
//        return $script;
//    }
}
