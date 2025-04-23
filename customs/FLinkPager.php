<?php
namespace app\customs;

use yii\helpers\Html;
use yii\widgets\LinkPager;

/**
 * Custom version of LinkPager
 *
 * @author Fahmi Auliya Tsani <amixcustomlinux@gmail.com>
 */
class FLinkPager extends LinkPager
{
    public $prevPageLabel = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" />
                    </svg>&nbsp;';
    public $nextPageLabel = '&nbsp;<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 6l6 6l-6 6"></path>
                    </svg>';

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }

        $this->getView()->registerCss("li.disabled { margin-top: 3px; }");

        echo $this->renderPagination();
    }

    /**
     * Additional method to render div container for pagination links
     */
    public function renderPagination()
    {
        return Html::tag('div', $this->renderPageButtons(), [
            'class' => 'card-footer d-flex align-items-center'
        ]);
    }
}
