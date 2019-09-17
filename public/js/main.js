$(document).ready(function(){

    $(".modal-success-desktop .close-modal").click(function(){
        $(".modal-success-desktop").hide();
    });

    var selectedProduct = new Array;
    var selectedDocument;
    $("#selectProduct").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        if (isSelected) {
            selectedProduct.push(e.target.options[clickedIndex].value);            
        }
        
        console.log("selected product", selectedProduct);
    
    });
    $("#selectDocument").change(function(){
        selectedDocument = $(this).children("option:selected").val();        
        console.log("selected document type ", selectedDocument);

    });

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
                setData(selectedProduct, selectedDocument);              
            }
        });
      
    $('div.setup-panel div a.btn-primary.first').trigger('click');
    autocomplete();
});    

function autocomplete(){
    $("#document").focusout(function(){
        var get_document = $(this).val();
        if (get_document.length > 0) {
            console.log("documento ", get_document.length);
            $.ajax({
                type:'POST', 
                url:'/getData',
                data: {document: get_document},
    
                success:function(data){ 
                   console.log("response ", data);
                 
                }
             }); 
        }
    });
}

function setData(selectedProduct, selectedDocument) {
    console.log("set data");
    var send = false;
   
    var products = selectedProduct;
    var typedocument = selectedDocument;
    var document = $("#document").val();    
    var name = $("#name").val();
    var lastName = $("#lastName").val();
    var cellphone = $("#cellPhone").val();
    var email = $("#email").val();
    var accept_terms = $("input[name='accept_terms']:checked").val();

    
    if (products && typedocument && document && name && lastName && cellphone && email && accept_terms) {
        send = true;
    }
    var dataUser = {
        'product': products,
        'typedocument': typedocument,
        'document': document,
        'name': name,
        'lastName': lastName,
        'cellphone': cellphone,
        'email': email,
        'accept_terms' : accept_terms == 'on' ? 'si' : 'no',
    }
   

    if(send) {
        console.log("datos completos ? ", send, dataUser);
        $.ajax({
            type:'POST', 
            url:'/setData',
            data:{dataUser},
 
            success:function(data){ 
               console.log("response ", data);
               $('.modal-success-desktop').show();
            }
         });       	
    }

}
