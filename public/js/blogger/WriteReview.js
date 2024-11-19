// Lấy phần tử chứa ảnh xem trước và phần tử input file
const previewContainer = document.getElementById('photo-preview');
const inputFile = document.getElementById('upload-photos');

//Chọn tệp thì hình hiện lêng - onchange mà chạy thì hàm preview chạy
function previewImages() {
    const input = document.getElementById('upload-photos');
    const previewContainer = document.getElementById('photo-preview');
    previewContainer.innerHTML = ''; 


    //khi mình chọn file, hàm này này sé read nó -> và 1 element img cho cái hinhf mình vừa chọn 
    if (input.files) {
        Array.from(input.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    }
}


//hàm để chỉnh format ngày hợp lệ - tham khảo
// function validateDateFormat(input) {
//     // Xóa các ký tự không là số và dấu - 
//     input.value = input.value.replace(/[^0-9\-]/g, '');

//     // chia từng phần để check structure theò format Y-M-D - tách dấu khỏi part 
//     const parts = input.value.split('-');

//     // Gõ sai định dạng là nó hiển thị sai số ngay tháng
//     if (parts.length > 3 || 
//         (parts[0] && parts[0].length > 4) || 
//         (parts[1] && parts[1].length > 2) || 
//         (parts[2] && parts[2].length > 2)) {
//         input.value = input.value.slice(0, -1); 
//     }

//     // Check độ dài - vì ngày tháng năm, kèm với dấu - là định dạng là 10 ký tự 
//     if (input.value.length === 10) {
//         const [year, month, day] = input.value.split('-');
//         if (!(year >= 2000 && year <= 2050) || !(month >= 1 && month <= 12) || !(day >= 1 && day <= 31)) {
//             input.setCustomValidity('Vui lòng nhập đúng định dạng (YYYY-MM-DD) và đảm bảo ngày hợp lệ.');
//         } else {
//             input.setCustomValidity(''); // Reset custom error
//         }
//     } else {
//         input.setCustomValidity(''); // Reset custom error for incomplete input
//     }
// }
