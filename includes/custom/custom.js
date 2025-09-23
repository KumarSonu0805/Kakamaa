// JavaScript Document
$(document).ready(function(e) {
    const modeButton = document.getElementById('darkModeToggle');
    const body = document.body;
    if(modeButton){
        // Check localStorage for dark mode setting
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            modeButton.innerHTML='<i class="fas fa-sun"></i>';
        }
        else{
            modeButton.innerHTML='<i class="fas fa-moon"></i>';
        }

        // Toggle dark mode on button click
        modeButton.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
                modeButton.innerHTML='<i class="fas fa-moon"></i>';
            } else {
                body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
                modeButton.innerHTML='<i class="fas fa-sun"></i>';
            }
        });
    }
	if($('.toastr-notify').length){
		$this=$('.toastr-notify');
		toastr.options={
		  "closeButton": true,
		  "positionClass": $this.data('position'),
		  "timeOut": "5000"
		};
		toastr[$this.data('status')]($this.html(), $this.data('title'));
    }
});