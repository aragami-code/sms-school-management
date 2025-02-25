@extends('backend.layouts.master')


@section('title')

TABLEAU DE BORD
@endsection


@section('admin-content')


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Acceuil</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Acceuil</a></li>
                    <li><span>Statistiques</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('backend.layouts.partials.logout')


        </div>
    </div>
    <div class="main-content-inner">
        <div class="row">
            <!-- seo fact area start -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-4 mt-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg1">
                            <a href="{{--route('admin.postemplois.create')--}}">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-briefcase"></i>Creer une offre</div>

                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                   {{-- --}}<div class="col-md-4 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg1">
                              <a href="{{--route('admin.postemplois.matcher')--}}">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-search"></i>Rechercher une Offre</div>

                                </div>
                              </a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg1">
                                <a href="{{route('admin.articles.create')}}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"> <i class="ti-clipboard"></i>Creer un article</div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>






                </div>
            </div>
            <!-- seo fact area end -->

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-3 mt-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg1">
                            <a href="{{route('admin.users.index')}}"></a>
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-user"></i> Utilisateurs</div>
                                    <h2>{{--$total_users--}}</h2>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                   {{-- --}}<div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg2">
                              <a href="{{route('admin.admins.index')}}">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-user"></i> Administrateurs</div>
                                    <h2>{{$total_admins}}</h2>
                                </div>
                              </a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg3">
                                <a href="{{route('admin.roles.index')}}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"> <i class="ti-lock"></i>Roles</div>
                                        <h2>{{$total_roles}}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg4">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"> <i class="ti-eye"></i>permissions</div>
                                    <h2>{{$total_permissions}}</h2>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg4">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"> <i class="ti-clipboard"></i>Articles</div>
                                    <h2>{{$total_articles}}</h2>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg1">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"> <i class="ti-briefcase"></i>Emplois postulés</div>
                                    <h2>{{--$total_emplois--}}</h2>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>





@endsection
