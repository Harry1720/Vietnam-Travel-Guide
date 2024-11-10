// Fetch nội dung của footer và chèn vào phần tử có id "footer-placeholder"
fetch("/include/footer.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("footer-placeholder").innerHTML = data;
    });

fetch("/include/header3.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("header-placeholder").innerHTML = data;
    });

// Lấy phần tử chứa ảnh xem trước và phần tử input file
const previewContainer = document.getElementById('photo-preview');
const inputFile = document.getElementById('upload-photos');

// Lắng nghe sự kiện thay đổi khi người dùng chọn tệp
inputFile.addEventListener('change', event => {
    const files = Array.from(event.target.files);

    files.forEach(file => {
        // Chỉ xử lý các tệp có kiểu MIME là ảnh
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();

            // Khi quá trình đọc tệp hoàn thành
            reader.onload = e => {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'img-container';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-img';

                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'X';
                deleteBtn.className = 'delete-btn';

                // Xóa ảnh khi nhấn nút xóa
                deleteBtn.addEventListener('click', () => imgContainer.remove());

                // Thêm ảnh và nút xóa vào container, rồi thêm container vào phần xem trước
                imgContainer.append(img, deleteBtn);
                previewContainer.appendChild(imgContainer);
            };

            reader.readAsDataURL(file); // Đọc file dưới dạng URL dữ liệu
        }
    });
});