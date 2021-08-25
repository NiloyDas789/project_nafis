<?php $__env->startSection('style'); ?>

<style>
    body {
      font-family: "Lato", sans-serif;
    }

    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: white;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidebar a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover {
      color: #f1f1f1;
    }

    .sidebar .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    .openbtn {
      font-size: 20px;
      cursor: pointer;
      background-color: #111;
      color: white;
      padding: 10px 15px;
      border: none;
    }

    .openbtn:hover {
      background-color: #444;
    }

    #main {
      transition: margin-left .5s;
      padding: 16px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media  screen and (max-height: 450px) {
      .sidebar {padding-top: 15px;}
      .sidebar a {font-size: 18px;}
    }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "40%";
      document.getElementById("main").style.marginLeft = "80%";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<main class="main" id="main">
    <div class="intro-section bg-lighter pt-5 pb-6">
        <div class="container">
            <!-- End .row -->


            
            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <?php if(Session::has('stock_add_message')): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>">
                                <?php echo e(Session::get('stock_add_message')); ?></p>
                            <?php echo e(Session::forget('stock_add_message')); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-7">

                                        <br>


                                        <div class="row products" id="products">
                                            <div class="col-md-12">
                                                <div class="timeline-body">
                                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-3" id="<?php echo e($product->id); ?>"
                                                            style="margin-left: 10px; margin-right: 10px;">
                                                            <div class="row text-center">
                                                                <span class="" style="margin-left: 10px;">
                                                                    <?php echo e(mb_strimwidth($product->title, 0, 25, '...')); ?>

                                                                </span>
                                                            </div>
                                                            <div class="row text-center">
                                                                <img src="<?php echo e($product->image_path); ?>" height="100" width="150"
                                                                    class="margin" style=""
                                                                    onclick="onImageClick(<?php echo e($product->id); ?>, <?php echo e($product->unit_price); ?>, '<?php echo e(strval($product->title)); ?>', '<?php echo e(strval($product->art_no)); ?>', <?php echo e($product->stock); ?>)"
                                                                    id="img-<?php echo e($product->id); ?>">
                                                            </div>
                                                            <div class="row text-center">
                                                                Stock: <?php echo e($product->stock); ?>

                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row bundles" id="bundles">
                                            <div class="col-md-12">
                                                <div class="timeline-body">
                                                    <?php $__currentLoopData = $bundles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bundle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-3" id="<?php echo e($bundle->id); ?>"
                                                            style="margin-left: 10px; margin-right: 10px;">
                                                            <div class="row text-center">
                                                                <span class="" style="margin-left: 10px;">
                                                                    <?php echo e(mb_strimwidth($bundle->name, 0, 25, '...')); ?>

                                                                </span>
                                                            </div>
                                                            <div class="row text-center">
                                                                <img src="public/uploads/default.png" height="100" width="150"
                                                                    class="margin" style=""
                                                                    onclick="selectBundle(<?php echo e($bundle->id); ?>)"
                                                                    id="img-bn-<?php echo e($bundle->id); ?>">
                                                            </div>
                                                            <div class="row text-center">
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>

            </section>

            <div class="mb-6"></div><!-- End .mb-6 -->

            <div class="owl-carousel owl-simple" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": false,
                    "margin": 30,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":2
                        },
                        "420": {
                            "items":3
                        },
                        "600": {
                            "items":4
                        },
                        "900": {
                            "items":5
                        },
                        "1024": {
                            "items":6
                        }
                    }
                }'>
                <a href="#" class="brand">
                    <img src="<?php echo e(asset('public')); ?>/assets/images/brands/1.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="<?php echo e(asset('public')); ?>/assets/images/brands/2.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="<?php echo e(asset('public')); ?>/assets/images/brands/3.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="<?php echo e(asset('public')); ?>/assets/images/brands/4.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="<?php echo e(asset('public')); ?>/assets/images/brands/5.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="<?php echo e(asset('public')); ?>/assets/images/brands/6.png" alt="Brand Name">
                </a>
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .bg-lighter -->

    <div class="mb-6"></div><!-- End .mb-6 -->

    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">Trendy Products</h2><!-- End .title -->

            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trendy-all-link" data-toggle="tab" href="#trendy-all-tab" role="tab" aria-controls="trendy-all-tab" aria-selected="true">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trendy-fur-link" data-toggle="tab" href="#trendy-fur-tab" role="tab" aria-controls="trendy-fur-tab" aria-selected="false">Furniture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trendy-decor-link" data-toggle="tab" href="#trendy-decor-tab" role="tab" aria-controls="trendy-decor-tab" aria-selected="false">Decor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trendy-light-link" data-toggle="tab" href="#trendy-light-tab" role="tab" aria-controls="trendy-light-tab" aria-selected="false">Lighting</a>
                </li>
            </ul>
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-1-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-1-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Butler Stool Ladder</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $251,00
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->

                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-2-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-2-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Octo 4240</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $746,00
                            </div><!-- End .product-price -->

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #1f1e18;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->

                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <span class="product-label label-new">NEW</span>
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-3-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-3-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Flow Slim Armchair</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $970,00
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->

                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <span class="product-label label-sale">30% OFF</span>
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-4-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-4-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Roots Sofa Bed</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                <span class="new-price">$337,00</span>
                                <span class="old-price">Was $449,00</span>
                            </div><!-- End .product-price -->

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #878883;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #dfd5c2;"><span class="sr-only">Color name</span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->

                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-5-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-5-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Petite Table Lamp</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $675,00
                            </div><!-- End .product-price -->

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #74543e;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->

                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-6-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-6-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Elephant Armchair</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $457,00
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->

                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-1-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-1-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Butler Stool Ladder</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $251,00
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="trendy-fur-tab" role="tabpanel" aria-labelledby="trendy-fur-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <span class="product-label label-new">NEW</span>
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-3-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-3-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Flow Slim Armchair</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $970,00
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->

                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <span class="product-label label-sale">30% OFF</span>
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-4-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-4-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Roots Sofa Bed</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                <span class="new-price">$337,00</span>
                                <span class="old-price">Was $449,00</span>
                            </div><!-- End .product-price -->

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #878883;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #dfd5c2;"><span class="sr-only">Color name</span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="trendy-decor-tab" role="tabpanel" aria-labelledby="trendy-decor-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-1-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-1-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Butler Stool Ladder</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $251,00
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-6-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-6-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Elephant Armchair</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $457,00
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="trendy-light-tab" role="tabpanel" aria-labelledby="trendy-light-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-2-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-2-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Octo 4240</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $746,00
                            </div><!-- End .product-price -->

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #1f1e18;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <a href="product.html">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-5-1.jpg" alt="Product image" class="product-image">
                                <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-5-2.jpg" alt="Product image" class="product-image-hover">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->

                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">Petite Table Lamp</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                $675,00
                            </div><!-- End .product-price -->

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #74543e;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    <div class="container categories pt-6">
        <h2 class="title-lg text-center mb-4">Shop by Categories</h2><!-- End .title-lg text-center -->

        <div class="row">
            <div class="col-6 col-lg-4">
                <div class="banner banner-display banner-link-anim">
                    <a href="#">
                        <img src="<?php echo e(asset('public')); ?>/assets/images/banners/home/banner-1.jpg" alt="Banner">
                    </a>

                    <div class="banner-content banner-content-center">
                        <h3 class="banner-title text-white"><a href="#">Outdoor</a></h3><!-- End .banner-title -->
                        <a href="#" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-sm-6 col-lg-3 -->
            <div class="col-6 col-lg-4 order-lg-last">
                <div class="banner banner-display banner-link-anim">
                    <a href="#">
                        <img src="<?php echo e(asset('public')); ?>/assets/images/banners/home/banner-4.jpg" alt="Banner">
                    </a>

                    <div class="banner-content banner-content-center">
                        <h3 class="banner-title text-white"><a href="#">Lighting</a></h3><!-- End .banner-title -->
                        <a href="#" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-sm-6 col-lg-3 -->
            <div class="col-sm-12 col-lg-4 banners-sm">
                <div class="row">
                    <div class="banner banner-display banner-link-anim col-lg-12 col-6">
                        <a href="#">
                            <img src="<?php echo e(asset('public')); ?>/assets/images/banners/home/banner-2.jpg" alt="Banner">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h3 class="banner-title text-white"><a href="#">Furniture and Design</a></h3><!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->

                    <div class="banner banner-display banner-link-anim col-lg-12 col-6">
                        <a href="#">
                            <img src="<?php echo e(asset('public')); ?>/assets/images/banners/home/banner-3.jpg" alt="Banner">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h3 class="banner-title text-white"><a href="#">Kitchen & Utensil</a></h3><!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div>
            </div><!-- End .col-sm-6 col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- End .mb-6 -->


    <div class="container">
        <div class="heading heading-center mb-6">
            <h2 class="title">Recent Arrivals</h2><!-- End .title -->

            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="top-fur-link" data-toggle="tab" href="#top-fur-tab" role="tab" aria-controls="top-fur-tab" aria-selected="false">Furniture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="top-decor-link" data-toggle="tab" href="#top-decor-tab" role="tab" aria-controls="top-decor-tab" aria-selected="false">Decor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="top-light-link" data-toggle="tab" href="#top-light-tab" role="tab" aria-controls="top-light-tab" aria-selected="false">Lighting</a>
                </li>
            </ul>
        </div><!-- End .heading -->

        <div class="tab-content">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-12-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-12-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Block Side Table/Trolley</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $229,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-10-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-10-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Carronade Suspension Lamp</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $892,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->

                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">NEW</span>
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-9-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-9-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Garden Armchair</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $94,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-8-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-8-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Madra Log Holder</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $104,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #927764;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->

                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-11-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-11-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Original Outdoor Beanbag</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $259,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-13-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-13-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">2-Seater</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $3.107,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-14-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-14-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Wingback Chair</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $2.486,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #999999;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #cc9999;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">NEW</span>
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-16-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-16-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Decor</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Cushion Set 3 Pieces</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $199,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .products -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="top-fur-tab" role="tabpanel" aria-labelledby="top-fur-link">
                <div class="products">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">NEW</span>
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-9-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-9-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Garden Armchair</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $94,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-12-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-12-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Block Side Table/Trolley</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $229,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-13-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-13-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">2-Seater</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $3.107,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .products -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="top-decor-tab" role="tabpanel" aria-labelledby="top-decor-link">
                <div class="products">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-8-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-8-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Madra Log Holder</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $104,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #927764;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->

                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-11-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-11-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Original Outdoor Beanbag</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $259,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-14-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-14-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Wingback Chair</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $2.486,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #999999;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #cc9999;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .products -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="top-light-tab" role="tabpanel" aria-labelledby="top-light-link">
                <div class="products">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-10-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-10-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html">Carronade Suspension Lamp</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $892,00
                                    </div><!-- End .product-price -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                    </div><!-- End .product-nav -->

                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-11 mt-v3 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">NEW</span>
                                    <a href="product.html">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-16-1.jpg" alt="Product image" class="product-image">
                                        <img src="<?php echo e(asset('public')); ?>/assets/images/demos/demo-2/products/product-16-2.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Decor</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Cushion Set 3 Pieces</a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        $199,00
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .products -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
        <div class="more-container text-center">
            <a href="#" class="btn btn-outline-darker btn-more"><span>Load more products</span><i class="icon-long-arrow-down"></i></a>
        </div><!-- End .more-container -->
    </div><!-- End .container -->

    <div class="container">
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <div class="icon-box icon-box-card text-center">
                    <span class="icon-box-icon">
                        <i class="icon-rocket"></i>
                    </span>
                    <div class="icon-box-content">
                        <h3 class="icon-box-title">Payment & Delivery</h3><!-- End .icon-box-title -->
                        <p>Free shipping for orders over $50</p>
                    </div><!-- End .icon-box-content -->
                </div><!-- End .icon-box -->
            </div><!-- End .col-lg-4 col-sm-6 -->

            <div class="col-lg-4 col-sm-6">
                <div class="icon-box icon-box-card text-center">
                    <span class="icon-box-icon">
                        <i class="icon-rotate-left"></i>
                    </span>
                    <div class="icon-box-content">
                        <h3 class="icon-box-title">Return & Refund</h3><!-- End .icon-box-title -->
                        <p>Free 100% money back guarantee</p>
                    </div><!-- End .icon-box-content -->
                </div><!-- End .icon-box -->
            </div><!-- End .col-lg-4 col-sm-6 -->

            <div class="col-lg-4 col-sm-6">
                <div class="icon-box icon-box-card text-center">
                    <span class="icon-box-icon">
                        <i class="icon-life-ring"></i>
                    </span>
                    <div class="icon-box-content">
                        <h3 class="icon-box-title">Quality Support</h3><!-- End .icon-box-title -->
                        <p>Alway online feedback 24/7</p>
                    </div><!-- End .icon-box-content -->
                </div><!-- End .icon-box -->
            </div><!-- End .col-lg-4 col-sm-6 -->
        </div><!-- End .row -->

        <div class="mb-2"></div><!-- End .mb-2 -->
    </div><!-- End .container -->
    <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
        <div class="container">
           <h2 class="title-lg text-center mb-3 mb-md-4">From Our Blog</h2><!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "items": 3,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "600": {
                            "items":2
                        },
                        "992": {
                            "items":3
                        }
                    }
                }'>
                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="<?php echo e(asset('public')); ?>/assets/images/blog/home/post-1.jpg" alt="image desc">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body pb-4 text-center">
                        <div class="entry-meta">
                            <a href="#">Nov 22, 2018</a>, 0 Comments
                        </div><!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Sed adipiscing ornare.</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit.<br>Pelletesque aliquet nibh necurna. </p>
                            <a href="single.html" class="read-more">Read More</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->

                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="<?php echo e(asset('public')); ?>/assets/images/blog/home/post-2.jpg" alt="image desc">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body pb-4 text-center">
                        <div class="entry-meta">
                            <a href="#">Dec 12, 2018</a>, 0 Comments
                        </div><!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Fusce lacinia arcuet nulla.</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            <p>Sed pretium, ligula sollicitudin laoreet<br>viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis justo. </p>
                            <a href="single.html" class="read-more">Read More</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->

                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="<?php echo e(asset('public')); ?>/assets/images/blog/home/post-3.jpg" alt="image desc">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body pb-4 text-center">
                        <div class="entry-meta">
                            <a href="#">Dec 19, 2018</a>, 2 Comments
                        </div><!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Quisque volutpat mattis eros.</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            <p>Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. </p>
                            <a href="single.html" class="read-more">Read More</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->
            </div><!-- End .owl-carousel -->
        </div><!-- container -->

        <div class="more-container text-center mb-0 mt-3">
            <a href="blog.html" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
        </div><!-- End .more-container -->
    </div>
    <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url(<?php echo e(asset('public')); ?>/assets/images/backgrounds/cta/bg-6.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9 col-xl-8">
                    <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                        <div class="col">
                            <h3 class="cta-title text-white">Sign Up & Get 10% Off</h3><!-- End .cta-title -->
                            <p class="cta-desc text-white">Molla presents the best in interior design</p><!-- End .cta-desc -->
                        </div><!-- End .col -->

                        <div class="col-auto">
                            <a href="login.html" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .col-auto -->
                    </div><!-- End .row no-gutters -->
                </div><!-- End .col-md-10 col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->
</main><!-- End .main -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.select2').select2()
        });

        // function alertOnEmptyCart() {
        //     if (document.getElementById('dynamic_field').rows.length < 2) {

        //     }
        // }
        // Search

        // Bundle and product showing toggle button
        var products = document.getElementById("products");
        var bundles = document.getElementById("bundles");
        var categoryTitle = document.getElementById("categoryTitle");

        bundles.style.display = "none"

        function selectProductShow() {
            products.style.display = "block"
            bundles.style.display = "none"
            categoryTitle.innerText = "Products"
        }

        function selectBundleShow() {
            bundles.style.display = "block"
            products.style.display = "none"
            categoryTitle.innerText = "Boundles"
        }

        function selectBundle(id) {
            fetch('api/bundle-products/' + id)
                .then(response => response.json())
                .then(data => {
                    data.forEach(a => onImageClick(a.id, a.unit_price, a.title, a.art_no, a.stock, a.quantity))
                });

            var styleValue = document.getElementById("img-bn-" + id).style.border;
            if (styleValue == '5px solid green') {
                document.getElementById("img-bn-" + id).style.border = '';
                // remove row from cart
                this.removeProductOnCross($id);
            } else {
                document.getElementById("img-bn-" + id).style.border = '5px solid green';
            }
        }


        const pId = [
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                [<?php echo e($p->id); ?>, "<?php echo e($p->title); ?>"],
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];

        var i = 0;

        function productSearchFunction() {
            var x = document.getElementById("productSearch").value;

            if (x == '') {
                console.log('All products:');
                pId.forEach(function(value) {
                    console.log(value[0], value[1]);
                    document.getElementById(value[0]).style.display = 'block';
                });
            } else {
                var filter = x.toUpperCase();
                pId.forEach(function(value) {
                    var textValue = value[1].toUpperCase();
                    console.log(textValue, filter);
                    if (textValue.indexOf(filter) !== -1) {
                        document.getElementById(value[0]).style.display = 'block';
                    } else {
                        document.getElementById(value[0]).style.display = 'none';
                    }
                });
            }
        }
        // Search End
        // Image select
        function onImageClick(prodId, unitPrice, title, artNo, stock, prevQuantity = 1) {
            console.log(stock);
            var styleValue = document.getElementById("img-" + prodId).style.border;
            if (styleValue == '5px solid green') {
                document.getElementById("img-" + prodId).style.border = '';
                // remove row from cart
                this.removeProductOnCross(prodId);
            } else {
                document.getElementById("img-" + prodId).style.border = '5px solid green';
                // add row in cart

                var table = document.getElementById('dynamic_field');
                var rowCount = document.getElementById('dynamic_field').rows.length;
                var row = table.insertRow(rowCount);
                row.id = 'row' + prodId;
                row.className = "targetfields";
                var cell0 = row.insertCell(0);
                var cell1 = row.insertCell(1);
                var cell2 = row.insertCell(2);
                var cell3 = row.insertCell(3);
                var cell4 = row.insertCell(4);
                var cell5 = row.insertCell(5);
                var cell6 = row.insertCell(6);

                cell0.innerHTML = artNo;
                cell1.innerHTML = title;

                cell2.innerHTML =
                    '<input type="number" name="quantity[]" id="quantity[]" class="form-control qty" value="' +
                    prevQuantity + '" min="1" max="' +
                    stock + '" onchange="matchUnitAndSubTotal()"/>';
                cell3.innerHTML =
                    '<input type="text" name="unitPrice[]" class="form-control" value="' + unitPrice + '" onchange="matchUnitAndSubTotal()"/>';
                cell4.innerHTML =
                    '<input type="text" name="subTotal[]" id="subTotal[]" class="form-control subtotal" value=""/>';

                cell5.innerHTML = '<button type="button" name="remove" id="' + rowCount +
                    '"  style="    width: 40px; background-color: #ff0000b3;color: white;" onclick="removeProductOnCross(' + prodId + ')">X&nbsp</button>';

                cell6.innerHTML = '<input type="hidden" name="productId[]" id="productId[]" class="form-control" value="' +
                    prodId + '"/>';
            }
        }

        function removeProductOnCross(button_id) {
            var rowId = 'row' + button_id;
            var row = document.getElementById(rowId);
            row.parentNode.removeChild(row);
            document.getElementById("img-" + button_id).style.border = '';
        }
        // Image select End
        // Update Form Fileds

        function calculatex() {
            var table = document.getElementById("dynamic_field");
            var totQty = 0;
            const val = document.querySelectorAll('.form-control.qty');
            let sum = 0;
            for (let v of val) {
                sum += parseInt(v.value);
                // console.log(sum);
            }
            var totalQty = document.getElementById('totalQty');
            totalQty.value = sum;

            const val2 = document.querySelectorAll('.form-control.subtotal');
            let sum2 = 0.0;
            for (let v of val2) {
                sum2 = sum2 + parseFloat(v.value);
                console.log(sum2);
            }
            var returnDateElement = document.getElementById('returnDate');
            var returnDate = returnDateElement.value;

            // Start date new added
            var startDateElement = document.getElementById('startDate');
            var startDate = startDateElement.value;

            const date1 = new Date(returnDate);
            const date2 = new Date(startDate);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            // Showing time difference from start date to end date
            document.getElementById("rentTime").innerHTML = diffDays + " days for rent";

            var totalAmount = document.getElementById('totalAmount');
            diffDays
                ?
                totalAmount.value = sum2 * diffDays :
                totalAmount.value = sum2;
        }

        function matchUnitAndSubTotal() {
            var table = document.getElementById('dynamic_field');
            for (var i = 1, row; row = table.rows[i]; i++) {
                row.cells[4].querySelector("input").value = row.cells[2].querySelector("input").value * row.cells[3]
                    .querySelector("input").value;
            }
        }

        function checkButton() {
            var button = document.getElementById('makeOrder');
            if (document.getElementById('dynamic_field').getElementsByTagName('tr').length > 1) {
                button.style.display = '';
            } else {
                button.style.display = 'none';
            }
        }



        $(function() {
            $('.datetimepicker1').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                timePicker: false,
                showDropdowns: true,
                timePicker24Hour: false,
                minDate: new Date(),
            });
            $('.datetimepicker1').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            $('.datetimepicker1').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $(document).ready(function() {
                setInterval("checkButton()", 500);
            });
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\project_nafis\resources\views/frontend/home.blade.php ENDPATH**/ ?>