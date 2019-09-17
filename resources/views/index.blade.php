@extends('layouts.app')

@section('title', 'Días de Precios Especiales')

@section('content')  
        <div class="stepwizard .col-lg-3 .offset-lg-3 col-xs-12">
            <div class="stepwizard-row setup-panel">
              <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary first btn-circle">1</a>
                <p>Escoge los productos</p>
              </div>
              <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Completa el formulario</p>
              </div>              
            </div>
        </div>
          
          <form role="form" action="" method="post">
            <div class="row setup-content" id="step-1">              
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                  <p>Escoge aquí los productos de los que quieres recibir información.</p>
                    <div class="form-group">
                        <select  title="¿Qué producto buscas?" class="selectpicker"  multiple data-max-options="3" id="selectProduct" data-live-search="true" >                               
                            <optgroup data-max-options="3">
                               @foreach ($products as $product)
                                 <option data-tokens="{{$product}}">{{$product}}</option>                                
                               @endforeach
                            </optgroup>
                        </select>
                        <p class="field-required"></p>
                        <p>Puedes escoger máximo 3 productos</p>   
                    </div>
                  <button class="btn btn-primary nextBtn" type="button">Siguiente</button>
                </div>
              
            </div>
            <div class="row setup-content" id="step-2">              
                <p>Veriica que tu información este correcta. De lo contrario puedes editarla</p>                               
                <div class="col-xs-12 col-md-6 ">
                    <div class="form-group">  
                        <label for="typeDocument">Tipo de documento*</label>                  
                        <select class="selectpicker" name="typeDocument" id="selectDocument" title="Tipo de documento*">
                                <option value="cc">Cédula de ciudadanía</option>
                                <option value="cedula_extranjeria">Cédula de extranjería</option>
                                <option value="tarjeta_profesional">Tarjeta pasaporte</option>
                        </select>          
                        <p class="field-required"></p>                
                    </div>
                    <div class="form-group">   
                        <label for="documento">Número de documento*</label>                 
                        <input maxlength="200" type="text" required="required" class="form-control" id="document" novalidate="true"  name="document"  placeholder="Número de documento" >
                        <p class="field-required"></p>
                    </div>
                    <div class="form-group">           
                      <label for="name">Nombre*</label>         
                        <input maxlength="200" type="text" required="required" class="form-control" id="name" name="name" placeholder="Nombre*" >
                        <p class="field-required"></p>
                    </div>
              </div>
              <div class="col-xs-12 col-md-6" id="more-info">
                    <div class="form-group">                   
                        <label for="lastName">Apellido*</label>          
                        <input maxlength="200" type="text" required="required" class="form-control" id="lastName" name="lastName" placeholder="Apellido*">
                        <p class="field-required"></p>
                    </div>
                    <div class="form-group">    
                        <label for="cellphone">Celular*</label>                    
                        <input maxlength="200" type="text" required="required" class="form-control" id="cellPhone" name="cellphone" placeholder="Celular*">
                        <p class="field-required"></p>
                    </div>
                    <div class="form-group">                    
                        <label for="email">Correo electrónico*</label>    
                        <input maxlength="200" type="text" required="required" class="form-control" id="email" name="email" placeholder="Correo electrónico**">
                        <p class="field-required"></p>
                    </div>
              </div>              
             
                <p class="info-required">Los campos marcados con * son obligatorios</p>                         
                    <div class="form-group custom-control custom-radio">    
                      <div class="form-control"><input type="radio" name="accept_terms" id="accept_terms" class="custom-control-input" placeholder=""></div>                                      
                      <small id="helpId" class="text-muted">Acepto <a href="">terminos y condiciones</a> y autorizo el  <a>tratamiento de mis datos personales</a></small>
                      <br>
                    
                    </div>
                    <p class="field-required"></p>
                  <!--<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button> -->
                  <button class="btn btn-primary sendBtn" type="submit">Enviar</button>                
             
            </div>   
            
            
          </form>          
        </div>        
@endsection