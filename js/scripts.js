// JavaScript Document
/*

*/
$(function(){
	$('.error-msg, .error-msg2, .suc-msg').fadeOut(15000);
	
	
	////////////////////////////////AJAX
	$('#ajax-class-id').change(function(){
		$('#student-name').val('');
		classId = $('#ajax-class-id').val();
		$.ajax({
          url: 'ajax-student-list/'+classId,
          dataType: 'html',
          type: 'post',
          success: function (data) {
			  $('.score-table').remove();
			  $('.no-result').remove();
			  $('.ajax-form-div').after(data);
          }
		}); // ajax
		}); //$('#ajax-class-id').change(function(){
	$('#student-name').keyup(function(){
		$('.no-result').remove();
		classId = $('#ajax-class-id').val();
		studentName = $('#student-name').val();
		$.ajax({
          url: 'ajax-student-list/'+classId+'/'+studentName,
          dataType: 'html',
          type: 'post',
          success: function (data) {
			  $('.score-table').remove();
			  $('.ajax-form-div').after(data);
          }
		}); // ajax
		});
		
//////////////////////////////////////////////
popup5Width = $('.popup5').width();
left = -(popup5Width/2 + 5);
$('.popup5').css('margin-left',left+'px');
$('#no-of-test').change(function(){
	val = parseInt($('#no-of-test').val());
	if(val == 1)
	{
		$('#max-score2').attr('disabled','disabled');
		$('#max-score3').attr('disabled','disabled');
	}
	else if(val == 2)
	{
		$('#max-score2').removeAttr('disabled');
		$('#max-score3').attr('disabled','disabled');
	}
	else
	{
		$('#max-score2').removeAttr('disabled');
		$('#max-score3').removeAttr('disabled');
	}
	});
	
	$('.click-drop').click(function(){
		$(this).next('div').slideToggle();
		});
	$('input.psyco-radio').click(function(){
		$(this).parent().parent().css({'background-color':'#DDD'});
		});
	$('#comment-form').submit(function(){
		if($('#comment-form textarea').val().length <= 4)
		{
			alert('The Staff Comment field must be above four characters');
			return false;
		}
		if(isNaN($('#times-present').val()))
		{
			alert('The Number of times present must be a numeric value');
			return false;
		}
		return true;
		});
});




function profile(id)
{
	window.location = "profile/"+id;
}
function deleteProfile(id, popupClass)
{
	endPopup(popupClass);
	window.location = id+"?action=delete";
}
function startPopup(popupClass)
{
	$('body').css('overflow', 'hidden');
	$('#transparent-cover').fadeIn(1000, function(){
		$(popupClass).fadeIn('slow');
		});
		return false;
}
function endPopup(popupClass)
{
	$(popupClass).fadeOut('slow', function(){
		$('#transparent-cover').fadeOut(1000);
		});
	$('body').css('overflow', 'auto');
}
function psychoFill(id)
{
	$('body').css('overflow', 'hidden');
	$('#transparent-cover').fadeIn(1000, function(){
		$('.psyco-fill').fadeIn('slow');
		});
	$('.seed-value').val(id);
		return false;
}
function commentFill(id)
{
	$('body').css('overflow', 'hidden');
	$('#transparent-cover').fadeIn(1000, function(){
		$('.comment-fill').fadeIn('slow');
		});
	$('.seed-value').val(id);
		return false;
}
