<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = "shop_category";
  protected $primaryKey = "category_id";
  public $timestamps = false;
}
