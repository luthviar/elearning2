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
        $news = News::where( 'flag_active', 1 )->orderBy( 'created_at' , 'desc' )->paginate(6);
        return $news;
    }

    public function get_active_news() {
    	$news = News::where( 'flag_active', 1 )->orderBy( 'created_at' , 'desc' )->take(6)->get();
    	return $news;
    }

    public function get_news ( $id_news ) {

    	// get news attachment
    	function get_news_attachment ( $news ) {
    		$attachments = NewsAttachment::where( 'id_news' , $news->id )->get();
    		if ( count( $attachments ) == 0 ) {
    			return "no attachments";
    		} 
    		return $attachments;
    	}

    	// get news comments
    	function get_comments ( $news ) {
    		
    		function get_comment_attachments ( $comment ) {
    			$attachments = NewsCommentAttachment::where( 'id_comment' , $comment->id )->get();
    			if ( count($attachments) == 0 ) {
    				return "no attachments";
    			}
    			return $attachments;
    		}

    		$comments = NewsComment::where( 'id_news' , $news->id )->get();
    		if ( count($comments) == 0 ) {
    			return "no comments";
    		}
    		foreach ($comments as $comment ) {
    			$comment["attachments"] = get_comment_attachments( $comment );
    		}

    		return $comments;
    	}


    	//-------------------------------
    	//		       MAIN
    	//-------------------------------

    	$news = News::find( $id_news );
    	if ( $news == null ) {
    		return "news not found";
    	}

    	$news['attachments'] = get_news_attachment( $news );

    	$news['comments'] = get_comments( $news );

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
