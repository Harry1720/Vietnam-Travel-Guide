document.addEventListener('DOMContentLoaded',function(){
    const codeBoxes = document.querySelectorAll('.code-box');

        codeBoxes.forEach((box, index) => {
            box.addEventListener('input', () => {
                // Chuyển đến ô tiếp theo chỉ nếu ô hiện tại không rỗng
                if (box.value.length >= 1) {
                    if (index < codeBoxes.length - 1) {
                        codeBoxes[index + 1].focus();
                    }
                }
            });
            

            box.addEventListener('keydown', (event) => {
                // Chuyển về ô trước nếu phím Backspace được nhấn và ô hiện tại rỗng
                if (event.key === 'Backspace' && box.value.length === 0 && index > 0) {
                    codeBoxes[index - 1].focus();
                }
            });
        });

        // Verify when Enter is pressed
        document.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            verifyButton.click();
        }
  
        });

})
