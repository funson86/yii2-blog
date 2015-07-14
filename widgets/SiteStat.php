<?php
namespace funson86\blog\widgets;

use yii\base\Widget;
use yii\db\Query;
use yii\helpers\Html;

class SiteStat extends Widget
{
    public $title;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'title';
        }
    }

    public function run()
    {
        $str = '';

        $query = new Query();
        $res = $query->select('sum(click) as click')
            ->from(\Yii::$app->db->tablePrefix .'blog_post')->one();
        $click = $res['click'];
        $str .= '<div class="site-stat">点击数量：'.$click.'</div>';

        $postCount = $query->from(\Yii::$app->db->tablePrefix .'blog_post')->count();
        $str .= '<div class="site-stat">文章数量：'.$postCount.'</div>';

        $commentCount = $query->from(\Yii::$app->db->tablePrefix .'blog_comment')->count();
        $str .= '<div class="site-stat">评论数量：'.$commentCount.'</div>';

        return $this->render('portal', [
            'title' => $this->title,
            'content' => $str,
        ]);
    }
}