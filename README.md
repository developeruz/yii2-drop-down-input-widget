InputWidget для dropDown в Yii2
===================

Виджет генерирует <select>, используя модель, переданную в настройках виджета.
Может использоваться как с ActiveForm так и сам по себе.

Установка:
```bash
$ php composer.phar require developeruz/yii2-drop-down-input-widget "*"
```

###Простое использование###
```php
use developeruz\drop_down\DropDown;

    echo DropDown::widget(
            ['name' => 'article',
             'itemsModel' => Article::className(),
             'itemsLabelAttribute' => 'title',
            ]
        );
```
В результате получится следующий html-код
```html
<select name="article">
<option value="тут первичны ключ модели Article">Значение title модели Article</option>
<option value="тут первичны ключ модели Article">Значение title модели Article</option>
<option value="тут первичны ключ модели Article">Значение title модели Article</option>
...
</select>
```

###Использование c ActiveForm###
```php
use developeruz\drop_down\DropDown;

    <?= $form->field($model, 'article_id')->widget(DropDown::className(),
        ['itemsModel' => Article::className(),
        'itemsLabelAttribute' => 'title',
        ]); ?>
```

###Настройка виджета###
*Обязательными параметрами являются itemsModel и itemsLabelAttribute.
*В качестве ключа в формируемом select используется primaryKey() переданной модели. Это значение можно переопределить явно указав параметр itemsPKAttribute
*В случаи составного первичного ключа для формирования значения используется разделитель, задать который можно через параметр separator
*Так же можно передать параметр condition, который будет использован при выборке данных из модели Model::find()->where($this->condition)
