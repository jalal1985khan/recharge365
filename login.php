<?php
    include("dashboard/includes/config.php");
    $res = $con->query("SELECT * FROM `websetting` WHERE ID = 1");
    $row = $res->fetch_assoc();
?> 
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Icons -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Page Title -->
    <title>Rc Portal Login</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&amp;display=swap">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/style.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
<!-- 
<link rel="stylesheet" href="css/fontawsome.css">
<link rel="stylesheet" href="css/fontawsome.min.css"> -->


<link rel="stylesheet" href="css/style.min.css">
<link rel="stylesheet" href="css/login.min.css">
    
    <style type="text/css">

    </style>

<style type="text/css">@keyframes tawkMaxOpen{0%{opacity:0;transform:translate(0, 30px);;}to{opacity:1;transform:translate(0, 0px);}}@-moz-keyframes tawkMaxOpen{0%{opacity:0;transform:translate(0, 30px);;}to{opacity:1;transform:translate(0, 0px);}}@-webkit-keyframes tawkMaxOpen{0%{opacity:0;transform:translate(0, 30px);;}to{opacity:1;transform:translate(0, 0px);}}#NsumiMp-1608839283413{outline:none!important;visibility:visible!important;resize:none!important;box-shadow:none!important;overflow:visible!important;background:none!important;opacity:1!important;filter:alpha(opacity=100)!important;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity1)!important;-moz-opacity:1!important;-khtml-opacity:1!important;top:auto!important;right:10px!important;bottom:90px!important;left:auto!important;position:fixed!important;border:0!important;min-height:0!important;min-width:0!important;max-height:none!important;max-width:none!important;padding:0!important;margin:0!important;-moz-transition-property:none!important;-webkit-transition-property:none!important;-o-transition-property:none!important;transition-property:none!important;transform:none!important;-webkit-transform:none!important;-ms-transform:none!important;width:auto!important;height:auto!important;display:none!important;z-index:2000000000!important;background-color:transparent!important;cursor:auto!important;float:none!important;border-radius:unset!important;pointer-events:auto!important}#rEV5Vmf-1608839283416.open{animation : tawkMaxOpen .25s ease!important;}</style></head>
<body class="shape-bg" style="padding-right: 0px;" data-new-gr-c-s-check-loaded="14.990.0" data-gr-ext-installed="">
    <header class="header">
        <div class="header__logo">
             <a href="index.php" target="_blank">
                <img src="images/<?php echo $row['LOGO']; ?>" alt="Company Logo">
            </a>
        </div>

        <div class="header__menu">
            <a href="javascript:;">Recharge</a>
            <span class="divider">|</span>
            <a href="javascripe:;">Bill Payment</a>
            <span class="divider">|</span>
            <a href="javascript:;">DMT</a>
        </div>
    </header>

    <section id="signInForm" class="formPage">
        <div class="formPage__card animated appeared fadeInUp visible" data-animation="appeared fadeInUp" data-animation-delay="200">
            <h2 class="title">Sign In</h2>
            <form method="post" action="handler/login.php" class="formBlock">
                <div class="form-group">
                    <label for="" class="label">Mobile Number</label>
                    <input type="number" name="mobile" class="form-control input__field" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="" class="label">Password</label>
                    <input type="password" name="password" id="password" class="form-control input__field" maxlength="15">
                    <a href="forget-password.php" class="link">Forgot Password?</a>
                </div>
                <div class="form-group margin-bottom-20 padding-top-30">
                    <button type="submit" name="login" class="btn radius primary-btn btn-full">Sign in</button>
                </div>
            </form>

            <div class="backBlock">
                <a href="index.php" class="backBlock__button">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </div>
    </section>

    

    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <div class="footer__copyright">
                    © Copyright 2021 <?php echo $row['WEBSITENAME']; ?>. All right Reserved.
                </div>
                <div class="footer__links">
                    <a href="javascript:;">Recharge</a>
                    <a href="javascripe:;">Bill Payment</a>
                    <a href="javascript:;">DMT</a>
                </div>
            </div>
        </div>
    </footer>

    <!--<div class="siteLoaderWrap" style="display: none;">-->
    <!--    <div class="siteLoaderWrap__container">-->
    <!--        <div class="spinner1"></div>-->
    <!--        <div class="spinner2"></div>-->
    <!--        <div class="spinner3"></div>-->
    <!--        <div class="spinner4"></div>-->
    <!--        <div class="spinner5"></div>-->
    <!--    </div>-->
    <!--</div>-->

    <!-- Javascripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/smooth-scroll.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/app.min.js"></script>
    
    <script type="text/javascript" src="../theme/grape/js/login/third_party/bootstrap-notify-master/bootstrap-notify.js?20200604115852"></script>

    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var 
        s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/<?php echo $row['CHATID']; ?>/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
   
        <div id="modal" class="modal fade" style="z-index:99999999 !important;" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalLabel" aria-hidden="true"></div>

<div style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 3px; position: absolute; transition: visibility 0s linear 0.3s, opacity 0.3s linear 0s; opacity: 0; visibility: hidden; z-index: 2000000000; left: 0px; top: -10000px;"><div style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 2000000000; background-color: rgb(255, 255, 255); opacity: 0.05;"></div><div class="g-recaptcha-bubble-arrow" style="border: 11px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -11px; z-index: 2000000000;"></div><div class="g-recaptcha-bubble-arrow" style="border: 10px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -10px; z-index: 2000000000;"></div><div style="z-index: 2000000000; position: relative;"><iframe title="recaptcha challenge" src="https://www.google.com/recaptcha/api2/bframe?hl=en&amp;v=qc5B-qjP0QEimFYUxcpWJy5B&amp;k=6Lf5O7cZAAAAAI_COZLYFzjFrZMFfFtPk2yfcgRZ&amp;cb=lrkeb1ov6i49" name="c-56fdvt5huc7h" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox" style="width: 100%; height: 100%;"></iframe></div></div><div style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 3px; position: absolute; transition: visibility 0s linear 0.3s, opacity 0.3s linear 0s; opacity: 0; visibility: hidden; z-index: 2000000000; left: 0px; top: -10000px;"><div style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 2000000000; background-color: rgb(255, 255, 255); opacity: 0.05;"></div><div class="g-recaptcha-bubble-arrow" style="border: 11px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -11px; z-index: 2000000000;"></div><div class="g-recaptcha-bubble-arrow" style="border: 10px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -10px; z-index: 2000000000;"></div><div style="z-index: 2000000000; position: relative;"><iframe title="recaptcha challenge" src="https://www.google.com/recaptcha/api2/bframe?hl=en&amp;v=qc5B-qjP0QEimFYUxcpWJy5B&amp;k=6Lf5O7cZAAAAAI_COZLYFzjFrZMFfFtPk2yfcgRZ&amp;cb=b4s0ya8ivpfx" name="c-ec2q3i4poc7q" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox" style="width: 100%; height: 100%;"></iframe></div></div><div style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 3px; position: absolute; transition: visibility 0s linear 0.3s, opacity 0.3s linear 0s; opacity: 0; visibility: hidden; z-index: 2000000000; left: 0px; top: -10000px;"><div style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 2000000000; background-color: rgb(255, 255, 255); opacity: 0.05;"></div><div class="g-recaptcha-bubble-arrow" style="border: 11px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -11px; z-index: 2000000000;"></div><div class="g-recaptcha-bubble-arrow" style="border: 10px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -10px; z-index: 2000000000;"></div><div style="z-index: 2000000000; position: relative;"><iframe title="recaptcha challenge" src="https://www.google.com/recaptcha/api2/bframe?hl=en&amp;v=qc5B-qjP0QEimFYUxcpWJy5B&amp;k=6Lf5O7cZAAAAAI_COZLYFzjFrZMFfFtPk2yfcgRZ&amp;cb=1b07gscbv14m" name="c-pzc9xsbhunwc" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox" style="width: 100%; height: 100%;"></iframe></div></div><div id="NsumiMp-1608839283413" class="" style="display: none !important;"><iframe id="rEV5Vmf-1608839283416" src="about:blank" frameborder="0" scrolling="no" title="chat widget" class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: auto !important; position: static !important; border: 0px !important; min-height: auto !important; min-width: auto !important; max-height: none !important; max-width: none !important; padding: 0px !important; margin: 0px !important; transition-property: none !important; transform: none !important; width: 350px !important; height: 520px !important; z-index: 999999 !important; cursor: auto !important; float: none !important; border-radius: unset !important; pointer-events: auto !important; display: none !important;"></iframe><iframe id="t7di1wz-1608839283418" src="about:blank" frameborder="0" scrolling="no" title="chat widget" class="" style="outline: none !important; visibility: visible !important; resize: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: auto 20px 20px auto !important; position: fixed !important; border: 0px !important; padding: 0px !important; transition-property: none !important; z-index: 1000001 !important; cursor: auto !important; float: none !important; pointer-events: auto !important; box-shadow: rgba(0, 0, 0, 0.16) 0px 2px 10px 0px !important; height: 60px !important; min-height: 60px !important; max-height: 60px !important; width: 60px !important; min-width: 60px !important; max-width: 60px !important; border-radius: 50% !important; transform: rotate(0deg) translateZ(0px) !important; transform-origin: 0px center !important; margin: 0px !important; display: block !important;"></iframe><iframe id="uNk69Qx-1608839283418" src="about:blank" frameborder="0" scrolling="no" title="chat widget" class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: auto 15px 60px auto !important; position: fixed !important; border: 0px !important; padding: 0px !important; margin: 0px !important; transition-property: none !important; transform: none !important; display: none !important; z-index: 1000003 !important; cursor: auto !important; float: none !important; border-radius: unset !important; pointer-events: auto !important; width: 21px !important; max-width: 21px !important; min-width: 21px !important; height: 21px !important; max-height: 21px !important; min-height: 21px !important;"></iframe><iframe id="rEvmDtv-1608839283419" src="about:blank" frameborder="0" scrolling="no" title="chat widget" class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: auto 0px 30px auto !important; position: fixed !important; border: 0px !important; padding: 0px !important; transition-property: none !important; cursor: auto !important; float: none !important; border-radius: unset !important; pointer-events: auto !important; transform: rotate(0deg) translateZ(0px) !important; transform-origin: 0px center !important; width: 124px !important; max-width: 124px !important; min-width: 124px !important; height: 95px !important; max-height: 95px !important; min-height: 95px !important; z-index: 1000002 !important; margin: 0px !important; display: none !important;"></iframe><div class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: 0px auto auto 0px !important; position: absolute !important; border: 0px !important; min-height: auto !important; min-width: auto !important; max-height: none !important; max-width: none !important; padding: 0px !important; margin: 0px !important; transition-property: none !important; transform: none !important; width: 100% !important; height: 100% !important; display: none !important; z-index: 1000001 !important; cursor: move !important; float: left !important; border-radius: unset !important; pointer-events: auto !important;"></div><div id="FxTnLHQ-1608839283413" class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: 0px auto auto 0px !important; position: absolute !important; border: 0px !important; min-height: auto !important; min-width: auto !important; max-height: none !important; max-width: none !important; padding: 0px !important; margin: 0px !important; transition-property: none !important; transform: none !important; width: 6px !important; height: 100% !important; display: block !important; z-index: 999998 !important; cursor: w-resize !important; float: none !important; border-radius: unset !important; pointer-events: auto !important;"></div><div id="nBnmijg-1608839283414" class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: 0px 0px auto auto !important; position: absolute !important; border: 0px !important; min-height: auto !important; min-width: auto !important; max-height: none !important; max-width: none !important; padding: 0px !important; margin: 0px !important; transition-property: none !important; transform: none !important; width: 100% !important; height: 6px !important; display: block !important; z-index: 999998 !important; cursor: n-resize !important; float: none !important; border-radius: unset !important; pointer-events: auto !important;"></div><div id="HUH3GHf-1608839283414" class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: 0px auto auto 0px !important; position: absolute !important; border: 0px !important; min-height: auto !important; min-width: auto !important; max-height: none !important; max-width: none !important; padding: 0px !important; margin: 0px !important; transition-property: none !important; transform: none !important; width: 12px !important; height: 12px !important; display: block !important; z-index: 999998 !important; cursor: nw-resize !important; float: none !important; border-radius: unset !important; pointer-events: auto !important;"></div><iframe id="NV8kzSg-1608839283553" src="about:blank" frameborder="0" scrolling="no" title="chat widget" class="" style="outline: none !important; visibility: visible !important; resize: none !important; box-shadow: none !important; overflow: visible !important; background: none transparent !important; opacity: 1 !important; inset: auto 20px 100px auto !important; position: fixed !important; border: 0px !important; min-height: auto !important; min-width: auto !important; max-height: none !important; max-width: none !important; padding: 0px !important; margin: 0px !important; transition-property: none !important; transform: none !important; width: 378px !important; height: 617px !important; display: none !important; z-index: 999999 !important; cursor: auto !important; float: none !important; border-radius: unset !important; pointer-events: auto !important;"></iframe></div><iframe src="about:blank" title="chat widget logging" style="display: none !important;"></iframe>

</body>
</html>