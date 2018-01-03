<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\User;
use App\QuestionOption;

class Test extends Model
{
    
    public function get_test ( $id_chapter ) {

 		function get_question_option( $question ) {
			$options = QuestionOption::where( 'id_question' , $question->id )->get();
			return $options;
		}

    	$error;
    	$test = Test::where('id_chapter', $id_chapter)->first();
    	if ($test == null) {
    		$error['status'] = 'error';
    		$error['message'] = 'test not found';
    		return $error;
    	}
 		$questions = Question::where( 'id_test' , $test->id )->get();
		if ( count($questions) == 0 ) {
			$error['status'] = 'error';
    		$error['message'] = 'test not ready';
    		return $error;
		} else {
			foreach ($questions as $question) {
    			$question['option'] = get_question_option( $question );
    			if ( count($question['option']) == 0) {
    				$error['status'] = 'error';
		    		$error['message'] = 'test not ready';
		    		return $error;
    			}
    		}	
    		$test['questions'] = $questions;
		}
    	return $test;
    }

    


}
