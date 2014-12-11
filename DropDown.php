<?php
namespace developeruz\drop_down;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\Model;
use yii\widgets\InputWidget;
use yii\base\InvalidConfigException;

class DropDown extends InputWidget
{
    public $itemsModel;
    public $itemsLabelAttribute;
    public $itemsPKAttribute;
    public $condition;
    public $separator = '-';

    public function run()
    {
        $subModel = $this->itemsModel;
        if ($this->itemsModel != null && $this->itemsLabelAttribute != null) {

            if (empty($this->itemsPKAttribute)) {
                $this->itemsPKAttribute = implode($this->separator, $subModel::primaryKey());
            }

            $items = $this->getItemsAsArray();

            if ($this->hasModel()) {
                echo Html::activeDropDownList($this->model, $this->attribute, $items, $this->options);
            } else {
                echo Html::dropDownList($this->name, $this->value, $items, $this->options);
            }
        } else {
            throw new InvalidConfigException("'itemsModel' and 'itemsLabelAttribute' properties must be specified.");
        }
    }

    protected function getItemsAsArray()
    {
        $subModel = $this->itemsModel;
        $result = $subModel::find();
        if (!empty($this->condition)) {
            $result = $result->where($this->condition);
        }
        $result = $result->all();
        return ArrayHelper::map($result, $this->itemsPKAttribute, $this->itemsLabelAttribute);
    }
}