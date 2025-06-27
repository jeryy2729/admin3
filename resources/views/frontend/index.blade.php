@extends('frontend.layouts.main')

@section('main-container')
<div class="main-wrapper">
    <div class="container-fluid px-0"> {{-- Full-width layout with no side padding --}}
        <div class="row g-0"> {{-- No gutters between columns --}}

            {{-- Sidebar --}}

            {{-- Main Content --}}
            <div class="col-md-12">
                <div class="container py-4"> {{-- Consistent inner spacing with categories page --}}

                    <!-- Slider Section -->
                    <section class="slider mb-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="block">
                                        <span class="d-block mb-3 text-white text-capitalize">Prepare for new future</span>
                                        <h1 class="animated fadeInUp mb-5">Our work is <br>presentation of our <br>capabilities.</h1>
                                        <a href="#" class="btn btn-main animated fadeInUp btn-round-full">
                                            Get started<i class="btn-icon fa fa-angle-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Intro Section -->
                    <section class="section intro">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                    <span class="h6 text-color">We are creative & expert people</span>
                                    <h2 class="mt-3 content-title">We work with business & provide solution to client with their business problem</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="intro-item mb-4">
                                    <i class="ti-desktop color-one"></i>
                                    <h4 class="mt-4 mb-3">Modern & Responsive design</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, ducimus.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="intro-item mb-4">
                                    <i class="ti-medall color-one"></i>
                                    <h4 class="mt-4 mb-3">Awarded licensed company</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, ducimus.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="intro-item mb-4">
                                    <i class="ti-layers-alt color-one"></i>
                                    <h4 class="mt-4 mb-3">Build your website Professionally</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, ducimus.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                </div> {{-- End container --}}
            </div> {{-- End col-md-9 --}}
        </div>
    </div>
</div>
@endsection
