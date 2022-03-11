$(document).ready(function () {
  /**/
  $(".invalid-feedback").hide();

  if ($("#tabla")) {
    $.ajax({
      type: "GET",
      url: "../src/mostrar-usuario.php",

      success: function (data) {
        $("#tabla").html(data);

        $(".update").on("click", function (e) {
          e.preventDefault();
          $("#myModal").modal("show");
          let id_usuario = $(this).attr("id_usuario");
          let nombre = $(this).attr("nombre");
          let apellido = $(this).attr("apellido");
          let telefono = $(this).attr("telefono");
          let direccion = $(this).attr("direccion");
          let fecha_nacimiento = $(this).attr("fecha_nacimiento");
          $("#id_usuario").val(id_usuario);
          $("#nombre").val(nombre);
          $("#apellido").val(apellido);
          $("#telefono").val(telefono);
          $("#direccion").val(direccion);
          $("#fecha_nacimiento").val(fecha_nacimiento);
          $("#Actualizar").on("click", function (e) {
            $(".invalid-feedback").hide();
            $("input").removeClass("is-invalid");
            const expresiones = {
              usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
              nombre: /^[a-zA-ZÀ-ÿ\s]+$/, //
              password: /^.{4,12}$/, // 4 a 12 digitos.
              correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
              telefono: /^\d{7,14}$/, // 7 a 14 numeros.
            };

            let nombre = $("#nombre");
            let apellido = $("#apellido");
            let telefono = $("#telefono");
            let direccion = $("#direccion");
            let fecha_nacimiento = $("#fecha_nacimiento");
            let isValidDate = Date.parse(fecha_nacimiento.val());
            if (
              nombre.val().trim() == null ||
              nombre.val().trim().length == 0 ||
              !expresiones.nombre.test(nombre.val().trim())
            ) {
              nombre.addClass("is-invalid");

              $("#nombre_invalido").show();
            } else if (
              apellido.val().trim() == null ||
              apellido.val().trim().length == 0 ||
              !expresiones.nombre.test(apellido.val().trim())
            ) {
              apellido.addClass("is-invalid");

              $("#apellido_invalido").show();
            } else if (
              telefono.val().trim() == null ||
              telefono.val().trim().length == 0 ||
              !expresiones.telefono.test(telefono.val())
            ) {
              telefono.addClass("is-invalid");

              $("#telefono_invalido").show();
            } else if (
              direccion.val().trim() == null ||
              direccion.val().trim().length == 0
            ) {
              direccion.addClass("is-invalid");

              $("#direccion_invalido").show();
            } else if (isNaN(isValidDate)) {
              fecha_nacimiento.addClass("is-invalid");

              $("#fecha_nacimiento_invalido").show();
              
            } else {
              $.ajax({
                type: "POST",
                data: $("#form_actualizar").serialize(),
                url: "../src/actualizar-usuario.php",

                success: function (data) {
                  alert(data);
                  location.reload();
                },
                error: function (request, status, error) {
                  alert(request.responseText);
                },
              });
            }
          });
        });
        $(".delete").on("click", function (e) {
          e.preventDefault();

          var r = confirm("Esta seguro que desea eliminarlo!");
          if (r == true) {
            let id_usuario = $(this).attr("id_usuario");
            $.ajax({
              type: "POST",
              data: "id_usuario=" + id_usuario,
              url: "../src/eliminar-usuario.php",

              success: function (data) {
                alert(data);
                location.reload();
              },
              error: function (request, status, error) {
                alert(request.responseText);
              },
            });
          }
        });
      },
      error: function (request, status, error) {
        alert(request.responseText);
      },
    });
  }

  $("#form_agregar").on("submit", function (e) {
    e.preventDefault();
    $(".invalid-feedback").hide();
    $("input").removeClass("is-invalid");
    const expresiones = {
      usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
      nombre: /^[a-zA-ZÀ-ÿ\s]+$/, //
      password: /^.{4,12}$/, // 4 a 12 digitos.
      correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
      telefono: /^\d{7,14}$/, // 7 a 14 numeros.
    };

    let nombre = $("#nombre");
    let apellido = $("#apellido");
    let telefono = $("#telefono");
    let direccion = $("#direccion");
    let fecha_nacimiento = $("#fecha_nacimiento");
    let isValidDate = Date.parse(fecha_nacimiento.val());
    if (
      nombre.val().trim() == null ||
      nombre.val().trim().length == 0 ||
      !expresiones.nombre.test(nombre.val().trim())
    ) {
      nombre.addClass("is-invalid");

      $("#nombre_invalido").show();
    } else if (
      apellido.val().trim() == null ||
      apellido.val().trim().length == 0 ||
      !expresiones.nombre.test(apellido.val().trim())
    ) {
      apellido.addClass("is-invalid");

      $("#apellido_invalido").show();
    } else if (
      telefono.val().trim() == null ||
      telefono.val().trim().length == 0 ||
      !expresiones.telefono.test(telefono.val())
    ) {
      telefono.addClass("is-invalid");

      $("#telefono_invalido").show();
    } else if (
      direccion.val().trim() == null ||
      direccion.val().trim().length == 0
    ) {
      direccion.addClass("is-invalid");

      $("#direccion_invalido").show();
    } else if (isNaN(isValidDate)) {
      fecha_nacimiento.addClass("is-invalid");

      $("#fecha_nacimiento_invalido").show();
    } else {
      $.ajax({
        type: "POST",
        data: $("#form_agregar").serialize(),
        url: "../src/guardar-usuario.php",

        success: function (data) {
          alert(data);
        },
        error: function (request, status, error) {
          alert(request.responseText);
        },
      });
    }
  });
});
