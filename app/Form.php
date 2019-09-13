<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Form extends Model{

    protected $table = 'form';

    protected $filliable = ['form', 'name', 'user_id', 'description'];
}
?>