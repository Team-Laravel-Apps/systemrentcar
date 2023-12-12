jQuery(document).ready(function () {
    var dragAndDropBox = document.getElementById('drag-and-drop-box');
    var uploadImgWrap = document.getElementById('upload-img-wrap');

    // Prevent the default behavior to open the file dialog when dragging over the box
    dragAndDropBox.addEventListener('dragover', function (e) {
        e.preventDefault();
        dragAndDropBox.classList.add('upload__box--dragover');
    });

    // Remove the dragover class when dragging leaves the box
    dragAndDropBox.addEventListener('dragleave', function () {
        dragAndDropBox.classList.remove('upload__box--dragover');
    });

    // Handle the dropped files
    dragAndDropBox.addEventListener('drop', function (e) {
        e.preventDefault();
        dragAndDropBox.classList.remove('upload__box--dragover');
        handleFiles(e.dataTransfer.files);
    });

    // Handle file selection
    $('#file-input').on('change', function (e) {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        // Clear existing content
        uploadImgWrap.innerHTML = '';

        var maxLength = $('#file-input').data('max_length');
        var filesArr = Array.from(files);

        filesArr.forEach(function (file, index) {
            if (!file.type.match('image.*')) {
                return;
            }

            if (index >= maxLength) {
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var html = `
                        <div class='upload__img-box'>
                            <div style='background-image: url(${e.target.result})'
                                 data-number='${index}'
                                 data-file='${file.name}'
                                 class='img-bg'>
                                <div class='upload__img-close'></div>
                            </div>
                        </div>`;
                    uploadImgWrap.insertAdjacentHTML('beforeend', html);
                };
                reader.readAsDataURL(file);
            }
        });

        updateFileInput(filesArr);
    }

    // Handle image removal
    $('body').on('click', '.upload__img-close', function () {
        var file = $(this).parent().data('file');
        var imgArray = Array.from($('#file-input')[0].files);
        imgArray = imgArray.filter(function (img) {
            return img.name !== file;
        });

        handleFiles(imgArray);
    });

    function updateFileInput(files) {
        // Update the file input value with the current state of files
        var fileInput = $('#file-input');
        fileInput[0].files = new FileListWrapper(files);
    }

    // FileListWrapper to create a new FileList
    function FileListWrapper(items) {
        var fileList = new DataTransfer();
        items.forEach(function (item) {
            fileList.items.add(item);
        });
        return fileList.files;
    }
});
