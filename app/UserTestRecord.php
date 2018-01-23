<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Test;
use App\QuestionOption;

class UserTestRecord extends Model
{
    
    public function is_user_record_exist ($id_user, $id_test){
    	$record = UserTestRecord::where('id_user', $id_user)->where('id_test', $id_test)->first();
    	if ( $record != null) {
    		return 'yes';
    	}
    	return 'no';
    }

    public function initiate_user_test_record ( $id_user, $test ) {
    	$error;
    	$user = User::find($id_user);
    	if ($user == null) {
    		$error['status'] = 'error';
    		$error['message'] = 'user not found';
    		return $error;
    	}
    	foreach ($test['questions'] as $key => $question) {
    		$user_test_record = new UserTestRecord();
	    	$user_test_record->id_user = $id_user;
	    	$user_test_record->id_test = $test->id;
	    	$user_test_record->id_question = $question->id;
	    	$user_test_record->save();
    	}
    	$status['status'] = 'success';
    	return $status;

    }

    public function submit_answer ( $id_user, $id_question, $id_option) {
    	$status['status'] = 'error';
    	$record = UserTestRecord::where('id_user', $id_user)->where('id_question', $id_question)->first();
    	$option = QuestionOption::find($id_option);
    	if ( $record == null ) {
    		$status['message'] = 'error when submiting answer';
    		return $status;
    	}
    	if ($option != null) {
    		$record->id_option 	= $id_option;
    		$record->is_true	= $option->is_true;
    		$record->save();
    	}
    	$status['status'] = 'success';
    	$status['message'] = 'success submiting';

    	return $status;
    }

    public function review_test ( $id_user , $id_test ) {
    	$record_test = UserTestRecord::where('id_user', $id_user)->where('id_test', $id_test)->get();
    	if (count($record_test) == 0) {
    		$record_test['status'] ='error';
    		$record_test['message'] ='test record not found';
    	}
    	$true_answer = UserTestRecord::where('id_user', $id_user)->where('id_test', $id_test)->where('is_true', 1)->get();

    	$count_true = count($true_answer);
    	$count_record_test = count($record_test);

    	$skor = round((($count_true/$count_record_test)*100),2);

    	$record['skor'] = $skor;
    	$record['true_answer'] = count($true_answer);
    	$record['total_question'] = count($record_test);
    	$record['status'] = 'success';

    	return $record;
    }

    public function get_post_test_by_module($id_module, $id_user) {

        $the_chapter = Chapter::where('id_module',$id_module)->where('category',1)->where('sequence','<>',0)->first();
        $the_test = Test::where('id_chapter',$the_chapter['id'])->first();
        $user_test_record = UserTestRecord::where('id_user',$id_user)->where('id_test',$the_test['id'])->get();

        //count post test score
        $true_answer = UserTestRecord::where('id_user', $id_user)->where('id_test', $the_test['id'])->where('is_true', 1)->get();
        $count_true = count($true_answer);
        $count_record_test = count($user_test_record);

        if ($count_record_test >0) {
            $skor = round((($count_true/$count_record_test)*100),2);
        } else {
            $skor = 'not yet';
        }

        return $skor;
    }
}
