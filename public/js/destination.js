
//truyền list ảnh 
const totalSlides = slidesData.length;
let currentIndex = 2; // Chỉ số tỉnh thành ở giữa (tỉnh 3)
const slides = document.querySelectorAll('.slide');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');

// Lấy chỉ số vòng tròn
function getCircularIndex(index) {
    return (index + totalSlides) % totalSlides;
}

// Cập nhật hình ảnh và văn bản cho các slide
function updateSlides() {
    const indices = [
        getCircularIndex(currentIndex - 2),
        getCircularIndex(currentIndex - 1),
        getCircularIndex(currentIndex),
        getCircularIndex(currentIndex + 1),
        getCircularIndex(currentIndex + 2)
    ];

    slides.forEach((slide, i) => {
        const { imgDesURL: img, destinationName: name } = slidesData[indices[i]]; // Use the dynamic JSON data
        slide.querySelector('img').src = img;
        slide.querySelector('p').textContent = name;

        // Xóa các lớp cũ
        slide.classList.remove('far-left', 'left', 'center', 'right', 'far-right');

        // Thêm lớp tương ứng
        if (i === 0) slide.classList.add('far-left');
        else if (i === 1) slide.classList.add('left');
        else if (i === 2) slide.classList.add('center');
        else if (i === 3) slide.classList.add('right');
        else if (i === 4) slide.classList.add('far-right');
    });
}

// Chuyển sang phải
function nextSlide() {
    currentIndex = getCircularIndex(currentIndex + 1);
    updateSlides();
}

// Chuyển sang trái
function prevSlide() {
    currentIndex = getCircularIndex(currentIndex - 1);
    updateSlides();
}

// Sự kiện nút điều hướng
nextBtn.addEventListener('click', () => {
    nextSlide();
});

prevBtn.addEventListener('click', () => {
    prevSlide();
});

// Khởi tạo hiển thị ban đầu
updateSlides();
