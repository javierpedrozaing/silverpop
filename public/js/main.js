$(document).ready(function(){

    $('.select-product').selectpicker();
    $('.select-document').selectpicker();
    var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn'),    
    allPrevBtn = $('.prevBtn');

    sendBtn = $('.sendBtn'),    
    
    fieldRequired = "<span>Campo requerido*</span>",
    allWells.hide();
      
        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);
      
            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });
        
        allPrevBtn.click(function() {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
      
                prevStepWizard.removeAttr('disabled').trigger('click');
        });
      
        allNextBtn.click(function() {    
            var isValid = true,  
            curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");
            curStep.find('.field-required').html('');    
            var curSelect = curStep.find("select");                        
            $(".form-group").removeClass("has-error");
         
            for(var i=0; i<curSelect.length; i++) {                                
                if (curSelect[i].value.length <= 0) {                    
                    isValid = false;
                    $(curSelect[i]).closest(".form-group").addClass("has-error");                    
                    $(curSelect[i]).closest(".form-group").find('.field-required').html(fieldRequired);
                }
            }
                     
            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        sendBtn.click(function(e) {    
            e.preventDefault();    
            var isValid = true,             
            curStep = $(this).closest(".setup-content"),        
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            curRadios = curStep.find("input[type='radio']"),
            curSelect = curStep.find("select");
            $(".form-group").removeClass("has-error");   
            curStep.find('.field-required').html('');     
            
            for(var i=0; i < curSelect.length; i++) {                 
                if (curSelect[i].value.length <= 0) {                    
                    isValid = false;
                    $(curSelect[i]).closest(".form-group").addClass("has-error");                    
                    $(curSelect[i]).closest(".form-group").find('.field-required').html(fieldRequired);
                }
            }
            
            for(var i=0; i<curInputs.length; i++) {
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                    $(curInputs[i]).closest(".form-group").find('.field-required').html(fieldRequired);
                }
            }

         
            for(var i=0; i<curRadios.length; i++){                
                if (!curRadios[i].checked) {
                    isValid = false;                    
                    $(curRadios[i]).closest(".form-group").addClass("has-error");
                    $(curRadios[i]).closest(".form-group").find('.field-required').html(fieldRequired);                    
                }
            }            
            if (isValid){                                               
                //console.log($(this[0]));
                $(this).trigger('submit');
                setData();              
            }
        });
      
    $('div.setup-panel div a.btn-primary.first').trigger('click');
    
});    

function setData() {
    console.log("set data");
    var send = true;
    var dataUser = {
        'document': 1234,
        'name': 'Javier',
        'lastName': 'Pedroza',
        'JOB_ID': 254
    }
    if(send) {
        $.ajax({
            type:'POST', 
            url:'/setData',
            data:{dataUser},
 
            success:function(data){
 
               console.log("response ", data);
            }
         });       	
    }
	// console.log($('#description').val());
	// console.log($('#url').val());
	// $('.loader').show();
	// var send = true;
	// if($('#type').val() == '')
	// 	send = false;
	// if($('#description').val() == '')
	// 	send = false;
	// if(send){
	// 	$.post( "index.php", { 
	// 		ajax: true,
	// 		task: "setData",
	// 		type: $('#type').val(),
	// 		description: $('#description').val(),
	// 		url: $('#url').val()
	// 	})
	// 	.done(function( data ) {
	// 		console.log('finish');
	// 		$('.loader').hide();
	// 		var info = $.parseJSON(data);
	// 		if(info.response)
	// 			alert('Mensaje enviado con exito con el ID: ' + info.message);
	// 		else
	// 			alert('Ocurrio un error enviando el mailing');
	// 	});
	// }
}
