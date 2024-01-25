<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir y Procesar Excel</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        li {
            color: #555;
        }
    </style>
</head>
<body>

<form id="uploadForm" action="{{ route('excel.upload') }}" method="post">
    @csrf
    Ingrese las variables separadas por comas:
    <textarea name="variables" id="variables" rows="5" cols="50"></textarea>
    <br>
    <input type="submit" value="Procesar variables" name="submit">
</form>

<script>
$(document).ready(function(){
    $('#uploadForm').on('submit', function(e){
        e.preventDefault();
        
        $.ajax({
            url: '{{ route('excel.upload') }}',
            type: 'post',
            data: $(this).serialize(),
            success: function(data) {
                if (data.responses) {
                    data.responses.forEach(response => {
                        if (response.success) {
                            alert('Éxito: ' + response.data);
                        } else if (response.error) {
                            alert('Error: ' + response.error);
                        } else {
                            alert('Estructura de respuesta inesperada.');
                        }
                    });
                } else {
                    alert('Respuesta inesperada del servidor.');
                }
            },
            error: function() {
                alert('Error al enviar el formulario.');
            }
        });
    });
});
</script>

</body>
</html>
