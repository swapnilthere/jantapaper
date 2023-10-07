<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Janta Paper | Log in</title>



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">



    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">



    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">



    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/dist/css/adminlte.min.css?v=3.2.0">

    <script nonce="53f4fa5d-f217-4992-b4ab-1998fdc13c08">
        (function(w, d) {

            ! function(Y, Z, _, ba) {

                Y[_] = Y[_] || {};

                Y[_].executed = [];

                Y.zaraz = {

                    deferred: [],

                    listeners: []

                };

                Y.zaraz.q = [];

                Y.zaraz._f = function(bb) {

                    return function() {

                        var bc = Array.prototype.slice.call(arguments);

                        Y.zaraz.q.push({

                            m: bb,

                            a: bc

                        })

                    }

                };

                for (const bd of ["track", "set", "debug"]) Y.zaraz[bd] = Y.zaraz._f(bd);

                Y.zaraz.init = () => {

                    var be = Z.getElementsByTagName(ba)[0],

                        bf = Z.createElement(ba),

                        bg = Z.getElementsByTagName("title")[0];

                    bg && (Y[_].t = Z.getElementsByTagName("title")[0].text);

                    Y[_].x = Math.random();

                    Y[_].w = Y.screen.width;

                    Y[_].h = Y.screen.height;

                    Y[_].j = Y.innerHeight;

                    Y[_].e = Y.innerWidth;

                    Y[_].l = Y.location.href;

                    Y[_].r = Z.referrer;

                    Y[_].k = Y.screen.colorDepth;

                    Y[_].n = Z.characterSet;

                    Y[_].o = (new Date).getTimezoneOffset();

                    if (Y.dataLayer)

                        for (const bk of Object.entries(Object.entries(dataLayer).reduce(((bl, bm) => ({

                                ...bl[1],

                                ...bm[1]

                            })), {}))) zaraz.set(bk[0], bk[1], {

                            scope: "page"

                        });

                    Y[_].q = [];

                    for (; Y.zaraz.q.length;) {

                        const bn = Y.zaraz.q.shift();

                        Y[_].q.push(bn)

                    }

                    bf.defer = !0;

                    for (const bo of [localStorage, sessionStorage]) Object.keys(bo || {}).filter((bq => bq.startsWith("_zaraz_"))).forEach((bp => {

                        try {

                            Y[_]["z_" + bp.slice(7)] = JSON.parse(bo.getItem(bp))

                        } catch {

                            Y[_]["z_" + bp.slice(7)] = bo.getItem(bp)

                        }

                    }));

                    bf.referrerPolicy = "origin";

                    bf.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(Y[_])));

                    be.parentNode.insertBefore(bf, be)

                };

                ["complete", "interactive"].includes(Z.readyState) ? zaraz.init() : Y.addEventListener("DOMContentLoaded", zaraz.init)

            }(w, d, "zarazData", "script");

        })(window, document);
    </script>

</head>



<body class="hold-transition login-page">

    <div class="login-box">

        <div class="login-logo">

            <img src="<?php echo base_url() ?>public/admin/dist/img/jp_logo.png" alt="" height="200px">

            <!-- <a href=""><b>Janta</b>Paper</a> -->

        </div>

        <?php



        if (!empty($this->session->flashdata('msg'))) {



            echo "<div class='alert alert-danger'>" . $this->session->flashdata('msg') . "</div>";
        }



        ?>

        <div class="card">

            <div class="card-body login-card-body">

                <p class="login-box-msg">Sign in to start your session</p>

                <form action="<?php echo base_url() . 'admin/login/authenticate' ?>" name="loginForm" id="loginForm" method="post">

                    <div class="input-group mb-3">

                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">

                        <div class="input-group-append">

                            <div class="input-group-text">

                                <span class="fas fa-envelope"></span>

                            </div>

                        </div>

                    </div>

                    <?php echo form_error('username'); ?>

                    <div class="input-group mb-3">

                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">

                        <div class="input-group-append">

                            <div class="input-group-text">

                                <span class="fas fa-lock"></span>

                            </div>

                        </div>

                    </div>

                    <?php echo form_error('password'); ?>

                    <div class="row">

                        <div class="col-4">

                            <div class="icheck-primary">

                                <!-- <input type="checkbox" id="remember"> -->

                                <label for="remember">

                                    <!-- Remember Me -->

                                </label>

                            </div>

                        </div>



                        <div class="col-4">

                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                        </div>
                        <div class="col-12">
                            <br />
                            <a href='<?= base_url('userLogin') ?>' class="btn btn-default btn-block">User Login</a>

                        </div>


                    </div>

                </form>

                </p>

            </div>



        </div>

    </div>





    <script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>



    <script src="<?php echo base_url() ?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script src="<?php echo base_url() ?>public/admin/dist/js/adminlte.min.js?v=3.2.0"></script>

</body>



</html>