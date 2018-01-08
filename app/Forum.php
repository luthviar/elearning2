<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ForumAttachment;
use App\ForumComment;
use App\ForumViewer;
use App\ForumCommentAttachment;
use App\User;

class Forum extends Model
{
    
    public function get_all_forum(){
    	$forum = Forum::all();
    	if ( count($forum) == 0) {
    		return "no forum found";
    	}
    	return $forum;
    }

    public function get_forum_public() {
        
        function get_last_seen ( $forum ) {
            $comment = ForumComment::where('id_forum' , $forum->id)->orderBy('created_at', 'desc')->first();
            if ( $comment == null) {
                return null;
            }
            $user = User::find($comment->created_by);
            if ( $user == null) {
                $comment['user'] = "error when loading user";
            }
            $comment['user'] = $user;
            return $comment;
        }

    	$forums = Forum::where( 'category' , 0 )->orderBy('created_at', 'desc')->paginate(10);
    	if ( count($forums) == 0 ) {
    		return "no forum found";
    	}


        
        foreach ($forums as $forum) {
            $user = User::find($forum->created_by);
            if ( $user == null) {
                $forum['user'] = "error when loading user";
            }
            $comment = ForumComment::where('id_forum', $forum->id)->get();
            $forum['comments_count'] = count($comment);
            $forum['user'] = $user;
            $forum['last_seen'] = get_last_seen( $forum );
        }

        
    	return $forums;
    }

    public function get_last_six_forum () {
        $forum = Forum::where('category',0)->orderBy('id','desc')->limit(6)->get();
        return $forum;
    }


    public function get_forum_public_server_side($limit, $start, $order, $dir) {
        
        function get_last_seen ( $forum ) {
            $comment = ForumComment::where('id_forum' , $forum->id)->orderBy('created_at', 'desc')->first();
            if ( $comment == null) {
                return null;
            }
            $user = User::find($comment->created_by);
            if ( $user == null) {
                $comment['user'] = "error when loading user";
            }
            $comment['user'] = $user;
            return $comment;
        }

        $forums = Forum::where( 'category' , 0 )->limit($limit)->offset($start)->orderBy($order, $dir)->get();
        if ( count($forums) == 0 ) {
            return "no forum found";
        }


        
        foreach ($forums as $forum) {
            $user = User::find($forum->created_by);
            if ( $user == null) {
                $forum['user'] = "error when loading user";
            }
            $comment = ForumComment::where('id_forum', $forum->id)->get();
            $forum['comments_count'] = count($comment);
            $forum['user'] = $user;
            $forum['last_seen'] = get_last_seen( $forum );
        }

        
        return $forums;
    }

    public function get_forum_by_job_family( $job_family ) {
    	$forum = Forum::where( 'category' , 1 )->get();
    	if ( count($forum) == 0 ) {
    		return "no forum found";
    	}
    	return $forum;	
    }

    public function get_forum_by_department( $department ) {
    	$forum = Forum::where( 'category' , 2 )->get();
    	if ( count($forum) == 0 ) {
    		return "no forum found";
    	}
    	return $forum;
    }

    public function get_forum_by_user( $user) {

    }

    public function get_forum( $forum_id ) {
    	
    	function get_forum_viewer ( $forum ) {
    		$forum_viewer = ForumViewer::where( 'id_forum', $forum->id)->get();
    		if ( count($forum_viewer) == 0 ) {
    			return "0";
    		}
    		return $forum_viewer;
    	}

    	function get_forum_attachment ( $forum ) {
    		$attachment = ForumAttachment::where( 'id_forum', $forum->id)->get();
    		if ( count($attachment) == 0) {
    			return "no attachment";
    		}
    		return $attachment;
    	}

    	function get_forum_comment ( $forum ) {

    		function get_forum_comment_attachment ( $comment ) {
    			$attachment = ForumCommentAttachment::where( 'id_comment', $comment->id)->get();
    			if ( count($attachment) == 0) {
    				return "no attachment";
    			}
    			return $attachment;
    		}

    		$comments = ForumComment::where( 'id_forum', $forum->id)->get();
    		if ( count($comments) == 0) {
    			return "no comment found";
    		} else {
    			foreach ($comments as $comment) {
	    			$comment['attachments'] = get_forum_comment_attachment($comment);
                    $comment['user'] = User::find($comment->created_by);
	    		}
	    		return $comments;	
    		}
    	}

    	//---------Main-------------------
    	$forum = Forum::find( $forum_id );
    	if ( $forum == null ) {
            $forum['status'] = 'error';
            $forum['message'] = 'forum not found';
    		return $forum;
    	}
    	$forum['viewer'] = get_forum_viewer($forum);
    	$forum['attachment'] = get_forum_attachment($forum);
    	$forum['comment'] = get_forum_comment($forum);
        $forum['status'] = 'success';

    	return $forum;
    }


}
