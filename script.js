

// signup page

$("#sign_up_options input[name = role]").change(function(){
	var selected = $(this).val();
	var current = "#" + selected + "_form";
	$("#sign_up_options").css({
		margin : "2% auto"
	});
	displayForm(current);
	changeColor(selected);
});
function displayForm(current){
	$(".sign_up_form").css("display" , "none");
	$(current).css("display" , "block");
}
function changeColor(selected){
	var pickedColor;
	var pos;
	if(selected === "contributor"){
		pickedColor = "rgb(0, 255, 0)";
		pos = "left";
	}
	else if(selected === "volunteer"){
		pickedColor = "rgb(255, 0, 0)";
		pos = "center";
	}
	else{
		pickedColor = "rgb(0, 0, 255)";
		pos = "right";
	}
	$("#sign_up_options h1").css("color", pickedColor);
	$("#sign_up_options h1").css("text-align", pos);
}


	// Signup Validations

function validateForm(selected)
{
	var current = "#" + selected + "_form";
	var pass1 = $(current + " input[name = password]").val();
	var pass2 = $(current + " input[name = confirm_password]").val();
	var question = $(current + " select[name = security_question]").val();
	if(pass1 !== pass2)
	{
		$(current + " input[name = password]").val("");
		$(current + " input[name = confirm_password]").val("");
		alert("Passwords do not match.");
		return false;
	}
	if(question === null)
	{
		alert("Please select a question.");
		return false;
	}
	return true;
}

// cart page

$(".item input").keyup(function(){
	var item = $(this).attr("name");
	var ngoName = ("select[name='" + item + "_name"  + "']");
	$(ngoName).removeAttr('disabled');
	$(ngoName).attr('required',true);
	$(ngoName).removeClass("error");
});
	
	//functions to enable/disable ngo dropdowns
$(".item input").change(checkQuantity);
$(".item input").click(checkQuantity);
function checkQuantity()
{
	$(ngoName).removeClass("error");
	var item = $(this).attr("name");
	var num = Number($(this).val());
	var ngoName = ("select[name='" + item + "_name"  + "']");
	if(!isNaN(num) && (num >= 1 && num <= 100) )
	{
		$(this).val(Math.floor(num));
		$(ngoName).removeAttr('disabled');
	}
	else
	{
		$(this).val(0);
		$(ngoName).attr('disabled',true);
	}
}

$(".item select").click(function(){
	$(this).removeClass("error");
});

	//cart validations
function validateCart()
{
	var valid = true;
	var item_count = false; //To check if atleast one item is selected by user
	$(".item input").each(function() {
  		if(Number($(this).val()) > 0)
  		{
  			item_count = true;
  			var item = $(this).attr("name");
  			var ngoName = ("select[name='" + item + "_name"  + "']");
  			if($(ngoName).val() === null)
  			{
  				$(ngoName).addClass("error");
  				valid = false;
  			}
  		}
	});
	if(!valid){
		alert("Please select any NGO or Warehouse from the dropdown.");
	}
	if(!item_count && valid){
		valid = false;
		alert("Please select atleast one item.");
	}
	return valid;
}
