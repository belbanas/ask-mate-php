<?php


namespace app\controllers;


use app\models\Model;
use Jenssegers\Blade\Blade;

class SearchController
{

    public static function renderSearchForm()
    {
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('searchForm');
    }

    public static function doSearch($itemForSearch)
    {
        $model = new Model();
        $searchResult = $model->doSearch($itemForSearch);

        $images = $model->getImages();
        $blade = new Blade('./app/views', './cache');
        echo $blade->render('questions', ['questions' => $searchResult, 'images' => $images, 'itemForSearch' => $itemForSearch]);
    }
}