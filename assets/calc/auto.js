/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */
	      
//adds extra table rows
var i=$('table tr').length;
$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" data-type="itemcode" name="itemCode[]" id="itemCode_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
	html += '<td><input type="text" data-type="description" name="itemName[]" id="itemName_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
	html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="text" name="price[]" id="price_'+i+'" readonly class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="text" name="taxP[]" id="taxP_'+i+'" class="form-control changesNo autocomplete_txt" value="0" autocomplete="off"></td>';
	html += '<td><input type="text" name="tax[]" id="tax_'+i+'" readonly class="form-control totaltaxprice changesNo autocomplete_txt" value="0" autocomplete="off"></td>';
	html += '<td><input type="text" name="total[]" id="total_'+i+'" readonly class="form-control totalLinePrice" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>';
	html += '</tr>';
	$('table').append(html);
	i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calculateTotal();
});

//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
	type = $(this).data('type');
	
	if(type =='itemcode' )autoTypeNo=0;
	if(type =='description' )autoTypeNo=1; 	
	
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'homepage/ajax',
				dataType: "json",
				method: 'post',
				data: {
				   name_startsWith: request.term,
				   type: type
				},
				 success: function( data ) {
					 response( $.map( data, function( item ) {
					 	var code = item.split("|");
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");						
			id_arr = $(this).attr('id');
	  		id = id_arr.split("_");
			$('#itemCode_'+id[1]).val(names[0]);
			$('#itemName_'+id[1]).val(names[1]);
			$('#quantity_'+id[1]).val(1);
			$('#price_'+id[1]).val(names[2]);
			
			$('#total_'+id[1]).val( 1 * names[2] );
			/*$('#taxP'+id[1]).val(names[2]);
			$('#tax'+id[1]).val(names[3]);
			$('#total_'+id[1]).val( 1*names[1] );*/
			calculateTotal();
		}		      	
	});
});

//price change
$(document).on('change keyup blur','.changesNo',function(){
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
	
	quantity = $('#quantity_'+id[1]).val();
	price = $('#price_'+id[1]).val();
	
	taxpercent = $('#taxP_'+id[1]).val();
	tax = $('#tax_'+id[1]).val();
	
	if( quantity!='' && price !='' ) 
	{
		$('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );	
		
	}
		
	
	if(taxpercent!='' && quantity!='' && price !='')
	{
		tax = (((parseFloat(price)*parseFloat(quantity)).toFixed(2)) * taxpercent) / 100;
		$('#tax_'+id[1]).val(tax);
		total = (parseFloat(price) * parseFloat(quantity)).toFixed(2);
		
		amt = parseFloat(tax) + parseFloat(total);
		$('#total_'+id[1]).val(amt);
	}
	
	
	//$('#taxtotal').val(taxtotal.toFixed(2));
	
	calculateTotal();
});

$(document).on('change keyup blur','#tax',function(){
	calculateTotal();
});

//total price calculation 
function calculateTotal(){
	
	subTotal = 0 ; total = 0; taxtotal = 0;
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	
	$('.totaltaxprice').each(function(){
		if($(this).val() != '' )taxtotal += parseFloat( $(this).val() );
	});
	
	roundoff = Math.ceil(subTotal.toFixed(2)) - subTotal.toFixed(2);
	
	$('#round_off').val( roundoff.toFixed(2) );
	
	$('#netamount').val( Math.ceil(subTotal.toFixed(2)) );
	$('#taxtotal').val(taxtotal.toFixed(2));
	
	$('#subTotal').val(subTotal.toFixed(2) - taxtotal.toFixed(2))
	
	/*tax = $('#taxtotal').val();
	if(tax != '' && typeof(tax) != "undefined" ){
		taxAmount = subTotal * ( parseFloat(tax) /100 );
		$('#taxAmount').val(taxAmount.toFixed(2));
		total = subTotal + taxAmount;
	}else{
		$('#taxAmount').val(0);
		total = subTotal;
	}
	$('#totalAftertax').val( total.toFixed(2) );
	calculateAmountDue();
	*/
	
	//$(this).autocomplete({
		$.ajax({
			url : 'homepage/word',
			dataType: "text",
			method: 'post',
			data: {
			   amount: $('#netamount').val(),
			},
			success: function( data ) {
				$("#rupeeinwords").text(data);
			}
		});
	//});
}

$(document).on('change keyup blur','#amountPaid',function(){
	calculateAmountDue();
});

//due amount calculation
function calculateAmountDue(){
	amountPaid = $('#amountPaid').val();
	total = $('#totalAftertax').val();
	if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
		amountDue = parseFloat(total) - parseFloat( amountPaid );
		$('.amountDue').val( amountDue.toFixed(2) );
	}else{
		total = parseFloat(total).toFixed(2);
		$('.amountDue').val( total );
	}
}


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

//datepicker
$(function () {
    $('#quotationdate').datepicker({});
});

function frmvalidation()
{
	var name = $('#name').val();
	var contactno = $('#contactno').val();
	var address = $('#address').val();
	var retail_contact = $('#retail_contact').val();
	var mailid = $('#mailid').val();
	var tin = $('#tin').val();
	var cst = $('#cst').val();
	var salesperson = $('#salesperson').val();
	var term = $('#term').val();
	var refnumber = $('#refnumber').val();
	var quotationdate = $('#quotationdate').val();
	var itemName_1 = $('#itemName_1').val();
	var valid=true;
	
	var errorstr = '';
	
	if(name==''){
		valid = false;
		errorstr += "Enter valid name!"+ "<BR/>";
	}
	
	if(contactno==''){
		valid = false;
		errorstr += "Enter valid Customer Contact Number!"+ "<BR/>";
	}
	
	if(address==''){
		valid = false;
		errorstr += "Enter valid address!"+ "<BR/>";
	}
	
	if(retail_contact==''){
		valid = false;
		errorstr += "Enter valid retail contact!"+ "<BR/>";
	}
	
	if(mailid==''){
		valid = false;
		errorstr += "Enter valid mail ID!"+ "<BR/>";
	}
	
	if(tin==''){
		valid = false;
		errorstr += "Enter valid TIN!"+ "<BR/>";
	}
	
	if(cst==''){
		valid = false;
		errorstr += "Enter valid cst!"+ "<BR/>";
	}
	
	if(salesperson==''){
		valid = false;
		errorstr += "Enter valid sale person!"+ "<BR/>";
	}
	
	if(term==''){
		valid = false;
		errorstr += "Enter valid term and condition!"+ "<BR/>";
	}
	
	if(term==''){
		valid = false;
		errorstr += "Enter valid term and condition!"+ "<BR/>";
	}
	
	
	if(refnumber==''){
		valid = false;
		errorstr += "Enter valid reference number!"+ "<BR/>";
	}
	
	
	if(quotationdate==''){
		valid = false;
		errorstr += "Enter valid Quotation Date!"+ "<BR/>";
	}
	
	if(itemName_1==''){
		valid = false;
		errorstr += "Enter valid Description"+ "<BR/>";
	}
	
	if(!valid)
	{
		alert(errorstr);
	}
	
	return true;
	
}