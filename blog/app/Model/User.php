<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = "shop_user";
  protected $primaryKey = "user_id";
}
