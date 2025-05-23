<?php
namespace app\customs;

use Yii;
use yii\grid\ActionColumn;
use yii\helpers\Html;

/**
 * Custom version of ActionColumn
 *
 * @author Fahmi Auliya Tsani <amixcustomlinux@gmail.com>
 */
class FActionColumn extends ActionColumn
{
    public $template = '{update} {delete}';

    public function init()
    {
        parent::init();

        $this->header = Yii::t('app', 'action');
    }

    /**
     * @inheritdoc
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('update', 'pencil');
        $this->initDefaultButton('delete', 'trash');
    }

    /**
     * @inheritdoc
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'update':
                        $title = Yii::t('app', 'edit');
                        $options = array_merge([
                            'title' => $title,
                            'aria-label' => $title,
                            'data-pjax' => '0',
                            'class' => 'text-dark',
                        ], $additionalOptions, $this->buttonOptions);
                        break;
                    case 'delete':
                        $title = Yii::t('app', 'delete');
                        $options = array_merge([
                            'title' => $title,
                            'aria-label' => $title,
                            'data-pjax' => '0',
                            'class' => 'text-danger',
                        ], $additionalOptions, $this->buttonOptions);
                        break;
                    default:
                        $title = ucfirst($name);
                }

                $icon = Html::tag('i', '', [
                    'class' => "bi bi-$iconName",
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-placement' => 'bottom',
                    'title' => $title
                ]);

                return Html::a($icon, $url, $options);
            };
        }
    }
}
