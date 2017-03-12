<?php
/**
 * Created by PhpStorm.
 * User: Oguyn
 * Date: 1/5/2016
 * Time: 12:18 AM
 */

namespace common\widgets;


use kartik\detail\DetailView;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

class DetailView2 extends DetailView
{
    public $columns = 1;
    protected $countColumn = 0;
    /**
     * Renders a single attribute.
     *
     * @param array $attribute the specification of the attribute to be rendered.
     * @param int   $index the zero-based index of the attribute in the [[attributes]] array
     *
     * @return string the rendering result
     */
    protected function renderAttribute($attribute, $index)
    {
        $rowOptions = ArrayHelper::getValue($attribute, 'rowOptions', $this->rowOptions);
        $unit = (100/$this->columns/5);
        $this->labelColOptions['style'] = "width:" . $unit . "%";
        $labelColOptions = ArrayHelper::getValue($attribute, 'labelColOptions', $this->labelColOptions);
        $valueColOptions = ArrayHelper::getValue($attribute, 'valueColOptions', $this->valueColOptions);
        if (ArrayHelper::getValue($attribute, 'group', false) === true) {
            $groupOptions = ArrayHelper::getValue($attribute, 'groupOptions', []);
            $label = ArrayHelper::getValue($attribute, 'label', '');
            if (empty($groupOptions['colspan'])) {
                $groupOptions['colspan'] = $this->columns * 2;
            }
            return Html::tag('tr', Html::tag('th', $label, $groupOptions), $rowOptions);
        }
        $colSpan = ArrayHelper::getValue($attribute, 'columnSpan', $this->columns);
        $hideLabel = ArrayHelper::getValue($attribute, 'hideLabel', false);
        $colSpan + $this->countColumn > $this->columns && $colSpan = $this->columns - $this->countColumn;
        if($colSpan > 1) {
            $valueColOptions['colspan'] = $colSpan * 2 - ($hideLabel? 0: 1);
        }
        $valueColOptions['style'] = 'width:' . (4*$unit) . '%;';
        if ($this->hideIfEmpty === true && empty($attribute['value'])) {
            Html::addCssClass($rowOptions, 'kv-view-hidden');
        }
        if (ArrayHelper::getValue($attribute, 'type', 'text') === self::INPUT_HIDDEN) {
            Html::addCssClass($rowOptions, 'kv-edit-hidden');
        }
        $dispAttr = $this->formatter->format($attribute['value'], $attribute['format']);
        Html::addCssClass($this->viewAttributeContainer, 'kv-attribute');
        Html::addCssClass($this->editAttributeContainer, 'kv-form-attribute');
        $output = Html::tag('div', $dispAttr, $this->viewAttributeContainer) . "\n";
        if ($this->enableEditMode) {
            $editInput = !empty($attribute['displayOnly']) && $attribute['displayOnly'] ?
                $dispAttr :
                $this->renderFormAttribute($attribute);
            $output .= Html::tag('div', $editInput, $this->editAttributeContainer);
        }
        $content = $this->countColumn == 0? Html::beginTag('tr', $rowOptions) . "\n": "";
        $content .= !$hideLabel? Html::beginTag('td', $labelColOptions) . $attribute['label'] . "</td>\n": "";
        $content .= Html::beginTag('td', $valueColOptions) . $output . "</td>\n";

        $this->countColumn += $colSpan;
        if($this->countColumn >= $this->columns) {
            $this->countColumn = 0;
            $content .= "</tr>";
        }
        return $content;
    }
}