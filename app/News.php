<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NewsAttachment;
use App\NewsViewer;
use App\NewsComment;
use App\NewsCommentAttachment;

class News extends Model
{

	protected $table="newses";
    
    public function get_all_news() {
    	$news = News::all();
    	return $news;
    }

    public function get_all_active_news () {
        $news = News::where( 'flag_active', 1 )->where('is_publish',1)->orderBy( 'created_at' , 'desc' )->paginate(6);
        return $news;
    }

    public function get_active_news() {
    	$news = News::where( 'flag_active', 1 )->where('is_publish',1)->orderBy( 'created_at' , 'desc' )->take(6)->get();
    	return $news;
    }

    public function get_news ( $id_news ) {
 

    	//-------------------------------
    	//		       MAIN
    	//-------------------------------

    	$news = News::find( $id_news );
    	if ( $news == null ) {
    		return "news not found";
    	}

    	$news['attachments'] = NewsAttachment::where( 'id_news' , $news->id )->get();

		$comments = NewsComment::where( 'id_news' , $news->id )->get();
		if ( count($comments) == 0 ) {
			$news['comments'] = "no comments";
		} else {
			foreach ($comments as $comment ) {
				$attachments = NewsCommentAttachment::where( 'id_comment' , $comment->id )->get();
    			if ( count($attachments) == 0 ) {
    				$comment["attachments"] = "no attachments";
    			} else {
					$comment["attachments"] =	$attachments;
				}
			}
				
			$news['comments'] = $comments;
		}
		

    	return $news;

    }

    public function activate_news( $id_news ) {
        $news = News::find( $id_news );
        if ($news == null) {
            return "news not found";
        }
        if ($news->flag_active == 1) {
            return "error : slider sudah aktif";
        }
        $news->flag_active = 1;
        $news->save();
        return "news berhasil diaktifkan";
    }

    public function nonactivate_news( $id_news ){
        $news = News::find( $id_news );
        if ($news == null) {
            return "news not found";
        }
        if ($news->flag_active == 0) {
            return "error : slider sudah tidak aktif";
        }
        $news->flag_active = 0;
        $news->save();
        return "news berhasil dinonaktifkan";
    }

}
