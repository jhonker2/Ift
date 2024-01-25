
   document.getElementById('nombreInput').addEventListener('keyup', function() {
    var query = this.value;
    if (query.length >= 2) { // Trigger only if 2 or more characters are typed
        $.ajax({
			url: `/get_empleados?nombres=${query}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var resultContainer = document.getElementById('resultContainer');
                resultContainer.innerHTML = '<option value="">Select a result</option>';
                data.forEach(item => {
                    resultContainer.innerHTML += `<option value="${item.IDENTIFICACION}">${item.NOMBRES}</option>`;
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
});


    // Comprobar si existe la variable de sesión 'success'
    @if(session('success'))
        Swal.fire({
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    @endif

    // Comprobar si existe la variable de sesión 'error'
    @if(session('error'))
        Swal.fire({
            title: 'Error',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    @endif

		$(document).ready(function () {
			$('#image-uploadify').imageuploadify();
		})


