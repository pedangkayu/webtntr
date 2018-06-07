<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\data_spa;
use App\Models\data_servicepack;
use App\Models\data_gallerys;

class SitemapController extends Controller {

  public function sitemap(){
    // create new sitemap object
    $sitemap = \App::make("sitemap");

    // add items to the sitemap (url, date, priority, freq)
    $sitemap->add(url(''), date('c'), '0.8', 'monthly');
    $sitemap->add(url('/page/contactus'), date('c'), '0.8', 'monthly');
    $sitemap->add(url('/page/aboutus'), date('c'), '0.8', 'monthly');
    $sitemap->add(url('/page/spa'), date('c'), '0.8', 'monthly');
    $sitemap->add(url('/page/terms-condition'), date('c'), '0.8', 'monthly');
    $sitemap->add(url('/page/servicepack'), date('c'), '0.9', 'daily');


    // Data SPA
    $items = data_spa::sitemap()->get();
    foreach($items as $item){
      $images = [];
      $imgs = data_gallerys::where('id_spa', $item->id_spa)->get();
      foreach($imgs as $img){
        $images[] = [
          'url' => asset('/gallery/' . $img->file),
          'title' => $img->title,
          'caption' => $img->title
        ];
      }
      $images[] = [
        'url' => asset('/spa/' . $item->img_thumbnail),
        'title' => $item->seo_title,
        'caption' => $item->seo_description
      ];
      $sitemap->add(url($item->slug), date('c', strtotime($item->updated_at)), '0.9', 'monthly', $images);
      $sitemap->add(url($item->slug . '/gallerys'), date('c', strtotime($item->updated_at)), '0.9', 'monthly', $images);

      // Image service
      $images_service = [];
      $imgservice = data_servicepack::where('id_spa', $item->id_spa)->where('type', 1)->select(['img_thumbnail', 'servicepack'])->get();
      foreach($imgservice as $img){
        $images_service[] = [
          'url' => asset('/servicepack/' . $img->img_thumbnail),
          'title' => $img->servicepack,
          'caption' => $img->servicepack
        ];
      }
      $sitemap->add(url($item->slug . '/services'), date('c', strtotime($item->updated_at)), '1.0', 'daily', $images_service);

      // Image Package
      $image_package = [];
      $imgpackage = data_servicepack::where('id_spa', $item->id_spa)->where('type', 1)->select(['img_thumbnail', 'servicepack'])->get();
      foreach($imgpackage as $img){
        $image_package[] = [
          'url' => asset('/servicepack/' . $img->img_thumbnail),
          'title' => $img->servicepack,
          'caption' => $img->servicepack
        ];
      }
      $sitemap->add(url($item->slug . '/packages'), date('c', strtotime($item->updated_at)), '1.0', 'daily', $image_package);
      $sitemap->add(url($item->slug . '/contact'), date('c', strtotime($item->updated_at)), '0.9', 'monthly');
      $sitemap->add(url($item->slug . '/menu'), date('c', strtotime($item->updated_at)), '0.9', 'daily');
    }

    // DATA servicepack
    $items = data_servicepack::sitemap()->get();
    foreach($items as $item){
      $images = [];
      $images[] = [
        'url' => asset('/servicepack/' . $item->img_thumbnail),
        'title' => $item->servicepack,
        'caption' => $item->servicepack
      ];
      $sitemap->add(url($item->spa_slug . '/servicepack/' . $item->slug), date('c', strtotime($item->updated_at)), '0.9', 'monthly', $images);
    }

    return $sitemap->render('xml');
  }

}
