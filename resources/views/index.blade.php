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
                <div class="col-xs-12 col-lg-4 col-lg-offset-3">
                  <p>Escoge aquí los productos de los que quieres recibir información.</p>
                  <div class="form-group">
                        <select  title="¿Qué producto buscas?" class="selectpicker"  multiple data-max-options="3" id="select-product" data-live-search="true" >                               
                            <optgroup data-max-options="3">
                               @foreach ($products as $product)
                                 <option data-tokens="{{$product}}">{{$product}}</option>                                
                               @endforeach
                            </optgroup>
                        </select>
                        <p class="field-required"></p>
                        <p>- Puedes escoger máximo 3 productos</p>   
                  </div>               
                  <button class="btn btn-primary nextBtn" type="button">Siguiente</button>
                </div>
              
            </div>
            <div class="row setup-content" id="step-2">
              <div class="col-xs-12 col-lg-4 ">
                    <p>Completa el formulario y recibe información de los productos que más te gustan.</p>
                               
                    <div class="form-group">                    
                        <select class="selectpicker" id="select-document" title="Tipo de documento*">
                                <option>Cédula d extranjería</option>
                                <option>Cédula de ciudadanía</option>
                                <option>Tarjeta pasaporte</option>
                        </select>          
                        <p class="field-required"></p>                
                    </div>
                    <div class="form-group">                    
                        <input maxlength="200" type="text" required="required" class="form-control" novalidate="true"  name="document"  placeholder="Número de documento" >
                        <p class="field-required"></p>
                    </div>
                    <div class="form-group">                    
                        <input maxlength="200" type="text" required="required" class="form-control" name="name" placeholder="Nombre*" >
                        <p class="field-required"></p>
                    </div>
                    <div class="form-group">                    
                        <input maxlength="200" type="text" required="required" class="form-control" name="lastName" placeholder="Apellido*">
                        <p class="field-required"></p>
                    </div>
                    <div class="form-group">                    
                        <input maxlength="200" type="text" required="required" class="form-control" name="cellphone" placeholder="Celular*">
                        <p class="field-required"></p>
                    </div>
                    <div class="form-group">                    
                        <input maxlength="200" type="text" required="required" class="form-control" name="email" placeholder="Correo electrónico**">
                        <p class="field-required"></p>
                    </div>

                    <p>Los campos marcados con * son obligatorios</p>
                    <br>

                    <div class="form-group custom-control custom-radio">    
                      <div class="form-control"><input type="radio" name="" id="accept_terms" class="custom-control-input" placeholder=""></div>                                      
                      <small id="helpId" class="text-muted">Acepto <a href="">terminos y condiciones</a> y autorizo el  <a>tratamiento de mis datos personales</a></small>
                      <br>
                      <p class="field-required"></p>
                    </div>
                  <!--<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button> -->
                  <button class="btn btn-primary sendBtn" type="submit">Enviar</button>                
              </div>
            </div>        
          </form>          
        </div>
        <div class="modal-success">
          
        </div>
@endsection