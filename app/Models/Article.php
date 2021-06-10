<?php

namespace App\Models;

use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Article extends Model
{
    use Uploadable;
    public $timestamps = false;
    protected $guarded = [];

     protected $uploadableFiles = [
          'image' => [
               'folder' => 'article',
               'rules' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2200',
          ]
     ];    

     public function scopeOrder($query) {
          return $query->orderBy('date', 'DESC');
     }

     public function scopePublished($query){
          return $query->where('published', 1)
               ->order();
     }

     public function formatDate(){
          $meses = self::getMonths();
          return  $meses[date('n', strtotime($this->date)) - 1] . ' ' . date('d', strtotime($this->date)) . ', ' .  date('Y', strtotime($this->date));
     }

     public static function getMonths(){
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
          return $meses;
     }
}
