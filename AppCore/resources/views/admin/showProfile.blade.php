@extends('layouts.admin.main')
@section('title')Perfil @endsection

@push('css')
    <link rel="stylesheet" href="{{asset('AppResources/plugins/dropify/dist/css/dropify.min.css')}}">
    <style type="text/css">
        .dropify-wrapper{
            height: 300px;
        }
    </style>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perfil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Perfil</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" id="app-main">

    <!-- Default box -->
    <form onsubmit="return false;" id="form_" class="form form-vertical">
        <div class="card">
            <div class="overlay dark" v-if="loading">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
            <div class="card-header">
                <h3 class="card-title">Información de perfil</h3>
            </div>
            <div class="card-body">
                <div class="card-content">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Imagen de perfil *</label>
                                            <div class="position-relative has-icon-left" id="image">
                                                <input type="file" class="dropify" id="image" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>Nombre *</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Ingrese su nombre" name="name" v-model="user.name">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-portrait"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>Apellido *</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Ingrese su apellido" name="last_name" v-model="user.last_name">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-portrait"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>Cédula de Identidad *</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Ingrese su cédula de identidad" name="dni" v-model="user.dni">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-portrait"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>Correo Electónico *</label>
                                                    <div class="input-group mb-3">
                                                        <input type="email" class="form-control" placeholder="Correo Electónico" name="email" v-model="user.email">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-envelope"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Código postal *</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Ingrese el código postal" name="postal_code" v-model="user.postal_code">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-mail-bulk"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Teléfono *</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Ingrese su número de teléfono" name="phone" v-model="user.phone">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Dirección Detallada *</label>
                                    <div class="input-group">
                                        <textarea class="form-control" placeholder="Dirección detallada" name="address" rows="3" v-model="user.address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="card-header">
                                    <h4 class="card-title">Contraseña de acceso al sistema</h4>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Contraseña *</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Ingrese el barrio del cocinero" id="password" name="password" v-model="user.password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-secret"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Confirmar contraseña *</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Ingrese el barrio del cocinero" id="password2" name="password2" v-model="user.password2">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-secret"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="alert alert-primary" role="alert">
                                    <h4 class="alert-heading">IMPORTANTE: </h4>
                                    <p class="mb-0">
                                        Todos los campos con (*) deben ser completados
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <button type="button" id="form-close-modal" class="btn btn-dark mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light float-right" :disabled="loading == true">
                            <template v-if="!loading">
                                <i class="fa fa-sign-in"></i> Guardar
                            </template>
                            <template v-if="loading">
                                <i class="fa fa-spinner fa-spin"></i>
                            </template>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
    </form>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@push('js')
<script type="text/javascript" src="{{asset('AppResources/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{ asset('AppResources/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('AppResources/js/admin/users/profile.js') }}"></script> 
@endpush
