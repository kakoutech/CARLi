<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrategyToolArticleResource extends Model
{
    use HasFactory;

    public function article()
    {
        return $this->belongsTo(StrategyToolArticle::class, 'strategy_tool_article_id', 'id');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }
}
