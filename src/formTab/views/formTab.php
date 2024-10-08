<?php

namespace strtob\yii2WidgetToolkit\formTab\views;

use yii;
use yii\helpers\Html;
use kartik\tabs\TabsX;
use strtob\yii2Helpers\IconHelper;

$forms = [];

$isExtension = isset($tbl_sys_link_table_id) && isset($linked_table_id);

$viewPath = '@vendor/strtob/yii2-widget-toolkit/src/formTab/views';



foreach ($tabItems as $tabItem)
{

    // init in case of null
    if (!isset($tabItem['showIfNewRecord']))  
        $tabItem['showIfNewRecord'] = false;
 
    

    // show if record is new
    if ($tabItem['showIfNewRecord'] || !$model->isNewRecord)
    {

        
        $label = '<i class="' . $tabItem['iconCss'] . '"></i> ' . Html::encode($tabItem['label']);
        $badge = '<span class="badge bg-success"></span>';

        $forms = array_merge(
                $forms,
                [
                    [
                        'label'   => $label . ' ' . $badge,
                        'content' => \Yii::$app->view->renderFile(
                                $tabItem['view'] . '.php', $tabItem['param'],
                        ),
                    ]
                ]
        );
    }
}
?>      

<?php

if (!$model->isNewRecord)
{
    $linkModel = null;

    if (class_exists('\app\models\LinkType')) {
        // Try to find the LinkType model if the class exists
        $linkModel = \app\models\LinkType::find()
            ->withClass($model::class)
            ->one();
    } else {
        // Fall back to LinkTable if LinkType class doesn't exist
        $linkModel = \app\models\LinkTable::find()
            ->withClass($model::class)
            ->one();
    }

    if ($linkModel)
    {

        $fileAvoidModelClass = [
            'backend\models\sys\SysLinkTable',
        ];

        if ($linkModel->hasFile && !in_array($model::class, $fileAvoidModelClass))
        {

            $badge = '<span class="badge bg-success"></span>';

            $forms = array_merge(
                    $forms,
                    [
                        [
                            'label'   => '<i class = "far fa-folder me-1"></i> ' . Html::encode(
                                    \Yii::t('app', 'File')
                            ) . $badge,
                            'content' => $this->render(
                                    '/file/_extension/index',
                                    [
                                        'model'                 => $model,
                                        'dataProviders'         => $dataProviders,
                                        'searchModels'          => $searchModels,
                                        'tbl_sys_link_table_id' => $tbl_sys_link_table_id,
                                        'linked_table_id'       => $linked_table_id,
                                        'showFilesRecursive'    => $showFilesRecursive,
                                        'uid'                   => $uid,
                                        'isExtension'           => $isExtension,
                                    ]
                            ),
                            'options' => ['id' => 'tabFile' . $uid],
                        ],
                    ]
            );
        }


        if ($linkModel->hasCalendar)
        {
            $forms = array_merge(
                    $forms,
                    [
                        [
                            'label'   => '<i class = "far fa-calendar me-1"></i> ' . Html::encode(
                                    \Yii::t('app', 'Calendar')
                            ),
                            'content' => $this->render(
                                    '/calendar/_extension/index',
                                    [
                                        'model'                 => $model,
                                        'dataProviders'         => $dataProviders,
                                        'searchModels'          => $searchModels,
                                        'tbl_sys_link_table_id' => $tbl_sys_link_table_id,
                                        'linked_table_id'       => $linked_table_id,
                                        'uid'                   => $uid,
                                        'isExtension'           => $isExtension,
                                    ]
                            ),
                            'options' => ['id' => 'tabCalendar' . $uid],
                        ]
                    ]
            );
        }

        if ($linkModel->hasTask)
        {
            $forms = array_merge(
                    $forms,
                    [
                        [
                            'label'   => '<i class = "'.IconHelper::get('task').' me-1"></i> ' . Html::encode(
                                    \Yii::t('app', 'Task')
                            ),
                            'content' => $this->render(
                                    '/task/_extension/index',
                                    [
                                        'model'                 => $model,
                                        'dataProviders'         => $dataProviders,
                                        'searchModels'          => $searchModels,
                                        'tbl_sys_link_table_id' => $tbl_sys_link_table_id,
                                        'linked_table_id'       => $linked_table_id,
                                        'uid'                   => $uid,
                                        'isExtension'           => $isExtension,
                                    ]
                            ),
                            'options' => ['id' => 'tabTask' . $uid],
                        ]
                    ]
            );
        }

        if ($linkModel->hasComment)
        {
            $forms = array_merge(
                    $forms,
                    [
                        [
                            'label'   => '<i class = "'.IconHelper::get('comment').' me-1"></i> ' . Html::encode(
                                    \Yii::t('app', 'Comment')
                            ),
                            'content' => $this->render(
                                    '/comment/_extension/index',
                                    [
                                        'model'                 => $model,
                                        'dataProviders'         => $dataProviders,
                                        'searchModels'          => $searchModels,
                                        'tbl_sys_link_table_id' => $tbl_sys_link_table_id,
                                        'linked_table_id'       => $linked_table_id,
                                        'uid'                   => $uid,
                                        'isExtension'           => $isExtension,
                                    ]
                            ),
                            'options' => ['id' => 'tabComment' . $uid],
                        ]
                    ]
            );
        }
        
        if ($linkModel->hasCommunication)
        {
            $forms = array_merge(
                    $forms,
                    [
                        [
                            'label'   => '<i class = "'.IconHelper::get('communication').' me-1"></i> ' . Html::encode(
                                    \Yii::t('app', 'Communication')
                            ),
                            'content' => $this->render(
                                    '/communication/_extension/index',
                                    [
                                        'model'                 => $model,
                                        'dataProviders'         => $dataProviders,
                                        'searchModels'          => $searchModels,
                                        'tbl_sys_link_table_id' => $tbl_sys_link_table_id,
                                        'linked_table_id'       => $linked_table_id,
                                        'uid'                   => $uid,
                                        'isExtension'           => $isExtension,
                                    ]
                            ),
                            'options' => ['id' => 'tabCommunication' . $uid],
                        ],
                    ]
            );
        }

        if ($linkModel->hasKnowledgeBase)
        {
            $forms = array_merge(
                    $forms,
                    [
                        [
                            'label'   => '<i class = "'.IconHelper::get('knowledgebase').' me-1"></i> ' . Html::encode(
                                    \Yii::t('app', 'Knowledge Base')
                            ),
                            'content' => $this->render(
                                    '/knowledge-base/_extension/index',
                                    [
                                        'model'                 => $model,
                                        'dataProviders'         => $dataProviders,
                                        'searchModels'          => $searchModels,
                                        'tbl_sys_link_table_id' => $tbl_sys_link_table_id,
                                        'linked_table_id'       => $linked_table_id,
                                        'uid'                   => $uid,
                                        'isExtension'           => $isExtension,
                                    ]
                            ),
                            'options' => ['id' => 'tabKnowledgeBase' . $uid],
                        ],
                    ]
            );
        }
    }

    if (\Yii::$app->user->can('permission_view_meta')) 
        // If the user has the "admin" role or permission
        $forms = array_merge(
                $forms,
                [
                    [
                        'label'   => '<i class = "'.IconHelper::get('meta').' me-1"></i> ' . Html::encode(
                                \Yii::t('app', 'Meta')
                        ),
                        'content' => $this->renderFile(
                                $viewPath . '/_extension/meta.php',
                                [
                                    'model'         => $model,
                                    'dataProviders' => $dataProviders,
                                    'searchModels'  => $searchModels,
                                    'uid'           => $uid,
                                ]
                        ),
                    ]
                ]
        );
}


echo TabsX::widget([
    'items'            => $forms,
    'containerOptions' => ['id' => 'tab123', 'class' => 'pt-2 h-100'],
    'navType'          => 'nav',
    'options'          => ['class' => 'nav-pills flex-column'],
    'position'         => TabsX::ALIGN_LEFT,
    'encodeLabels'     => false,
    'pluginOptions'    => [
        'bordered'    => true,
        'sideways'    => true,
        'enableCache' => false,
    ]
]);
?>

<?php

$this->registerJs(
        $this->render(
                '_script.js', [
            'uid'         => $uid,
            'isExtension' => $isExtension,
            'position'    => \yii\web\View::POS_END,
                ]
        )
);
?>
