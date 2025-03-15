<!DOCTYPE html>
<html lang="en">
	<!--<head>-->
		<meta charset="utf-8">
		<title>Aplikasi Antrian</title>
		<link rel="shortcut icon" href="<?=base_url('assets/img/favicon.ico')?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Smokers">
		<script type="text/javascript" src="<?=base_url('assets/js/jquery-1.8.0.min.js')?>">jQuery.noConflict();</script>
		<script type="text/javascript" src="<?=base_url('assets/js/jquery.easyui.min.js')?>">jQuery.noConflict();</script>
		<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.js')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap/easyui.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap-responsive.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/sticky-footers.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/icon.css')?>">
	<!--</head>-->
		<style>
	h1,h2,p,a{
		font-family: sans-serif;
		font-weight: normal;
	}
 
	.jam-digital-malasngoding {
		overflow: hidden;
	}

	.jam-digital-malasngoding p {
		color: #fff;
		font-size: 20px;
		text-align: center;
	}
 
 
</style>

<style media="screen">
            .button:focus {
                outline: none;
            }

            .button {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                width: 350px;
                height: 350px;
                border-radius: 350px;
                -webkit-border-radius: 350px;
                padding: 10px;
                cursor: pointer;
                top: 0;
                border: 1px solid #000;
                white-space: normal;
                font-size: 40px;
                font-weight: bold;
                text-shadow: 2px -1px 1px #000;
                color: rgba(255,255,255,0.9);
                text-align: center;
                -o-text-overflow: clip;
                text-overflow: clip;
                background: -webkit-radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #C91826;
                background: -moz-radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #C91826;
                background: radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #C91826;
                background-repeat: no-repeat;
                background-position: 0 100%;
                -webkit-background-origin: padding-box;
                background-origin: padding-box;
                -webkit-background-clip: border-box;
                background-clip: border-box;
                -webkit-background-size: 158px 142px;
                background-size: 158px 142px;
                -webkit-box-shadow: 1px 16px 10px 5px rgba(0,0,0,0.2) , 0 8px 0 0 #000000 , 4px 8px 15px 4px rgba(0,0,0,0.4) , 5px 1px 5px 0 rgba(255,255,255,0.2) inset, 5px -4px 5px 0 rgba(255,255,255,0.2) inset, -2px 3px 6px 0 rgba(0,0,0,0.2) inset;
                box-shadow: 1px 16px 10px 5px rgba(0,0,0,0.2) , 0 8px 0 0 #000000 , 4px 8px 15px 4px rgba(0,0,0,0.4) , 5px 1px 5px 0 rgba(255,255,255,0.2) inset, 5px -4px 5px 0 rgba(255,255,255,0.2) inset, -2px 3px 6px 0 rgba(0,0,0,0.2) inset;
                -webkit-transition: all 40ms cubic-bezier(0.6, -0.28, 0.735, 0.04);
                -moz-transition: all 40ms cubic-bezier(0.6, -0.28, 0.735, 0.04);
                -o-transition: all 40ms cubic-bezier(0.6, -0.28, 0.735, 0.04);
                transition: all 40ms cubic-bezier(0.6, -0.28, 0.735, 0.04);
                -webkit-transform: rotateX(20deg)  translateY(15px) translateZ(40px);
                transform: rotateX(20deg)  translateY(15px) translateZ(40px);
            }

            .button:hover {
                background: -webkit-radial-gradient(closest-side, rgba(255,255,255,0.28) 0, rgba(0,0,0,0) 100%), #a80008;
                background: -moz-radial-gradient(closest-side, rgba(255,255,255,0.28) 0, rgba(0,0,0,0) 100%), #a80008;
                background: radial-gradient(closest-side, rgba(255,255,255,0.28) 0, rgba(0,0,0,0) 100%), #a80008;
                background-repeat: no-repeat;
                background-position: 0 100%;
                -webkit-background-origin: padding-box;
                background-origin: padding-box;
                -webkit-background-clip: border-box;
                background-clip: border-box;
                -webkit-background-size: 158px 142px;
                background-size: 158px 142px;
                -webkit-box-shadow: 1px 16px 10px 5px rgba(0,0,0,0.2) , 0 8px 0 0 #000000 , 4px 8px 15px 4px rgba(0,0,0,0.4) , 5px 1px 5px 0 rgba(255,255,255,0.2) inset, 5px -4px 5px 0 rgba(255,255,255,0.2) inset, -2px 2px 6px 0 rgba(0,0,0,0.2) inset;
                box-shadow: 1px 16px 10px 5px rgba(0,0,0,0.2) , 0 8px 0 0 #000000 , 4px 8px 15px 4px rgba(0,0,0,0.4) , 5px 1px 5px 0 rgba(255,255,255,0.2) inset, 5px -4px 5px 0 rgba(255,255,255,0.2) inset, -2px 2px 6px 0 rgba(0,0,0,0.2) inset;
                -webkit-transition: all 0 cubic-bezier(0.42, 0, 0.58, 1);
                -moz-transition: all 0 cubic-bezier(0.42, 0, 0.58, 1);
                -o-transition: all 0 cubic-bezier(0.42, 0, 0.58, 1);
                transition: all 0 cubic-bezier(0.42, 0, 0.58, 1);
            }

            .button:active {
                position: relative;
                cursor: default;
                top: 6px;
                background: -webkit-radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #c60009;
                background: -moz-radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #c60009;
                background: radial-gradient(closest-side, rgba(255,255,255,0.2) 0, rgba(0,0,0,0) 100%), #c60009;
                background-repeat: no-repeat;
                background-position: 0 100%;
                -webkit-background-origin: padding-box;
                background-origin: padding-box;
                -webkit-background-clip: border-box;
                background-clip: border-box;
                -webkit-background-size: 158px 142px;
                background-size: 158px 142px;
                -webkit-box-shadow: 1px 5px 8px 4px rgba(0,0,0,0.4) , 0 1px 0 0 #000000 , 1px 2px 1px 1px rgba(0,0,0,0.6) , 3px 1px 5px 0 rgba(255,255,255,0.2) inset, 3px -6px 5px 0 rgba(255,255,255,0.2) inset, -1px 1px 4px 0 rgba(0,0,0,0.2) inset;
                box-shadow: 1px 5px 8px 4px rgba(0,0,0,0.4) , 0 1px 0 0 #000000 , 1px 2px 1px 1px rgba(0,0,0,0.6) , 3px 1px 5px 0 rgba(255,255,255,0.2) inset, 3px -6px 5px 0 rgba(255,255,255,0.2) inset, -1px 1px 4px 0 rgba(0,0,0,0.2) inset;
                -webkit-transition: all 40ms cubic-bezier(0.42, 0, 0.58, 1);
                -moz-transition: all 40ms cubic-bezier(0.42, 0, 0.58, 1);
                -o-transition: all 40ms cubic-bezier(0.42, 0, 0.58, 1);
                transition: all 40ms cubic-bezier(0.42, 0, 0.58, 1);
            }

            .loader {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                text-align: center;
                z-index: 999999999999999999;
                background-color: rgba(51, 51, 51, 0.3);
                display: none;
            }

            .spinner {
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 100px;
                height: 100px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
                position: relative;
                top: 40%;
                left: 46.5%;
                transform: translate(-40%, -46.5%);
            }

            /* Safari */
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
<body style="background:#ffffff;font-family:verdana">

