<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RENTCARME</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href=" https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        .image-preview {
            text-align: center;
            margin-top: 10px;
        }

        #previewImage {
            max-width: 100%;
            max-height: 200px;
        }

        #previewImage1 {
            max-width: 100%;
            max-height: 200px;
        }

        .upload-container {
            position: relative;
        }

        .profile-image-container {
            position: relative;
            width: 150px;
            height: 150px;
            overflow: hidden;
            border-radius: 50%;
            border: 1px solid black;
        }

        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .icon-kategori-container {
            position: relative;
            width: 150px;
            height: 150px;
            overflow: hidden;
            /* border-radius: 50%; */
            border: 1px solid rgb(194, 194, 194);
        }

        .icon-kategori-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .icon-kategori-container:hover .overlay {
            opacity: 1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            cursor: pointer;
        }

        .profile-image-container:hover .overlay {
            opacity: 1;
        }

        .upload-button {
            padding: 100px 100px;
            margin: 5px 0 0 0;
            /* background-color: #3897f0; */
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .upload-button .icon {
            margin-right: 8px;
        }

        #upload-input {
            display: none;
        }

        #drop-area {
            position: relative;
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        #upload-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #fileInput {
            display: none;
        }

        #preview-container {
            margin-top: 20px;
            text-align: center;
        }

        #preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        #remove-btn {
            background-color: #ff3333;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
